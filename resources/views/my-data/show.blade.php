@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    My Data
                </div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      {{ session('status') }}
                    </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                      {!! Form::model($data, array('url' => url('my-data'), 'method' => 'PUT','files'=>'true', 'class' => 'form-horizontal invoice-form')) !!}
                        <div class="form-group">
                          <label for="name">Company Name</label>
                          <input type="text" class="form-control" name="name" value="{{$data->name}}" placeholder="Company Name here">
                        </div>
                        <div class="form-group">
                          <label for="sufix">Name Sufix</label>
                          <input type="text" class="form-control" name="sufix" value="{{$data->sufix}}" placeholder="Name Sufix here">
                        </div>
                        <div class="form-group">
                          <label for="owner">Owner</label>
                          <input type="text" class="form-control" name="owner" value="{{$data->owner}}" placeholder="Owner here">
                        </div>
                        <div class="form-group">
                          <label for="customerVat">VAT</label>
                          <input type="text" class="form-control" name="vat" value="{{$data->vat}}" placeholder="Your VAT no. here">
                        </div>
                        <div class="form-group">
                          <label for="street">Street</label>
                          <input type="text" class="form-control" name="street" value="{{$data->street}}" placeholder="Street here">
                        </div>
                        <div class="form-group">
                          <label for="city">City</label>
                          <input type="text" class="form-control" name="city" value="{{$data->city}}" placeholder="City here">
                        </div>
                        <div class="form-group">
                          <label for="zip">ZIP</label>
                          <input type="text" class="form-control" name="zip" value="{{$data->zip}}" placeholder="ZIP here">
                        </div>
                        <div class="form-group">
                          <label for="country">Country</label>
                          <input type="text" class="form-control" name="country" value="{{$data->country}}" placeholder="Country here">
                        </div>
                        <div class="form-group">
                          <label for="iban">IBAN</label>
                          <input type="text" class="form-control" name="iban" value="{{$data->iban}}" placeholder="IBAN here">
                        </div>
                        <div class="form-group">
                          <label for="bank">Bank</label>
                          <input type="text" class="form-control" name="bank" value="{{$data->bank}}" placeholder="Bank here">
                        </div>
                        <div class="form-group">
                          <label for="image">Logo</label>
                            {{Form::file('image',array('class' => 'form-control'))}}
                            <img src="{{ url('storage/'.$data->image) }}"/>
                        </div>
                        <div class="form-group">
                          {!! Form::submit('Update', array('class' => 'btn btn-default')) !!}
                        </div>
                      {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
