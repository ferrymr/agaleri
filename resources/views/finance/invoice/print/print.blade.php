<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cetak {{$title}}</title>
  <style>
    img {
      margin-top: -40px;
      margin-left: 45px;
    }
    .center {
      text-align: center;
    }

    td{
      font-size:60%;
    }

    td.x{
      font-size:60%;
    }

    th{
      font-size:60%;
    }

    table.x, th.x, td.x {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 2 2 2 2;
    }

    img {
      margin-top: -40px;
      margin-left: 0px;
    }

    table#table_head{
      margin-top: 15px;
    }

  </style>
</head>
<body>
  <table width="100%">
    <tr style="height:100px">
      <td width="10%" valign="bottom"><img src="{{public_path('/logo_only.png')}}" alt="Lunahouse.co.id"></td>
      <td width="90%" valign="top"><strong style="font-size:90% !important;">{{ strtoupper($name_company) }}</strong><br/>{{ $alamat }}<br/>{{ $telepon }}</td>
    </tr>
  </table>
  <hr>
  <table id="table_head" width="100%">
    <tr>
      <td class="a" width="20%" align="center">Kepada Yth : <br/> <strong style="font-size:90%;">{{ $data[0]->nama_costumer }}</strong></td>
      <td class="b" width="40%" align="center"><strong style="font-size:100%;">{{ $title }}</strong> <br/> {{ $data[0]->id }}</td>
      <td class="c" width="20%" align="right">Tanggal : {{ Carbon\Carbon::parse($data[0]->tanggal)->format('d M Y') }} <br /> Jatuh Tempo : {{ Carbon\Carbon::parse($data[0]->jatuh_tempo)->format('d M Y') }} <br/> Term Of Payment : {{ $data[0]->top }} Days</td>
    </tr>
  </table>
  <table id="table_detail" class="x table table-striped table-bordered table-hover" width="100%">
    <thead>
      <tr>
        <th class="x" align="center">No</th>
        <th class="x" align="center">Kode Barang</th>
        <th class="x" align="center">Description</th>
        <th class="x" align="center">QTY</th>
        <th class="x" align="center">Unit Price</th>
        <th class="x" align="center">DISC</th>
        <th class="x" align="center">Total Price (Rp)</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $d => $v)
      <tr>
        <td class="x" align="center">{{ $d+1 }}</td>
        <td class="x">{{ $v->kode_bj }}</td>
        <td class="x">{{ $v->name }}</td>
        <td class="x" align="right">{{ number_format($v->qty,2) }}</td>
        <td class="x" align="right"> {{ number_format($v->unit_price,2) }}</td>
        <td class="x" align="right"> {{ number_format($v->discount,2) }}</td>
        <td class="x" align="right"> {{ number_format($v->total_price,2) }}</td>
      </tr>
      @endforeach
      @for ($r = 0; $r < $row; $r++)
      <tr>
        <td class="x">&nbsp;</td>
        <td class="x">&nbsp;</td>
        <td class="x">&nbsp;</td>
        <td class="x">&nbsp;</td>
        <td class="x">&nbsp;</td>
        <td class="x">&nbsp;</td>
        <td class="x">&nbsp;</td>
      </tr>
      @endfor
      <tr style="border-bottom: 0 !important;">
        <td colspan="6" class="x" align="right">Sub Total &nbsp;&nbsp;&nbsp;</td>
        <td class="x" align="right"><strong> {{ number_format($data[0]->sub_total,2) }}<strong></td>
      </tr>
      <tr style="border-bottom: 0 !important;">
        <td colspan="6" class="x" align="right">DP &nbsp;&nbsp;&nbsp;</td>
        <td class="x" align="right"><strong> {{ number_format($data[0]->dp,2) }}<strong></td>
      </tr>
      <tr style="border-bottom: 0 !important;">
        <td colspan="6" class="x" align="right">PPH 10% &nbsp;&nbsp;&nbsp;</td>
        <td class="x" align="right"><strong> {{ number_format($data[0]->pph,2) }}<strong></td>
      </tr>
      <tr style="border-bottom: 0 !important;">
        <td colspan="6" class="x" align="right">Grand Total &nbsp;&nbsp;&nbsp;</td>
        <td class="x" align="right"><strong> {{ number_format($data[0]->grand_total,2) }}<strong></td>
      </tr>
    </tbody>
  </table>



    <table width="100%" style="margin-top:20px;">
      <tr><td><strong>Terbilang : </strong>{{ $data[0]->terbilang }}</td></tr>
    </table>
    <table width="100%" style="margin-top:10px;">
      <tr>
        <td width="20%" align="center">Penerima,</td>
        <td width="20%"></td>
        <td width="20%"></td>
        <td width="20%"></td>
        <td width="20%" align="center">Hormat Kami,</td>
      </tr>
      <tr><td></td><td></td><td></td><td></td><td></td></tr>
      <tr><td></td><td></td><td></td><td></td><td></td></tr>
      <tr><td></td><td></td><td></td><td></td><td></td></tr>
      <tr><td></td><td></td><td></td><td></td><td></td></tr>
      <tr><td></td><td></td><td></td><td></td><td></td></tr>
      <tr><td></td><td></td><td></td><td></td><td></td></tr>
      <tr><td></td><td></td><td></td><td></td><td></td></tr>
      <tr><td></td><td></td><td></td><td></td><td></td></tr>
      <tr><td></td><td></td><td></td><td></td><td></td></tr>
      <tr style="padding-top:50px;">
        <td width="20%" align="center">( ...................... )</td>
        <td width="20%"></td>
        <td width="20%"></td>
        <td width="20%"></td>
        <td width="20%" align="center">( Ricky )</td>
      </tr>
    </table>
  </body>
  </html>
