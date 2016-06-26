<?php

namespace App\Services;
use Session;
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

  //$siteURL CONFIG where paypal will redirect
  private $api_context;

  //subtotal starts at 700 to account for 7.00 shipping


  public function __construct(){
      // setup PayPal api context

  }


  public static function getStatus(){
    // $product = ;
    // $price = ;
    // $shipping = ;//rate
    //
    // $total = ;
    //
    $settings = array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    );
    $paypal_conf = config_path('paypal');
    $api_context = new ApiContext(new OAuthTokenCredential('AQJAxvgTnefORKSvmZSroBmoSnZ7Njb47nW8PnJddxHeeHEPSya2S67AADJkXTDGeB2uqLk1gxNPENa9', 'EKOMiX6f7qtkWiu6ZbyRXZoC2uxd3WqA44uPH54hRGrAeapWbTX1zEs8C-ymsrKTJQorbAnZTdKIEPXj'));
    $api_context->setConfig($settings);

    $payer = new Payer();
    $payer->setPaymentMethod('paypal');
    //
    $subtotal = 0;
    $items = [];
    foreach(session('items') as $item){
      $product = new Item();
      $product->setName($item['product_title'])
           ->setCurrency('USD')
           ->setQuantity($item['quantity'])
           ->setPrice( $item['base_price'] + $item['upcharge']);
      array_push($items,$product);
      $subtotal += $item['price_as_config'];
    }
    $total = $subtotal + 700;




    $itemList = new ItemList();
    $itemList->setItems($items);

    $details = new Details();
    $details->setShipping(700)
            ->setSubtotal($subtotal);//price+setShipping

    $amount = new Amount();
    $amount->setCurrency('USD')
           ->setTotal($total)
           ->setDetails($details);//subtotal order

    $transaction = new Transaction();
    $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription('Bugwild');//string dessc

    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl(url('/payment'))//domainurl . '?success=true'
        ->setCancelUrl(url('/payment'));//domainurl . '?success=true'

    $payment = new Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));

    // return print_r($payment);
// $request = clone $payment;
  // try {
     $payment->create($api_context);
  // } catch (\PayPal\Exception\PPConnectionException $e) {
  //    if (\Config::get('app.debug')) {
  //        echo "Exception: " . $e->getMessage() . PHP_EOL;
  //        $err_data = json_decode($e->getData(), true);
  //        exit;
  //    } else {
  //        die('There was an error handling the payment, please try again or contact paypal');
  //    }

     $approvalUrl = $payment->getApprovalLink();

    //  if(isset($approvalUrl)){
    //    echo $approvalUrl;
    //  } else {
    //    echo 'failed';
    //  }

$link = 'http://www.google.com';

    return \Redirect::away($link);

    //
    // return back()->with('error', 'Unknown error occurred');
 // }
  //
  //   $payment->create($paypal);
  //
  //   return $approvalUrl = $payment->getApprovalLink();
  //
  }
  //
  // public function items(){
  //
  // }
  //
  // public function details(){
  //
  // }
  //
  // public function amount(){
  //
  // }
  //
  // public function transactions(){
  //
  // }
  //
  // public function makePayment(){
  //
  // }

} //end PostService class
