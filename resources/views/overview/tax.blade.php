@extends('overview.tax-wrapper')

@section('content')

<TABLE cellpadding=0 cellspacing=0 class="t1">
<TR>
  <TD class="tr0 td13"><P class="p8 ft5">&nbsp;</P></TD>
  <TD colspan=3 class="tr0 td14"><P class="p12 ft0">POREZNO</P></TD>
  <TD rowspan=2 class="tr7 td15"><P class="p13 ft0">BROJ ZAPOSLENIH</P></TD>
  <TD class="tr0 td16"><P class="p14 ft0">PRIMICI NAPLAĆENI U</P></TD>
  <TD class="tr0 td15"><P class="p15 ft0">PRIMICI NAPLAĆENI</P></TD>
  <TD class="tr0 td15"><P class="p16 ft0">UKUPNO NAPLAĆENI</P></TD>
  <TD class="tr0 td17"><P class="p16 ft0">UPLAĆENI POREZ NA</P></TD>
</TR>
<TR>
  <TD colspan=4 class="tr8 td18"><P class="p17 ft0">RAZDOBLJE</P></TD>
  <TD class="tr8 td19"><P class="p17 ft0">GOTOVINI</P></TD>
  <TD class="tr8 td20"><P class="p18 ft0">BEZGOTOVINSKIM</P></TD>
  <TD class="tr8 td20"><P class="p17 ft0">PRIMICI</P></TD>
  <TD class="tr8 td21"><P class="p18 ft0">DOHODAK I PRIREZ</P></TD>
</TR>
<TR>
  <TD class="tr3 td22"><P class="p8 ft5">&nbsp;</P></TD>
  <TD colspan=3 class="tr3 td23"><P class="p19 ft0">(KVARTALI)</P></TD>
  <TD class="tr3 td20"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr3 td19"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr3 td20"><P class="p20 ft0">PUTEM</P></TD>
  <TD class="tr3 td20"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr3 td21"><P class="p18 ft0">POREZU NA DOHODAK</P></TD>
</TR>
<TR>
  <TD class="tr9 td24"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr9 td25"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr9 td26"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr9 td27"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr9 td28"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr9 td29"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr9 td28"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr9 td28"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr9 td30"><P class="p8 ft5">&nbsp;</P></TD>
</TR>
<TR>
  <TD class="tr10 td31"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr10 td32"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr10 td33"><P class="p21 ft0">1</P></TD>
  <TD class="tr10 td34"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr10 td35"><P class="p22 ft0">2</P></TD>
  <TD class="tr10 td36"><P class="p18 ft0">3</P></TD>
  <TD class="tr10 td35"><P class="p17 ft0">4</P></TD>
  <TD class="tr10 td35"><P class="p18 ft7">5</P></TD>
  <TD class="tr10 td37"><P class="p17 ft7">6</P></TD>
</TR>
<TR>
  <TD colspan=4 class="tr11 td18"><P class="p23 ft0">1.1. – 31. 3.</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">0</P></TD>
  <TD class="tr11 td39"><P class="p22 ft0">0kn</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">{{$invoices1}}kn</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">{{$invoices1}}kn</P></TD>
  <TD class="tr11 td40"><P class="p22 ft0">0kn</P></TD>
</TR>
<TR>
  <TD class="tr12 td24"><P class="p8 ft8">&nbsp;</P></TD>
  <TD class="tr12 td25"><P class="p8 ft8">&nbsp;</P></TD>
  <TD class="tr12 td26"><P class="p8 ft8">&nbsp;</P></TD>
  <TD class="tr12 td27"><P class="p8 ft8">&nbsp;</P></TD>
  <TD class="tr12 td35"><P class="p8 ft8">&nbsp;</P></TD>
  <TD class="tr12 td36"><P class="p8 ft8">&nbsp;</P></TD>
  <TD class="tr12 td35"><P class="p8 ft8">&nbsp;</P></TD>
  <TD class="tr12 td35"><P class="p8 ft8">&nbsp;</P></TD>
  <TD class="tr12 td37"><P class="p8 ft8">&nbsp;</P></TD>
</TR>
<TR>
  <TD class="tr10 td22"><P class="p24 ft0">1.</P></TD>
  <TD class="tr10 td41"><P class="p24 ft0">4.</P></TD>
  <TD class="tr10 td42"><P class="p25 ft0">– 30.</P></TD>
  <TD class="tr10 td43"><P class="p26 ft0">6.</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">0</P></TD>
  <TD class="tr11 td39"><P class="p22 ft0">0kn</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">{{$invoices2}}kn</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">{{$invoices2}}kn</P></TD>
  <TD class="tr11 td40"><P class="p22 ft0">0kn</P></TD>
</TR>
<TR>
  <TD class="tr13 td24"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td25"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td26"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td27"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td35"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td36"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td35"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td35"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td37"><P class="p8 ft9">&nbsp;</P></TD>
</TR>
<TR>
  <TD class="tr14 td22"><P class="p24 ft0">1.</P></TD>
  <TD class="tr14 td41"><P class="p24 ft0">7.</P></TD>
  <TD class="tr14 td42"><P class="p25 ft0">– 30.</P></TD>
  <TD class="tr14 td43"><P class="p26 ft0">9.</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">0</P></TD>
  <TD class="tr11 td39"><P class="p22 ft0">0kn</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">{{$invoices3}}kn</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">{{$invoices3}}kn</P></TD>
  <TD class="tr11 td40"><P class="p22 ft0">0kn</P></TD>
</TR>
<TR>
  <TD colspan=2 class="tr8 td44"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td26"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td27"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td35"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td36"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td35"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td35"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td37"><P class="p8 ft5">&nbsp;</P></TD>
</TR>
<TR>
  <TD colspan=2 class="tr10 td45"><P class="p24 ft0">1. 10.</P></TD>
  <TD class="tr10 td42"><P class="p25 ft0">– 31.</P></TD>
  <TD class="tr10 td43"><P class="p26 ft0">12.</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">0</P></TD>
  <TD class="tr11 td39"><P class="p22 ft0">0kn</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">{{$invoices4}}kn</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">{{$invoices4}}kn</P></TD>
  <TD class="tr11 td40"><P class="p22 ft0">0kn</P></TD>
</TR>
<TR>
  <TD colspan=4 class="tr13 td46"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td35"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td36"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td35"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td35"><P class="p8 ft9">&nbsp;</P></TD>
  <TD class="tr13 td37"><P class="p8 ft9">&nbsp;</P></TD>
</TR>
<TR>
  <TD colspan=4 class="tr14 td18"><P class="p27 ft0">UKUPNO</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">0</P></TD>
  <TD class="tr11 td39"><P class="p22 ft0">0kn</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">{{$sum}}kn</P></TD>
  <TD class="tr11 td38"><P class="p22 ft0">{{$sum}}kn</P></TD>
  <TD class="tr11 td40"><P class="p22 ft0">0kn</P></TD>
</TR>
<TR>
  <TD class="tr8 td24"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td25"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td26"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td27"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td35"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td36"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td35"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td35"><P class="p8 ft5">&nbsp;</P></TD>
  <TD class="tr8 td37"><P class="p8 ft5">&nbsp;</P></TD>
</TR>
</TABLE>

@endsection
