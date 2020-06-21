<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{$title}}</title>
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
      /*border: 1px solid;*/
      border: 1px solid black;
      border-collapse: collapse;
      text-align: center;
    }

    tr.spaceUnder>td {
      padding-bottom: 5em;
    }

    img{
      margin-top: 5px;
      margin-left: -10px;
    }

    p{
      font-size: 0.9em;
    }

    table.y {
    border-collapse: collapse;
    }

    table.y, tr.y, th.y, td.y {
    border: 1px solid black;
    padding: 5px;
    border-collapse: collapse;
    }

    .left {
      text-align: left;
    }

    .no_skb {
      margin-bottom: -10px;
    }

    .note {
      font-size: 0.7em;
    }

  </style>
</head>
<body>
  <table width="100%" >
    <tr>
      <td width="70%"><img src="{{public_path('/'.$logo)}}" alt="Lunahouse.co.id"></td>
      <td>Bandung, {{ $tanggal }}</td>
    </tr>
    <tr class="y">
      <td><strong>Factory & Head Office</strong></td>
      <td class="y">CMT : {{ $nama_cmt }}</td>
    </tr>
    <tr class="y">
      <td>{{ $alamat }}</td>
      <td class="y">PROSES : {{ $nama_proses }}</td>
    </tr>
  </table>

  <h3 class="center">{{ $title }}</h3>
  <p class="left no_skb"><strong>No SKB.</strong> {{ $skb_id }}</p>
  <p>Bersama ini kendaraan ....................... No ....................... Kami kirimkan barang - barang tersebut dibawah ini :</p>
  <table class="x" width="100%">
    <tr class="x">
      <th class="x" width="10%">NO SO</td>
      <th class="x" width="10%">NO ART</td>
      <th class="x" width="10%">QTY</td>
      <th class="x" width="30%">ITEM</td>
      <th class="x" width="30%">KETERANGAN</td>
    </tr>
    @foreach($data as $d)
    <tr class="x">
      <td class="x">{{ $d->so_id }}</td>
      <td class="x">{{ $d->art_id }}</td>
      <td class="x">{{ $d->qty }}</td>
      <td class="x">{{ $d->name }}</td>
      <td class="x">{{ $d->ket }}</td>
    </tr>
    @endforeach
  </table>

<br>
  <table class="note">
    <tr>
      <td><strong>NOTE :</strong></td>
    </tr>
    <tr>
      <td>1. Harap dihitung kembali barang yang diterima sebelum di tanda tangan</td>
    </tr>
    <tr>
      <td>2. Segala resiko setelah ditanda tangani menjadi tanggung jawab CMT</td>
    </tr>
    <tr>
      <td>3. Pada saat di serahkan kembali SKB ini harap dibawa</td>
    </tr>
    <tr>
      <td>4. Batas waktu komplain 1 x 24 Jam</td>
    </tr>
  </table>

  <table width="100%" style="margin-top:50px;">
    <tr class="spaceUnder">
      <td width="50%" style="text-align:center;">Penerima</td>
      <td width="50%" style="text-align:center;">Hormat Kami,</td>
    </tr>
    <tr >
      <td width="50%" style="text-align:center;"><strong>...............</strong></td>
      <td width="50%" style="text-align:center;"><strong>DIVISI CMT</strong></td>
    </tr>
  </table>

</body>
</html>
