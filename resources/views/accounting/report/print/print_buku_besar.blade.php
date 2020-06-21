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
  <p><h3 style="text-align:center;"><strong>BUKU BESAR</strong></h3>
  <h5 style="text-align:center; margin-top:-10px;">PRIODE : {{$priode}}</h5>
  <h6 style="text-align:left; margin-bottom:-10px;">KODE PERKIRAAN : {{$kode_perkiraan}}</span>
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
        <th class="x" align="center">TANGGAL</th>
        <th class="x" align="center">KETERANGAN</th>
        <th class="x" align="center">NOMOR JURNAL</th>
        <th class="x" align="center">NOMOR REFERENSI</th>
        <th class="x" align="center">DEBET</th>
        <th class="x" align="center">KREDIT</th>
        <th class="x" align="center">SALDO</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($data))
      @foreach($data as $d => $v)
      <tr>
        <td class="x" align="center">{{ Carbon\Carbon::parse($v->tanggal_jurnal)->format('d/m/Y') }}</td>
        <td class="x">{{ $v->deskripsi }}</td>
        <td class="x" align="right">{{ $v->id_jurnal }}</td>
        <td class="x" align="right">{{ $v->ref_id }}</td>
        <td class="x" align="right"> {{ ($v->debit > 0) ? number_format($v->debit,2) : "" }}</td>
        <td class="x" align="right"> {{ ($v->kredit > 0) ? number_format($v->kredit,2) : "" }}</td>
        <td class="x" align="right"> {{ number_format($v->saldo,2) }}</td>
      </tr>
      @endforeach      
      @endif
    </tbody>
  </table>
  </body>
  </html>
