<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count = Invoice::count();
        //Example 1

        // $chartjs = app()->chartjs
        // ->name('lineChartTest')
        // ->type('line')
        // ->size(['width' => 400, 'height' => 200])
        // ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
        // ->datasets([
        //     [
        //         "label" => "My First dataset",
        //         'backgroundColor' => "rgba(38, 185, 154, 0.31)",
        //         'borderColor' => "rgba(38, 185, 154, 0.7)",
        //         "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
        //         "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
        //         "pointHoverBackgroundColor" => "#fff",
        //         "pointHoverBorderColor" => "rgba(220,220,220,1)",
        //         'data' => [65, 59, 80, 81, 56, 55, 40],
        //     ],
        //     [
        //         "label" => "My Second dataset",
        //         'backgroundColor' => "rgba(38, 185, 154, 0.31)",
        //         'borderColor' => "rgba(38, 185, 154, 0.7)",
        //         "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
        //         "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
        //         "pointHoverBackgroundColor" => "#fff",
        //         "pointHoverBorderColor" => "rgba(220,220,220,1)",
        //         'data' => [12, 33, 44, 44, 55, 23, 40],
        //     ]
        // ])
        // ->options([]);
        $count_invoices1 = Invoice::where('value_status', 1)->count();
        $count_invoices2 = Invoice::where('value_status', 2)->count();
        $count_invoices3 = Invoice::where('value_status', 3)->count();

        if($count_invoices2 == 0){
            $unPaid=0;
        }
        else{
            $unPaid = $count_invoices2/ $count*100;
        }

          if($count_invoices1 == 0){
              $paid=0;
          }
          else{
              $paid = $count_invoices1/ $count*100;
          }

          if($count_invoices3 == 0){
              $partiallyPaid=0;
          }
          else{
              $partiallyPaid = $count_invoices3/ $count*100;
          }

        //Example 2
        $chartjsBar = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 300, 'height' => 200])
         ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
         ->datasets([
             [
                 "label" => "الفواتير الغير المدفوعة",
                 'backgroundColor' => ['#ec5858'],
                 'data' => [$unPaid]
             ],
             [
                 "label" => "الفواتير المدفوعة",
                 'backgroundColor' => ['#81b214'],
                 'data' => [$paid]
             ],
             [
                 "label" => "الفواتير المدفوعة جزئيا",
                 'backgroundColor' => ['#ff9642'],
                 'data' => [$partiallyPaid]
             ],
         ])
         ->options([]);

        //Example 3

        $chartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
        ->datasets([
            [
                "label" => "الفواتير الغير المدفوعة",
                'backgroundColor' => ['#ec5858'],
                'hoverBackgroundColor' => ['#761905'],
                'data' => [$unPaid]
            ],
            [
                "label" => "الفواتير المدفوعة",
                'backgroundColor' => ['#81b214'],
                'hoverBackgroundColor'=>['#137605'],
                'data' => [$paid]
            ],
            [
                "label" => "الفواتير المدفوعة جزئيا",
                'backgroundColor' => ['#ff9642'],
                'hoverBackgroundColor'=>['#AF6720'],

                'data' => [$partiallyPaid]
            ],
        ])
        ->options([]);



        return view('home',compact('count','chartjs','chartjsBar'));
    }
}
