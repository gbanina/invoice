<?php

namespace App\Http\Helper;
use Auth;
use DNS2D;
use App\Models\Invoice;
use App\Models\MyData;

class BarcodeHelp {

  public static function barcode(\App\Models\Invoice $invoice){

      $myData = MyData::find(Auth::user()->id);

      $zaglavlje = "HRVHUB30\n";  //8
      $valuta = "HRK\n";          //3
      $iznos = BarcodeHelp::price($invoice->total);  //"000000000000100\n"; // 1kn  //15
      $naziv_platitelj = BarcodeHelp::text($invoice->customer->name, 30);              //30
      $adresa_platitelj_ulica = BarcodeHelp::text($invoice->customer->adress,27);       //27
      $adresa_platitelj_mjesto = BarcodeHelp::text("-",27);      //27
      $naziv_primatelj = BarcodeHelp::text($myData->name, 25);//"Ivo Ivic                 \n";              //25
      $adresa_primatelj_ulica = BarcodeHelp::text($myData->street, 25);//"Adolfa Hitlera 9         \n";       //25
      $adresa_primatelj_mjesto = BarcodeHelp::text($myData->zip . " " . $myData->city , 27); //"10000 Zagreb               \n";      //27
      $iban = BarcodeHelp::text($myData->iban, 21);//"HR1210010051863000160\n";                         //21
      $model_racuna = "HR99\n";                 //4
      $poziv_na_broj_primatelja = BarcodeHelp::text("", 22);     //22
      $sifra_namjene = "COST\n";                //4
      $opis_placanja = BarcodeHelp::text($myData->name . " račun br." . $invoice->number , 21);//"Troskovi za 1. mjesec              \n";                //35

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

      return DNS2D::getBarcodeSVG($code, "PDF417",0.85,0.5);
  }

  public static function price($price){
    $price = $price * 100;
    $price = str_repeat("0", 15 - strlen($price)) . $price . "\n";
    return $price;
  }

  public static function text($text, $lenght){
    $text = substr($text,0,$lenght-1);
    $text = $text . str_repeat(" ", $lenght - strlen($text)) . "\n";
    return $text;
  }

}
