<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\MyData;
use Illuminate\Support\Facades\Input;
use App\Http\Helper\BarcodeHelp;

class PublicController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($hash)
    {
        $customer = Customer::where('hash', $hash)->first();
        $invoices = Invoice::where('customer_id', $customer->id)->first();

        $myData = MyData::find($customer->user_id);
        return view('public.overview')->with('invoice', $invoice)
                        ->with('items', unserialize($invoice->data))
                            ->with('myData', $myData);
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($hash)
    {
        $invoice = Invoice::where('hash', $hash)->first();
        $myData = MyData::find($invoice->user_id);
        $barcode = BarcodeHelp::barcode($invoice);
        //$barcode = '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG( "4445645656", "PDF417",2,2) . '" alt="barcode"   />';

        return view('design.02.index')->with('invoice', $invoice)
                        ->with('items', unserialize($invoice->data))
                            ->with('myData', $myData)->with('barcode', $barcode);
    }

         /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paid($hash)
    {
        $invoice = Invoice::where('hash', $hash)->first();
        $invoice->status = "Paid";
        $invoice->save();

        return view('public.tnx');
    }
}
