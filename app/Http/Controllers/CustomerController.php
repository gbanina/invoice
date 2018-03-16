<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CreateCustomerValidate;

class CustomerController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::where('user_id', Auth::user()->id)->get();
        $view = view('customer.index');
        $view->with('customers', $customers);

        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('customer.create');
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerValidate $request)
    {
        $customer = new Customer();
        $customer->user_id = Auth::user()->id;
        $customer->name = Input::get('name');
        $customer->adress = Input::get('adress');
        $customer->vat = Input::get('vat');
        $customer->email = Input::get('email');

        $customer->save();
        $request->session()->flash('status', 'Customer "'.$customer->name.'" successfully created!');
        return Redirect::to('customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        $view = view('customer.edit');
        $view->with('customer', $customer);

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCustomerValidate $request, $id)
    {
        $customer = Customer::find($id);

        $customer->name = Input::get('name');
        $customer->adress = Input::get('adress');
        $customer->vat = Input::get('vat');
        $customer->email = Input::get('email');

        $customer->save();
        $request->session()->flash('status', 'Customer "'.$customer->name.'" successfully updated!');
        return Redirect::to('customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $customer = Customer::find($id);
        $name = $customer->name;

        $customer->delete();
        $request->session()->flash('status', 'Customer "'.$name.'" successfully deleted!');
        return Redirect::to('customers');
    }
}
