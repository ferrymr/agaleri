<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Report Stock</title>
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

    table.x {
      border: 1px solid;
      text-align: left;
    }

    tr.spaceUnder>td {
      padding-bottom: 5em;
    }

  </style>
</head>
<body>
  <h3 class="left"> STOCK {{$title}}</h3>
  <!-- <h5 class="left"> LUNAHOUSE</h5> -->
  <!-- <hr><br> -->
  <table id="table_head" class="x" width="100%">
    <tr>
      <th width="20%">KODE</td>
      <th width="30%">NAMA</td>
      <th width="20%">SUPPLIER</td>
      <th width="10%">STOCK</td>
      <th width="10%">REAL</td>
      <th width="10%">STATUS</td>
    </tr>
    @foreach($data as $d)
    <tr>
      <td>{{ $d->id }}</td>
      <td>{{ $d->name }}</td>
      <td>{{ $d->nama_supplier }}</td>
      <td>{{ $d->stock }}</td>
      <td></td>
      <td>{{ ($d->isactive == 'A') ? 'Aktif' : 'Non Aktif' }}</td>
    </tr>
    @endforeach
  </table>

  <table width="100%" style="margin-top:50px;">
    <tr class="spaceUnder">
      <td width="50%" style="text-align:center;"></td>
      <td width="50%" style="text-align:center;">MANAGER PRODUKSI</td>
    </tr>
    <tr >
      <td width="50%" style="text-align:center;"><strong></strong></td>
      <td width="50%" style="text-align:center;"><strong>AKBAR FITRIANSYAH</strong></td>
    </tr>
  </table>

</body>
</html>
