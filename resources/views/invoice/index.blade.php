@extends('layouts.app')

@section('content')
<style>
.year_picker{
    text-decoration: none !important;
    color: #949292 !important;
    font-size: small !important;
}
</style>
{!! $barcode !!}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    My Invoices
                    @foreach($years as $year)
                      <small><a class="year_picker" href="{{ url('/invoice/?year='.$year->year) }}">{{$year->year}}</a></small>
                    @endforeach

                    <div class="float-right"><a href="{{ url('/invoice/create') }}" type="button" class="btn btn-default btn-sm">Add New Invoice</a></div>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      {{ session('status') }}
                    </div>
                    @endif

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Status</th>
                          <th scope="col">Year</th>
                          <th scope="col">Customer</th>
                          <th scope="col">Issue Date</th>
                          <th scope="col">Billing Date</th>
                          <th scope="col">Total</th>
                          <th scope="col">Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                          <th scope="row">{{$invoice->number}}/1/1</th>
                          <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-xs {{$btnColor[$invoice->status]}} dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{$invoice->status}} <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a href="{{ url('invoice-send/'.$invoice->id) }}">Send Invoice</a></li>
                                <li><a href="{{ url('invoice-download/'.$invoice->id) }}">Download</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Archive</a></li>
                              </ul>
                            </div>



                          </td>
                          <td>{{$invoice->year}}</td>
                          <td>{{$invoice->customer->name}}</td>
                          <td>{{$invoice->issue_date}}</td>
                          <td>{{$invoice->billing_date}}</td>
                          <td>{{$invoice->total}} {{$invoice->currency}}</td>
                          <td class="edit-wrap">
                            <a href="{{ url('i/'.$invoice->hash) }}" target="_tab" class="glyphicon glyphicon-eye-open" aria-hidden="true"></a>
                            <a href="{{ url('invoice/'.$invoice->id.'/edit') }}" class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
                            {{ Form::open(array('url' => url('invoice/' . $invoice->id), 'method' => 'delete', 'id' => 'form-' . $invoice->id)) }}
                                  <a href="#" class="glyphicon glyphicon-remove"
                                                onclick="deleteCustomer('{{$invoice->number}}', '{{$invoice->id}}')">
                                </a>
                            {{ Form::close() }}
                          </td>
                        </tr>
                        @endforeach
                        <tr>
                          <th scope="row">Total:</th>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>{{$sum}}</td>
                          <td></td>
                      </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
  function deleteCustomer(name, form_id) {
    if (confirm('Are you sure you want to delete: '+name+' from your invoices?')) {
      document.getElementById('form-' + form_id).submit();
    } else {
      return false;
    }
  }
  var printWindow;
  function printAll(url){
    printWindow = window.open(url,'printWindow','width=900,height=600');
  }
</script>

@endsection
