<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Report Transaksi</title>
  <style>
    img {
      margin-top: -40px;
      margin-left: 45px;
    }

    .center {
      text-align: center;
    }

    td {
      font-size: 0.9em;
    }

    th {
      font-size: 0.8em;
    }

    table.x,
    th.x,
    td.x {
      /*border: 1px solid;*/
      border: 1px solid black;
      border-collapse: collapse;
      text-align: center;
    }

    tr.spaceUnder>td {
      padding-bottom: 5em;
    }
  </style>
</head>

<body>
  <h3 class="left"> REPORT TRANSAKSI {{$title}}</h3>
  <!-- <h5 class="left"> LUNAHOUSE</h5> -->
  <br>
  <table id="table_head" class="x" width="100%">
    <tr class="x">
      <th class="x" width="5%">ID</td>
      <th class="x" width="15%">DATETIME</td>
      <th class="x" width="15%">NAMA CUSTOMER</td>
      <th class="x" width="30%">ALAMAT</td>
      <th class="x" width="10%">STATUS</td>
      <th class="x" width="15%">TOTAL TRANSAKSI</td>
      <th class="x" width="20%">CATATAN</td>
    </tr>
    @foreach($data as $d)

    @php
    $status = $d->status_order;
    if($status == 'n') $status = 'New';
    if($status == 'b') $status = 'Batal';
    if($status == 'p') $status = 'Proses';
    if($status == 's') $status = 'Selesai';
    @endphp
    <tr>
      <td class="x">{{ $d->id }}</td>
      <td class="x">{{ Carbon\Carbon::parse($d->tanggal_order)->format('d M Y H:m')  }}</td>
      <td class="x">{{ $d->nama_customer }}</td>
      <td class="x">{{ $d->alamat_tujuan }}</td>
      <td class="x">{{ $status }}</td>
      <td class="x">{{ number_format($d->total_transaksi) }}</td>
      <td class="x">{{ $d->catatan_order }}</td>
    </tr>
    @endforeach
    <tr style="border-bottom: 0 !important;">
      <td colspan="5" class="x" align="right"></td>
      <td class="x" align="right">{{ number_format($total[0]->total) }}</td>
      <td colspan="1" class="x" align="right"></td>
    </tr>
  </table>

  <table width="100%" style="margin-top:50px;">
    <tr class="spaceUnder">
      <td width="80%" style="text-align:center;"></td>
      <td width="20%" style="text-align:center;">Dicetak oleh</td>
    </tr>
    <tr>
      <td width="80%" style="text-align:center;"><strong></strong></td>
      <td width="20%" style="text-align:center;"><strong>{{ Auth::user()->name }}</strong></td>
    </tr>
  </table>

</body>

</html>