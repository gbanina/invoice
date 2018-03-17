<?php

namespace App\Http\Helper;

class InvoiceHelp {

  public static function currencies(){
    return array('EUR'=>'EUR', 'GBP'=>'GBP', 'HRK'=>'HRK', 'USD'=>'USD');
  }

  public static function pdfApiURL($htmlURL){

    if(env('APP_DEBUG', false)){
      $htmlURL = "https://pdflayer.com/downloads/invoice.html";
    }

    $url = "http://api.pdflayer.com/api/convert?access_key=";
    $url .= env('PDFLAYER_API', false);
    $url .= "&document_url=" . $htmlURL;
    $url .= "&page_size=A4";
    if(env('APP_DEBUG', false)||true){
      $url .= "&test=1";
    }

    return $url;
  }

}
