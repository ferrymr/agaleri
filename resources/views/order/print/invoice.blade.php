<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>{{ $title }}</title>
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
  <h3 class="left"> {{ $title }} </h3>
  <hr><br>
  <table id="table_head" width="100%">
    <tr>
      <td width="20%">Nomor Invoice</td>
      <td width="30%">: {{ $data[0]->id }} </td>
      <td width="20%"></td>
      <td width="30%"></td>
    </tr>
    <tr>
      <td>Tanggal Order</td>
      <td>: {{ Carbon\Carbon::parse($data[0]->tanggal_order)->format('d M Y') }} </td>
    </tr>
    <tr>
      <td>Customer</td>
      <td>: {{ $data[0]->nama_customer }} - {{ $data[0]->id_customer }}</td>
      <td>Email</td>
      <td>: {{ $data[0]->email }} </td>
      <td></td>
    </tr>
    <tr>
      <td>No Handphone</td>
      <td>: {{ $data[0]->no_hp }}</td>
      <td>No Resi</td>
      <td>: {{ $data[0]->no_resi }}</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>: {{ $data[0]->alamat }}</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>Kota</td>
      <td>: {{ $data[0]->kota }}</td>
    </tr>
    <tr>
      <td>Kode Pos</td>
      <td>: {{ $data[0]->kode_pos }} </td>
    </tr>
    <tr>
      <td>Catatan Order</td>
      <td>: {{ $data[0]->catatan_order }}</td>
    </tr>


  </table>
  <br>
  <hr><br>
  <table id="table_detail" class="x table table-striped table-bordered table-hover" width="100%">
    <thead>
      <tr>
        <th class="x">NO</th>
        <th class="x">NAMA BARANG</th>
        <th class="x">SIZE</th>
        <th class="x">QTY</th>
        <th class="x">HARGA</th>
        <th class="x">SUBTOTAL</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data_detail as $d)
      <tr>
        <th class="x">{{ $d->index }} </th>
        <th class="x">{{ $d->name }} </th>
        <th class="x">{{ $d->size_id }} </th>
        <th class="x">{{ number_format($d->qty) }} </th>
        <th class="x">{{ number_format($d->harga) }}</th>
        <th class="x">{{ number_format((int)$d->harga*(int)$d->qty) }} </th>
      </tr>
      @endforeach
      <tr>
        <th class="x" colspan="6"></th>
      </tr>
      <tr>
        <th class="x" colspan="4"></th>
        <th class="x"> Ongkos Kirim</th>
        <th class="x"> {{ number_format($ongkos_kirim) }} </th>
      </tr>
      <tr>
        <th class="x" colspan="4"></th>
        <th class="x"> Potongan</th>
        <th class="x"> IDR {{ number_format($potongan) }} </th>
      </tr>
      <tr>
        <th class="x" colspan="4"></th>
        <th class="x"> Total</th>
        <th class="x"> IDR {{ number_format($total_transaksi) }} </th>
      </tr>
    </tbody>
  </table>

  <table width="100%" style="margin-top:50px;">
    <tr class="spaceUnder">
      <td width="50%" style="text-align:center;"></td>
      <td width="50%" style="text-align:center;">DICETAK OLEH</td>
    </tr>
    <tr>
      <td width="50%" style="text-align:center;"><strong></strong></td>
      <td width="50%" style="text-align:center;"><strong>{{ Auth::user()->name }}</strong></td>
    </tr>
  </table>

</body>

</html>