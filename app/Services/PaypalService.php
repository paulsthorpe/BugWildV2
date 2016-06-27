<?php

namespace App\Services;

use Session;
use Config;
use App\Order;
use App\OrderItems;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;


/*
|--------------------------------------------------------------------------
| PaypalService Class
|--------------------------------------------------------------------------
|
| class for methods involving handling paypal transaction
|
|
|createOrder()
|setPayer()
|createItemsArray()
|convertCurrency()
|makeItemList()
|setDetails()
|setamount()
|makeTransaction()
|redirectUrls()
|getStatus()
|persistOrder()
|
*/


/**
 * Class PaypalService
 * @package App\Services
 */
class PaypalService
{

    public $approvalUrl;
    public $dbItems = [];
    private $api_context;
    private $subtotal = 0;
    private $total = 0;
    private $items = [];
    private $itemsList;
    private $shipping = 700;
    private $payer;
    private $details;
    private $transaction;
    private $amount;
    private $payment;
    private $redirectUrls;
    //these properties are to store in session after payment has clear to
    //display confirmation to customer
    private $orderId;
    private $specialInstructions;
    private $paypalTrans;

    /**
     * PaypalService constructor.
     * apicontext is used for authentication in paypal's api
     * uses env data and config found in config folder
     */
    public function __construct()
    {
        $this->api_context = new ApiContext(new OAuthTokenCredential(env('PAYPAL_CLIENT'), env('PAYPAL_SECRET')));
        $this->api_context->setConfig(Config::get('paypal.settings'));
    }

    /**
     * @return mixed
     */
    public function createOrder()
    {

        $this->setPayer();
        $this->createItemsArray();
        $this->setDetails();
        $this->setAmount();
        $this->makeTransaction();
        $this->redirectUrls();
        $this->createPayment();
        $this->payment->create($this->api_context);
        $this->approvalUrl = $this->payment->getApprovalLink();
        Session::put('paypal_payment_id', $this->payment->getId());
        return $this->approvalUrl;

    }

    /**
     *
     */
    public function setPayer()
    {
        $this->payer = new Payer();
        $this->payer->setPaymentMethod('paypal');
    }

    /**
     * create order details for paypal and store in paypal
     * service properties
     */
    public function createItemsArray()
    {

        //foreach items in session create new paypal product object
        //and push into paypalservice property
        foreach (session('items') as $item) {
            $product = new Item();
            $product->setName($item['product_title'])
                ->setCurrency('USD')
                ->setQuantity($item['quantity'])
                ->setPrice(self::convertCurrency($item['base_price'] + $item['upcharge']));
            array_push($this->items, $product);
            $this->subtotal += $item['price_as_config'];
        }

        //set overall total,subtotal and shipping
        $this->total = $this->subtotal + $this->shipping;

        //call makeItemListmethod and store the classes items array property to create
        //paypal itemList object
        $this->makeItemList();

    }

    /**
     *
     * static function to help convert cents to dollar currency
     * @param $value
     * @return string
     */
    public static function convertCurrency($value)
    {
        return number_format(($value / 100), 2, '.', ' ');
    }

    /**
     * create paypal object itemList
     */
    public function makeItemList()
    {
        $this->itemList = new ItemList();
        $this->itemList->setItems($this->items);
    }

    /**
     * create paypal object details
     */
    public function setDetails()
    {
        $this->details = new Details();
        $this->details->setShipping(self::convertCurrency($this->shipping))
            ->setSubtotal(self::convertCurrency($this->subtotal));
    }

    /**
     * create paypal object amount
     */
    public function setAmount()
    {
        $this->amount = new Amount();
        $this->amount->setCurrency('USD')
            ->setTotal(self::convertCurrency($this->total))
            ->setDetails($this->details);
    }

    /**
     * create paypal object transaction
     */
    public function makeTransaction()
    {
        $this->transaction = new Transaction();
        $this->transaction->setAmount($this->amount)
            ->setItemList($this->itemList)
            ->setDescription('Order From BugwildFlyCo.');
    }

    /**
     * create paypal object redirecturls
     * this is where paypal will redirect after transaction
     */
    public function redirectUrls()
    {
        $this->redirectUrls = new RedirectUrls();
        $this->redirectUrls->setReturnUrl(url('/payment'))
            ->setCancelUrl(url('/payment'));
    }

    /**
     * create paypal object payment
     */
    public function createPayment()
    {
        $this->payment = new Payment();
        $this->payment->setIntent('sale')
            ->setPayer($this->payer)
            ->setRedirectUrls($this->redirectUrls)
            ->setTransactions(array($this->transaction));
    }

    /**
     * after transaction has been sent to paypal, it will post get request to site
     * defined in redirectUrl object, this get request will contain token,payerid
     * to indicate success/fail/cancel state with transaction
     * @param $request
     * @return int
     */
    public function getStatus($request)
    {
        $payment_id = Session::get('paypal_payment_id');
        $pay = Payment::get($payment_id, $this->api_context);
        Session::forget('paypal_payment_id');

        //actually process and execute the payment
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);

        //will recieve a response
        $result = $pay->execute($execution, $this->api_context);
        $json = json_decode($result);

        //if response contains success state, persist order
        //otherwise flush session and return 0 to indicate failure
        if ($result->getState() == 'approved') { // payment made
            $redir = $this->persistOrder($json);
        } else {
            Session::flush();
            return 0;
        }

        return $redir;

    }

    /**
     *
     * create order for local database if payment was successful
     * uses order stored in session and data returned as
     * some ungodly json from paypal
     * @param $json
     * @return int
     */
    public function persistOrder($json)
    {
        //instantiate new order
        $order = new Order;
        //include bugwild's base shipping price from the start
        $orderTotal = 700;
        //loop through the orderitems and generate an order total
        foreach (session('items') as $item) {
            $orderTotal += $item['price_as_config'];
        }

        //save relevant order details
        $order->paypal_total = $json->transactions[0]->amount->total;
        $order->paypal_status = $json->state;
        $order->trans_id = $json->transactions[0]->related_resources[0]->sale->id;
        $this->paypalTrans = $json->transactions[0]->related_resources[0]->sale->id;
        //iff special instructions were provided, save them on the order object
        if (session('special')) {
            $order->special = session('special');
            $this->specialInstructions = session('special');
        }
        $order->shipped = 0;
        $order->total = self::convertCurrency($orderTotal);

        //save the order
        $order->save();
        $this->orderId = $order->id;

        //save each individual configured item to the db, and then create relationship
        //with the associated order
        foreach (session('items') as $item) {
            $product = new OrderItems;
            $product->title = $item['product_title'];
            $product->quantity = $item['quantity'];
            $product->color = $item['color'];
            $product->size = $item['size'];
            $product->total = self::convertCurrency($item['price_as_config']);
            $product->save();
            $order->items()->save($product);
        }

        //remove session data
        Session::flush();
        Session::put('orderId', $this->orderId);
        Session::put('total', $orderTotal);
        Session::put('special', $this->specialInstructions);
        Session::put('transId', $this->paypalTrans);

        //return 1 for order success
        return 1;

    }

} //end PostService class
