<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>ReInvoice</title>

    <style>
  body {
    margin: 0;
  }
    .invoice-box{
        margin:auto;
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }

    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }

    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }

    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }

    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }

    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }

    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }

    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }

    .invoice-box table tr.details td{
        padding-bottom:20px;
    }

    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }

    .invoice-box table tr.item.last td{
        border-bottom:none;
    }

    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }

        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">

            <tr class="top">

                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ url('storage/'.$myData->image) }}" style="width:145px;height:32px">
                            </td>

                            <td>
                                {{ucfirst($myData->sufix)}}<br>
                                vl. {{$myData->owner}}<br>
                                {{' VAT NR: HR  ' . $myData->vat}}<br>
                                {{$myData->street . ', ' . $myData->zip . ' ' . $myData->city . ', ' . $myData->country}}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                <strong>
                  {{$invoice->customer->name}}<br>
                  {{$invoice->customer->adress}}<br>
                  {{'OIB: ' . $invoice->customer->vat}}
                </strong>
                            </td>

                            <td>
                                <strong>Račun br. {{$invoice->number . '/1/1'}}</strong><br>
                                OIB: {{$myData->vat}}<br>
                <br>
                {{$myData->city}}: {{$invoice->getIssueDate()}}<br>
                Dospjeće: {{$invoice->getBillingDate()}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Vrsta Plaćanja
                </td>

                <td>

                </td>
            </tr>

            <tr class="details">
                <td>
                    virmanom
                </td>

                <td>

                </td>
            </tr>

            <tr class="heading">
                <td>
                    Usluga
                </td>

                <td>
                    Cijena
                </td>
            </tr>
            @foreach($items as $item)
            <tr class="item @if($loop->last) {{' last'}} @endif">
                <td>
                    {{$item['desc']}}
                </td>

                <td>
                    {{$item['price'] . ' ' . $invoice->currency}}
                </td>
            </tr>
            @endforeach

            <tr class="total">
                <td></td>

                <td>
                   Ukupno: {{$invoice->total . ' ' . $invoice->currency}}
                </td>
            </tr>
      <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                <strong>
                  <small>
                  Oslobođeno plaćanja PDV-a po članku 90. zakona o PDV-u.
                  </small>
                </strong>

                            </td>

                            <td>
                                <!-- under right -->
                            </td>
                        </tr>
            <tr>
                            <td class="footer-info">
              <br>
              <br>
                USER: &emsp;&emsp; {{$myData->name . ', ' . $myData->sufix . ', vl.' . $myData->owner . ', ' . $myData->street . ', ' . $myData->zip . ' '. $myData->city . ', ' . $myData->country}}<br>
                BANK: &emsp;&emsp; {{$myData->bank}} <br>
                IBAN:&ensp;  &emsp;&emsp; {{$myData->iban}} <br>

                            </td>

                            <td>
                                <!-- under right -->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
      <tr class="information footer-issued">
        <td colspan="3">
          <br>
          <br>
          Račun izdao: {{$myData->owner}}
        <td>
      </tr>
        </table>
    </div>
</body>
</html>
