<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\Models\MyData;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UpdateMyDataValidate;

class MyDataController extends Controller
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
    public function show()
    {
        $data = $this->findOrCreate(Auth::user()->id);
        $view = view('my-data.show');
        $view->with('data', $data);

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(UpdateMyDataValidate $request)
    {
        $data = MyData::find(Auth::user()->id);

        if(Input::file('image') != null){
            $name = (Input::file('image')->getClientOriginalName());
            $filePath = $request->file('image')->store('img');
            $data->image = $filePath;
        }

        $data->user_id = Auth::user()->id;
        $data->name = Input::get('name');
        $data->sufix = Input::get('sufix');
        $data->owner = Input::get('owner');
        $data->vat = Input::get('vat');
        $data->street = Input::get('street');
        $data->city = Input::get('city');
        $data->zip = Input::get('zip');
        $data->country = Input::get('country');
        $data->iban = Input::get('iban');
        $data->bank = Input::get('bank');

        $data->save();
        $request->session()->flash('status', 'Your Data has been successfully updated!');
        return Redirect::to('my-data');
    }

    private function findOrCreate($userId) {

        $data = MyData::find($userId);
        if($data != null)
            return $data;

        $data = new MyData();
        $data->user_id = $userId;
        $data->name = '';
        $data->sufix = '';
        $data->owner = '';
        $data->vat = '';
        $data->street = '';
        $data->city = '';
        $data->country = '';
        $data->iban = '';
        $data->bank = '';
        $data->zip = '';
        $data->save();

        return $data;
    }
}
