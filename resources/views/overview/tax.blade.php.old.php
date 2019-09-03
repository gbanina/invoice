@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Izvješće o paušalnom dohotku od samostalne djelatnosti i uplaćenom paušalnom porezuna dohodak i prirezu poreza na dohodak u {{$year}} godini
                    <div class="float-right">Obrazac PO-SD</div>
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
                          <th scope="col">POREZNO RAZDOBLJE (KVARTALI)</th>
                          <th scope="col">BROJ ZAPOSLENIH</th>
                          <th scope="col">PRIMICI NAPLACENI U GOTOVINI</th>
                          <th scope="col">PRINICI NAPLAĆENI BEZGOTOVINSKIM PUTEM</th>
                          <th scope="col">UKUPNO NAPLAĆENI PRIMICI</th>
                          <th scope="col">UPLAĆEN POREZ NA DOHODAK I PRIREZ POREZU NA DOHODAK</th>
                        </tr>
                      </thead>
                      <tbody>
                         <!-- petlja -->
                        <tr>
                          <th scope="row">1.1. - 31.3.</th>
                          <td>0</td>
                          <td>0</td>
                          <td>{{$invoices1}}</td>
                          <td>{{$invoices1}}</td>
                          <td>x</td>
                        </tr>
                        <tr>
                          <th scope="row">1.4. 30.6.</th>
                          <td>0</td>
                          <td>0</td>
                          <td>{{$invoices2}}</td>
                          <td>{{$invoices2}}</td>
                          <td>x</td>
                        </tr>
                        <tr>
                          <th scope="row">1.7.30.9.</th>
                          <td>0</td>
                          <td>0</td>
                          <td>{{$invoices3}}</td>
                          <td>{{$invoices3}}</td>
                          <td>x</td>
                        </tr>
                        <tr>
                          <th scope="row">1.10.31.12</th>
                          <td>0</td>
                          <td>0</td>
                          <td>{{$invoices4}}</td>
                          <td>{{$invoices4}}</td>
                          <td>x</td>
                        </tr>
                        <!-- petlja -->

                        <tr>
                          <th scope="row">Total:</th>
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

@endsection
