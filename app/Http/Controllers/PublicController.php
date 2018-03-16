<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\MyData;
use Illuminate\Support\Facades\Input;

class PublicController extends Controller
{
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
        return view('design.02.index')->with('invoice', $invoice)
                        ->with('items', unserialize($invoice->data))
                            ->with('myData', $myData);
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
