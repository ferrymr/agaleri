<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>View Pembelian</title>
  <style>
    img {
      margin-top: -40px;
      margin-left: 45px;
    }
    .center {
      text-align: center;
    }

    td{
      font-size: 0.9em;
    }

    th{
      font-size: 0.8em;
    }

    table.x, th.x, td.x {
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
  <h3 class="left"> {{$title}} </h3>
  <hr><br>
  <table id="table_head" width="100%">
    <tr>
      <td width="20%">Tanggal</td>
      <td width="80%">: {{ Carbon\Carbon::parse($data[0]->tanggal)->format('d M Y') }}  </td>
    </tr>
    <tr>
      <td>No Bukti Pembelian</td>
      <td>:  {{ $data[0]->id_bp }} </td>
    </tr>
    <tr>
      <td>Tanggal Faktur</td>
      <td>: {{ Carbon\Carbon::parse($data[0]->tanggal)->format('d M Y') }}  </td>
    </tr>
    <tr>
      <td>No Faktur Supplier</td>
      <td>: {{ $data[0]->id_faktur }} </td>
    </tr>
    <tr>
      <td>Supplier</td>
      <td>: {{ $data[0]->nama_supplier }} </td>
    </tr>
  </table>
  <br><br>

  <table id="table_detail" class="x" width="100%">
  <tr class="x">
  <th class="x">KODE</th>
  <th class="x">NAMA BARANG</th>
  <th class="x">WARNA/BRAND</th>
  <th class="x">QTY</th>
  <th class="x">SATUAN</th>
  <th class="x">HARGA</th>
  <th class="x">JUMLAH</th>
  </tr>
  @foreach($data as $i => $n)
  <tr class="x">
    <td class="x">{{ $n->kode_barang }}</td>
    <td class="x">{{ $n->nama_barang }}</td>
    <td class="x">{{ $n->nama_warna_or_brand }}</td>
    <td class="x">{{ number_format($n->qty) }}</td>
    <td class="x">{{ $n->nama_satuan }}</td>
    <td class="x">{{ number_format($n->harga) }}</td>
    <td class="x">{{ number_format($n->jumlah) }}</td>
  </tr>
  @endforeach
  <tr class="x">
    <td class="x" colspan="5" style="text-align:right;"></td>
    <td class="x">{{ number_format($total[0]->total_harga) }}</td>
    <td class="x">{{ number_format($total[0]->total_jumlah) }}</td>
  </tr>
  </table>
  



</body>
</html>
