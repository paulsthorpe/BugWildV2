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
| Paypal Class
|--------------------------------------------------------------------------
|
| Provides useful static functions to use throught the appliction to assist in
| storing, sorting and displaying blog post data
|
|
*/

class PaypalService {

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
  public $approvalUrl;
  public $dbItems = [];

  public function __construct(){
    $this->api_context = new ApiContext(new OAuthTokenCredential(env('PAYPAL_CLIENT'), env('PAYPAL_SECRET')));
    $this->api_context->setConfig(Config::get('paypal.settings'));
  }

  public function createOrder(){

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






 public function getStatus($request){
   $payment_id = Session::get('paypal_payment_id');
   $pay = Payment::get($payment_id, $this->api_context);
   Session::forget('paypal_payment_id');

   $execution = new PaymentExecution();
   $execution->setPayerId($request->PayerID);

   $result = $pay->execute($execution, $this->api_context);
   $json = json_decode($result);


   if ($result->getState() == 'approved') { // payment made
     $this->persistOrder($json);
   } else {
     dd('failed');
   }

  }







 public static function convertCurrency($value){
   return number_format(($value /100), 2, '.', ' ');
 }

 public function setPayer(){
   $this->payer = new Payer();
   $this->payer->setPaymentMethod('paypal');
 }

 public function createItemsArray(){

   foreach(session('items') as $item){
     $product = new Item();
     $product->setName($item['product_title'])
          ->setCurrency('USD')
          ->setQuantity($item['quantity'])
          ->setPrice( self::convertCurrency($item['base_price'] + $item['upcharge']));
     array_push($this->items , $product);
     $this->subtotal += $item['price_as_config'];
   }

   $this->total = $this->subtotal + $this->shipping;

   $this->makeItemList();

 }

 public function setDetails(){
   $this->details = new Details();
   $this->details->setShipping(self::convertCurrency($this->shipping))
           ->setSubtotal(self::convertCurrency($this->subtotal));
 }

 public function setAmount(){
   $this->amount = new Amount();
   $this->amount->setCurrency('USD')
          ->setTotal(self::convertCurrency($this->total))
          ->setDetails($this->details);
 }

 public function makeTransaction(){
   $this->transaction = new Transaction();
   $this->transaction->setAmount($this->amount)
               ->setItemList($this->itemList)
               ->setDescription('Order From BugwildFlyCo.');
 }

 public function makeItemList(){
   $this->itemList = new ItemList();
   $this->itemList->setItems($this->items);
 }

 public function redirectUrls(){
   $this->redirectUrls = new RedirectUrls();
   $this->redirectUrls->setReturnUrl(url('/payment'))
        ->setCancelUrl(url('/payment'));
 }

 public function createPayment(){
   $this->payment = new Payment();
   $this->payment->setIntent('sale')
       ->setPayer($this->payer)
       ->setRedirectUrls($this->redirectUrls)
       ->setTransactions(array($this->transaction));
 }

 public function persistOrder($json){
   $order = new Order;
   $orderTotal = 700;

   foreach(session('items') as $item){
     $orderTotal += $item['price_as_config'];
   }

   $order->paypal_total = $json->transactions[0]->amount->total;
   $order->paypal_status = $json->state;
   $order->trans_id = $json->transactions[0]->related_resources[0]->sale->id;
   if(session('special')){
     $order->special = session('special');
   }
   $order->shipped = 0;
   $order->total = self::convertCurrency($orderTotal);

   $order->save();

   foreach(session('items') as $item){
     $product = new OrderItems;
     $product->title = $item['product_title'];
     $product->quantity = $item['quantity'];
     $product->color = $item['color'];
     $product->size = $item['size'];
     $product->total = self::convertCurrency($item['price_as_config']);
     $product->save();
     $order->items()->save($product);
   }

 }

} //end PostService class
