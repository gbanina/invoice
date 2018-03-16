@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Customer: {{$customer->name}}
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
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
                      {!! Form::model($customer, array('url' => url('customers/' . $customer->id), 'method' => 'PUT', 'class' => 'form-horizontal invoice-form')) !!}
                        <div class="form-group">
                          <label for="customerName">Customer Name</label>
                          <input type="text" class="form-control" id="customerName" name="name" value="{{$customer->name}}" placeholder="Customer name here">
                        </div>
                        <div class="form-group">
                          <label for="customerAdress">Customer Adress</label>
                          <input type="text" class="form-control" id="customerAdress" name="adress" value="{{$customer->adress}}" placeholder="Customer adress here">
                        </div>
                        <div class="form-group">
                          <label for="customerVat">Customer VAT</label>
                          <input type="text" class="form-control" id="customerVat" name="vat" value="{{$customer->vat}}" placeholder="Customer VAT here">
                        </div>
                        <div class="form-group">
                          <label for="customerEmail">Customer E-Mail Adress</label>
                          <input type="text" class="form-control" id="customerEmail" name="email" value="{{$customer->email}}" placeholder="Customer E-Mail here">
                        </div>
                        <div class="form-group">
                          {!! Form::submit('Save', array('class' => 'btn btn-default')) !!}
                        </div>
                      {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
