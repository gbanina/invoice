@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Invoice
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
                      {!! Form::model($invoice, array('url' => url('/invoice/' . $invoice->id), 'method' => 'PUT', 'class' => 'form-horizontal invoice-form')) !!}
                        <div class="col-md-4">
                            <div class="form-group invoice-doubble">
                              <label for="number">Invoice Number</label>
                              <input type="number" class="form-control" name="number" value="{{ $invoice->number }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group invoice-doubble">
                              <label for="year">Year</label>
                              <input type="number" class="form-control" name="year" value="{{ $invoice->year }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="customerName">Curency</label>
                            {{ Form::select('currency', $currencies, $invoice->curency , ['class' => 'form-control']) }}
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="customerName">Customer</label>
                            {{ Form::select('customer_id', $customers, $invoice->customer->id , ['class' => 'form-control']) }}
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="customerName">Bank Statement Number</label>
                            <input type="text" class="form-control" name="bank_statement_id" value="{{ $invoice->bank_statement_id }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group  invoice-doubble">
                            <label for="issue_date">Issue Date</label>
                            <input type="text" class="form-control datepicker" name="issue_date" value="{{ $invoice->issue_date }}" placeholder="Issue Date Here">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="billing_date">Billing Date</label>
                            <input type="text" class="form-control datepicker" name="billing_date" value="{{ $invoice->billing_date }}" placeholder="Billing Date Here">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="items">Items</label>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Description</th>
                                  <th scope="col">Price</th>
                                  <th scope="col"></th>
                                </tr>
                              </thead>
                              <tbody id="itemsWrapper">
                              </tbody>
                            </table>
                            <label><a href="#" onClick="newItem()">Add Item <span class="glyphicon glyphicon-plus"></span></a></label>
                          </div>
                        </div>
                        <div class="form-group">
                          {!! Form::submit('Update', array('class' => 'btn btn-default')) !!}
                          <!--<a href="" class="btn btn-default">Preview</a>-->
                        </div>
                      {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
  <script>
    @foreach($items as $item)
      newItem('{{$item['desc']}}','{{$item['price']}}');
    @endforeach

    $( function() {
      $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });

  function newItem(desc, price) {

    var elementNo = $("#itemsWrapper tr").length + 1;

    html = '<tr id="item_no_'+elementNo+'">';
    html +='  <th scope="row" class="invoice-item-number">'+elementNo+'</th>';
    html +='  <td><input type="text" class="form-control" name="item_desc[]" value="'+desc+'"></td>';
    html +='  <td><input type="number" class="form-control" name="item_price[]" value="'+price+'"></td>';
    html +='  <td>';
    html +='    <a href="#" onClick="deleteItem(\'item_no_'+elementNo+'\')" class="glyphicon glyphicon-remove invoice-item-icon" aria-hidden="true">';
    html +='  </td>';
    html +='</tr>';
    $('#itemsWrapper').append( html );
  }
  function deleteItem(id) {
    $( "#"+id ).remove();
  }
  </script>
@endsection
