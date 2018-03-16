@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Customers
                    <div class="float-right"><a href="{{ url('/customers/create') }}" type="button" class="btn btn-default btn-sm">Add New Customer</a></div>
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
                          <th scope="col"></th>
                          <th scope="col">Name</th>
                          <th scope="col">Adress</th>
                          <th scope="col">VAT</th>
                          <th scope="col">Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($customers as $customer)
                        <tr>
                          <th scope="row"></th>
                          <td>{{$customer->name}}</td>
                          <td>{{$customer->adress}}</td>
                          <td>{{$customer->vat}}</td>
                          <td class="edit-wrap">
                            <a href="{{ url('customers/'.$customer->id.'/edit') }}" class="glyphicon glyphicon-pencil" aria-hidden="true"></a>
                            {{ Form::open(array('url' => url('customers/' . $customer->id), 'method' => 'delete', 'id' => 'form-' . $customer->id)) }}
                                  <a href="#" class="glyphicon glyphicon-remove"
                                                onclick="deleteCustomer('{{$customer->name}}', '{{$customer->id}}')">
                                </a>
                            {{ Form::close() }}
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  function deleteCustomer(name, form_id) {
    if (confirm('Are you sure you want to delete: '+name+' from your customers?')) {
      document.getElementById('form-' + form_id).submit();
    } else {
      return false;
    }
  }
</script>
@endsection
