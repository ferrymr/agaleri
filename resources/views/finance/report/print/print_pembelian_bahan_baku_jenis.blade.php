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
  {{-- PRINT Buku Besar --}}
  <table width="100%">
    <tr style="height:100px">
      <td width="6%" valign="bottom"><img src="{{public_path('/logo_only.png')}}" alt="Lunahouse.co.id"></td>
      <td width="94%" valign="top"><strong style="font-size:90% !important;">{{ strtoupper($name_company) }}</strong><br/>{{ $alamat }}<br/>{{ $telepon }}</td>
    </tr>
  </table>
  <hr>
<p><h3 style="text-align:center;"><strong>{{ $title }}</strong></h3>
  <h5 style="text-align:center; margin-top:-10px;">PRIODE : {{$priode}}</h5>
  <h6 style="text-align:left; margin-bottom:-10px;">{{$kode_name}}</span>
  </p>
  <table id="table_head" width="100%">
    <tr>
      {{-- <td class="a" width="20%" align="center">Kepada Yth : <br/> <strong style="font-size:90%;">{{ $data[0]->nama_costumer }}</strong></td>
      <td class="b" width="40%" align="center"><strong style="font-size:100%;">{{ $title }}</strong> <br/> {{ $data[0]->id }}</td>
      <td class="c" width="20%" align="right">Tanggal : {{ Carbon\Carbon::parse($data[0]->tanggal)->format('d M Y') }} <br /> Jatuh Tempo : {{ Carbon\Carbon::parse($data[0]->jatuh_tempo)->format('d M Y') }} <br/> Term Of Payment : {{ $data[0]->top }} Days</td> --}}
    </tr>
  </table>
  <table id="table_detail" class="x table table-striped table-bordered table-hover" width="100%">
    <thead>
      <tr style="height:25px;">
        <th class="x" align="center">TANGGAL TRANSAKSI</th>
        <th class="x" align="center">TANGGAL PEMBUKUAN</th>
        <th class="x" align="center">NOMOR BUKTI</th>
        <th class="x" align="center">NAMA SUPPLIER</th>
        <th class="x" align="center">QTY</th>
        <th class="x" align="center">SATUAN</th>
        <th class="x" align="center">NOMOR FAKTUR / BON</th>
        <th class="x" align="center">HARGA</th>
        <th class="x" align="center">JUMLAH</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($data))
      @foreach($data as $d => $v)
      <tr>
        <td class="x" align="center">{{ $v->tanggal }}</td>
        <td class="x" align="center">{{ $v->tgl_faktur }}</td>
        <td class="x" align="center">{{ $v->id_bp }}</td>
        <td class="x" align="center">{{ $v->nama_supplier }}</td>
        <td class="x" align="right"> {{ number_format($v->qty,2) }}</td>
        <td class="x" align="center"> {{ $v->nama_satuan }}</td>
        <td class="x" align="center"> {{ $v->id_faktur }}</td>
        <td class="x" align="right"> {{ number_format($v->harga,2) }}</td>
        <td class="x" align="right"> {{ number_format($v->jumlah,2) }}</td>
      </tr>
      @endforeach
      <tr style="border-bottom: 0 !important;">
          <td colspan="4" class="x" align="right"></td>
          <td class="x" align="right">{{ number_format($total_qty,2) }}</td>
          <td colspan="3" class="x" align="right"></td>
          <td class="x" align="right">{{ number_format($total,2) }}</td>
      </tr>
      @endif
    </tbody>
  </table>
  </body>
  </html>
