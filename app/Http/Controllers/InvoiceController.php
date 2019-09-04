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
use Pdf;
use DNS2D;

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
    public function index(Request $request)
    {
      $zaglavlje = "HRVHUB30\n";  //8
      $valuta = "HRK\n";          //3
      $iznos = "000000000000100\n"; // 1kn  //15
      $naziv_platitelj = "Goran Banina                  \n";              //30
      $adresa_platitelj_ulica = "Vidovecka 9                \n";       //27
      $adresa_platitelj_mjesto = "42000 Varazdin             \n";      //27
      $naziv_primatelj = "Ivo Ivic                 \n";              //25
      $adresa_primatelj_ulica = "Adolfa Hitlera 9         \n";       //25
      $adresa_primatelj_mjesto = "10000 Zagreb               \n";      //27
      $iban = "HR1210010051863000160\n";                         //21
      $model_racuna = "HR01\n";                 //4
      $poziv_na_broj_primatelja = "7269-68949637676-00019\n";     //22
      $sifra_namjene = "COST\n";                //4
      $opis_placanja = "Troskovi za 1. mjesec              \n";                //35

      /*
      var_dump(strlen($zaglavlje));
      var_dump(strlen($valuta));
      var_dump(strlen($naziv_platitelj));
      var_dump(strlen($adresa_platitelj_ulica));
      var_dump(strlen($adresa_platitelj_mjesto));
      var_dump(strlen($naziv_primatelj));
      var_dump(strlen($adresa_primatelj_ulica));
      var_dump(strlen($adresa_primatelj_mjesto));
      var_dump(strlen($iban));
      var_dump(strlen($model_racuna));
      var_dump(strlen($poziv_na_broj_primatelja));
      var_dump(strlen($sifra_namjene));
      var_dump(strlen($opis_placanja));
*/

      $code = "";
      $code .= $zaglavlje;
      $code .= $valuta;
      $code .= $iznos;
      $code .= $naziv_platitelj;
      $code .= $adresa_platitelj_ulica;
      $code .= $adresa_platitelj_mjesto;
      $code .= $naziv_primatelj;
      $code .= $adresa_primatelj_ulica;
      $code .= $adresa_primatelj_mjesto;
      $code .= $iban;
      $code .= $model_racuna;
      $code .= $poziv_na_broj_primatelja;
      $code .= $sifra_namjene;
      $code .= $opis_placanja;


      //dd(strlen($code));
      //var_dump($code);
//dd($code);
      $barcode = (DNS2D::getBarcodeSVG($code, "PDF417",1.7,1));

        //$document = Pdf::generatePdf('<h1>Test</h1>');
        //pdf::stream('<h1>Test</h1>') ;

        //dd($document);

        $year = $request->input('year');

        if($year == null)
            $year = date('Y');

        $btnColor = array('Created' => 'btn-primary', 'Pending' => 'btn-danger', 'Paid' => 'btn-success');
        $invoices = Invoice::where('user_id', Auth::user()->id)
        ->where("year", $year);

        $years = DB::table('invoices')->distinct()->get(['year']);

        return view('invoice.index')->with('invoices', $invoices->get())->with('years', $years)
            ->with('sum', $invoices->sum('total'))->with('btnColor', $btnColor)->with('barcode', $barcode);
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
        //Pdf::stream(view('design.02.index')->with('invoice', $invoice)
          //              ->with('items', unserialize($invoice->data))
            //                ->with('myData', $myData));

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
        $invoice->bank_statement_id = Input::get('bank_statement_id');

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
