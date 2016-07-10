<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use Excel;
use Carbon\Carbon;
use Mail;

class Weekly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bugwild:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate weekly sales report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Excel $excel,Carbon $carbon)
    {
        parent::__construct();
        $this->excel = $excel;
        $this->carbon = $carbon;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $start = $this->carbon->now()->startOfWeek();
      $end = $this->carbon->now()->endOfWeek();
      $orders = Order::whereBetween('created_at', [$start, $end])->select('id', 'total', 'paypal_total', 'paypal_status', 'trans_id','shipped','created_at')->get();



      $this->excel::create('Orders_'.$end->toFormattedDateString() , function($excel) use($orders){


          $excel->sheet('Orders', function($sheet) use($orders){
            $total = 0;
            foreach($orders as $order){

                $total += $order->total;
                if($order->shipped === 1){
                  $order->shipped = 'SHIPPED';
                } else {
                  $order->shipped = 'PENDING';
                }
            }


            $sheet->fromArray($orders);

            $sheet->setFontSize(16);
            $sheet->setAutoSize(true);

            $sheet->prependRow(2,array(
              '',''
            ));
            $sheet->appendRow(array(
              '',''
            ));

            $sheet->appendRow(array(
              '','Total: $'. number_format(($total), 2, '.', ' ')
            ));


          });


      // and finally this little bit will save the file to storage/exports/*filename.xls

      })->store('xls');

      $file = storage_path().'/exports/Orders_'.$end->toFormattedDateString();
      $date = $end->toFormattedDateString();
      $email = [];

      Mail::send('email.test', ['email' => $email] , function ($message) use ($file,$date) {
      $message->subject('Weekly Report'.$date);
      $message->attach($file)
      ->to('bugwildflyco@gmail.com');
      });

    }
}
