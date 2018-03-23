<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\MyData;
use App\Models\Customer;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateInvoiceValidate;
use App\Http\Helper\InvoiceHelp;
use Illuminate\Support\Facades\Hash;
use DB;

class InvoiceController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $btnColor = array('Created' => 'btn-primary', 'Pending' => 'btn-danger', 'Paid' => 'btn-success');
        $invoices = Invoice::where('user_id', Auth::user()->id)->get();
        return view('invoice.index')->with('invoices', $invoices)->with('btnColor', $btnColor);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$invoiceNo = Invoice::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first()->get();
        $last = DB::table('invoices')->latest()->first();
        if($last != null){
            $invoiceNo = $last->number + 1;
            $currency = $last->currency;
        }
        else{
            $invoiceNo = 1;
            $currency = 'HRK';
        }

        $year = date('Y');
        $customers = Customer::where('user_id', Auth::user()->id)
                        ->pluck('name', 'id')->prepend('Choose customer', '');
        return view('invoice.create')->with('customers', $customers)->with('invoiceNo', $invoiceNo)
                        ->with('year', $year)->with('currency', $currency)->with('currencies', InvoiceHelp::currencies());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInvoiceValidate $request)
    {
        $invoice = new Invoice();
        $invoice->user_id = Auth::user()->id;
        $invoice->number = Input::get('number');
        $invoice->customer_id = Input::get('customer_id');
        $invoice->issue_date = Input::get('issue_date');
        $invoice->billing_date = Input::get('billing_date');
        $invoice->year = Input::get('year');
        $invoice->currency = Input::get('currency');

        $hash = /*Hash::make*/(time() . Auth::user()->id);
/*
        $hash = str_replace('&', '', $hash);
        $hash = str_replace('.', '', $hash);
        $hash = str_replace('?', '', $hash);
        $hash = str_replace('/', '', $hash);
*/
        $invoice->hash = $hash;

        $items = array();
        $descriptions = Input::get('item_desc');
        $prices = Input::get('item_price');
        $total = 0;
        foreach($descriptions as $key=>$val) {
            $items[$key]['desc'] = $descriptions[$key];
            $items[$key]['price'] = $prices[$key];
            $total += intval($prices[$key]);
        }

        $invoice->data = serialize($items);
        $invoice->total = $total;

        $invoice->save();

        return Redirect::to('invoice');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        $myData = MyData::find(Auth::user()->id);
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
    public function pubview($hash)
    {
        $invoice = Invoice::where('hash', $hash)->first();
        $myData = MyData::find($invoice->user_id);
        return view('design.02.index')->with('invoice', $invoice)
                        ->with('items', unserialize($invoice->data))
                            ->with('myData', $myData);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id);
        $customers = Customer::where('user_id', Auth::user()->id)
                        ->pluck('name', 'id')->prepend('Choose customer', '');
        return view('invoice.edit')->with('customers', $customers)->with('items', unserialize($invoice->data))
                ->with('currencies', InvoiceHelp::currencies())->with('invoice', $invoice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateInvoiceValidate $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->user_id = Auth::user()->id;
        $invoice->number = Input::get('number');
        $invoice->customer_id = Input::get('customer_id');
        $invoice->issue_date = Input::get('issue_date');
        $invoice->billing_date = Input::get('billing_date');
        $invoice->year = Input::get('year');
        $invoice->currency = Input::get('currency');

        $items = array();
        $descriptions = Input::get('item_desc');
        $prices = Input::get('item_price');
        $total = 0;
        foreach($descriptions as $key=>$val) {
            $items[$key]['desc'] = $descriptions[$key];
            $items[$key]['price'] = $prices[$key];
            $total += intval($prices[$key]);
        }

        $invoice->data = serialize($items);
        $invoice->total = $total;

        $invoice->save();

        return Redirect::to('invoice');
    }

    private function pdfAttach($id)
    {
        $invoice = Invoice::find($id);
        $apiUrl = InvoiceHelp::pdfApiURL(\URL::to('i/'.$invoice->hash));
        $filename = 'invoice-'.time().'.pdf';
        $pdf = public_path() . '/storage/pdf/' . $filename;//tempnam(public_path() . '/storage/pdf/', $filename);
        copy($apiUrl, $pdf);

        return $pdf;
    }

    public function pdfDownload($id)
    {
        $pdf = $this->pdfAttach($id);
        return response()->download($pdf, 'invoice.pdf');
    }

    public function email($id)
    {
        $invoice = Invoice::find($id);
        $attach = $this->pdfAttach($id);
        $email = $invoice->customer->email;
        $number = $invoice->getNumberHuman();

        $my = MyData::find(Auth::user()->id);

        $data = [
            'customer_name' => $invoice->customer->name,
            'my_name' => $my->owner,
            'paid_link' => \URL::to('p/' . $invoice->hash),
            'invoice_number' => $invoice->getNumberHuman(),
        ];

        $response = Mail::send('email.send', $data , function ($message) use ($email, $attach, $number)
        {
            $message->subject('You have a new invoice!');
            $message->from('postmaster@invoice.recode.hr', 'ReInvoices ' . $number);
            $message->to($email);
            $message->attach($attach);
        });
        $invoice->status = "Pending";
        $invoice->save();

        return Redirect::to('invoice');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $name = $invoice->id;

        $invoice->delete();
        $request->session()->flash('status', 'Invoice :#"'.$name.'" successfully deleted!');

        return Redirect::to('invoice');
    }
}
