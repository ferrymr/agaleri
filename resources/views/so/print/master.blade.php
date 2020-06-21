<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cetak Sales Order</title>
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
  <h3 class="left"> SALES ORDER </h3>
  <hr><br>
  <table id="table_head" width="100%">
    <tr>
      <td width="20%">Nomor Order</td>
      <td width="20%">:  {{ $data[0]->id }} </td>
      <td width="15%">Tanggal Order</td>
      <td width="15%">: {{ $data[0]->tanggal_order }} </td>
      <td width="15%">Ordered To</td>
      <td width="15%">: ____________ </td>
    </tr>
    <tr>
      <td>Pelanggan</td>
      <td>:  {{ $data[0]->nama_costumer }} - {{ $data[0]->costumer_id }}</td>
      <td>Deadline</td>
      <td>: {{ $data[0]->tanggal_masuk }} </td>
      <td>- {{ $data[0]->tanggal_akhir }}</td>
      <td> </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Keterangan</td>
      <td colspan="3">: {{ $data[0]->ket }} </td>
    </tr>
  </table>
  <br><hr><br>
  <table id="table_kategori" width="100%">
    <tr>
      <td>Kategori BB</td>
      <td>:  {!! substr($data[0]->produksi_id,21,5) !!} / {{ $data[0]->nama_bahan_baku }}</td>
    </tr>
    <tr>
      <td width="20%">Kategori BJ</td>
      <td width="80%">:  {!! substr($data[0]->produksi_id,10,5) !!} / {{ $data[0]->nama_barang_jadi }}</td>
    </tr>
    <tr>
      <td>Brand</td>
      <td>:  {!! substr($data[0]->produksi_id,16,4) !!} / {{ $data[0]->nama_brand }}</td>
    </tr>
    <tr>
      <td>Bulan Produksi</td>
      <td>:  {!! substr($data[0]->produksi_id,6,3) !!}</td>
    </tr>
    <tr>
      <td>Rencana SPK</td>
      <td>:  Qty {{ $data[0]->qty }} | Satuan Pcs | Artikel {{ $data[0]->art }}</td>
    </tr>
  </table>
  <br><hr><br>

  <table id="table_produksi" width="100%">
    <tr>
      <td width="20%">Nomor Produksi</td>
      <td width="80%">:  <strong>{!! $data[0]->produksi_id !!}</strong></td>
    </tr>
    <tr>
      <td>Kode Barang</td>
      <td>:  <strong>{!! $data[0]->barang_jadi_id !!}</strong></td>
    </tr>
    <tr>
      <td>Nama Barang</td>
      <td>:  <strong>{!! $data[0]->name !!}</strong></td>
    </tr>
  </table>
  <br><hr><br>

  <table id="table_detail" class="x table table-striped table-bordered table-hover" width="100%">
    <thead>
      <tr>
        <th class="x">NO</th>
        <th class="x">WARNA - A</th>
        <th class="x">WARNA - B</th>
        <th class="x">S</th>
        <th class="x">M</th>
        <th class="x">L</th>
        <th class="x">XL</th>
        <th class="x">T.QTY</th>
        <th class="x">J.BAHAN</th>
        <th class="x">KG BODY</th>
        <th class="x">KG RIB</th>
        <th class="x">KG LAIN</th>
      </tr>
    </thead>
    <tbody>
      @foreach($note as $i => $n)
        <tr>
          <td class="x">{{ $i+1 }}</td>
          <td class="x">{{ $n->warnanya_a }}</td>
          <td class="x">{{ $n->warnanya_b }}</td>
          <td class="x">{{ $n->s }}</td>
          <td class="x">{{ $n->m }}</td>
          <td class="x">{{ $n->l }}</td>
          <td class="x">{{ $n->xl }}</td>
          <td class="x">{{ ($n->s+$n->m+$n->l+$n->xl == 0) ? '' : $n->s+$n->m+$n->l+$n->xl }}</td>
          <td class="x"></td>
          <td class="x"></td>
          <td class="x"></td>
          <td class="x"></td>

        </tr>
      @endforeach
    </tbody>
  </table>

  <table width="100%" style="margin-top:50px;">
    <tr class="spaceUnder">
      <td width="50%" style="text-align:center;">KEPALA PRODUKSI</td>
      <td width="50%" style="text-align:center;">MANAGER PRODUKSI</td>
    </tr>
    <tr >
      <td width="50%" style="text-align:center;"><strong>RICKY</strong></td>
      <td width="50%" style="text-align:center;"><strong>AKBAR FITRIANSYAH</strong></td>
    </tr>
  </table>

</body>
</html>
