<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Storage;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\Models\MyData;
use App\Models\Invoice;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UpdateMyDataValidate;

class OverviewController extends Controller
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tax(Request $request)
    {

        $year = $request->input('year');

        if($year == null)
            $year = date('Y');

        $from1 = date($year . '-01-01');
        $to1 = date($year .'-03-31');

        $from2 = date($year . '-04-01');
        $to2 = date($year .'-06-30');

        $from3 = date($year . '-07-01');
        $to3 = date($year .'-09-30');

        $from4 = date($year . '-10-01');
        $to4 = date($year .'-12-31');

        $invoices1 = Invoice::where('user_id', Auth::user()->id)
        ->where("year", $year);

        $invoices1 = Invoice::where('user_id', Auth::user()->id)
        ->where("year", $year)->whereBetween('billing_date', [$from1, $to1])->sum("total");

        $invoices2 = Invoice::where('user_id', Auth::user()->id)
        ->where("year", $year)->whereBetween('billing_date', [$from2, $to2])->sum("total");

        $invoices3 = Invoice::where('user_id', Auth::user()->id)
        ->where("year", $year)->whereBetween('billing_date', [$from3, $to2])->sum("total");

        $invoices4 = Invoice::where('user_id', Auth::user()->id)
        ->where("year", $year)->whereBetween('billing_date', [$from4, $to4])->sum("total");


        $years = DB::table('invoices')->distinct()->get(['year']);
        $sum = $invoices1 + $invoices2 + $invoices3 + $invoices4;
        return view('overview.tax')->with('invoices1', $invoices1)->with('invoices2', $invoices2)
        ->with('invoices3', $invoices3)->with('invoices4', $invoices4)->with('years', $years)->with('year', $year)
            ->with('sum', $sum);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function turnover()
    {
        $data = $this->findOrCreate(Auth::user()->id);
        $view = view('my-data.show');
        $view->with('data', $data);

        return $view;
    }
}
