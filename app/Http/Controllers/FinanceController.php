<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Yajra\DataTables\DataTables;

use PDF;
use Auth;
use Carbon\Carbon;
use App\BahanBaku;
use App\Warna;
use App\Brand;
use App\BarangJadi;
use App\Supplier;
use App\Costumer;
use App\Cmt;
use App\Acc;
use App\Proses;
use App\Bank;
use App\So;
use App\Param;
use App\Art;
use App\CatatanProduksi;
use App\PembelianBB;
use App\PembelianBBDetail;
use App\PembelianAcc;
use App\PembelianAccDetail;
use App\PembelianBJ;
use App\PembelianBJDetail;
use App\Barang;
use App\MasterBB;
use App\MasterAcc;
use App\MasterBJ;
use App\Payment;
use App\Category;
use App\Ledger;
use App\Journal;
use App\JournalTransaction;
use App\Akun;
use App\Skb;
use App\SkbDetail;
use App\Invoice;
use App\InvoiceDetail;
use App\KartuPersediaanBB;
use App\Hutang;
use App\PembayaranHutang;
use App\PembayaranDetailHutang;
use App\Piutang;
use App\PembayaranPiutang;
use App\PembayaranDetailPiutang;
use Excel;
use App\CekGiro;

/**
 * Kontroller Khusus Modul Akunting
 */

class FinanceController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  // Hutang

  public function hutang_tambah_index()
  {
      $date = Carbon::now()->format('my').'-';
      $data  = [
      'title'   =>  'Hutang',
      'tag'     =>  'hutang',
      'newid'   =>  $this->genid('Hutang','H'),
      'tanggal' =>  $this->datenowtoview(),
      ];
      return view('finance.hutang.tambah', $data);
  }

  //212
  public function hutang_tambah_create(Request $request)
  {
      $r        = $request->all();
      $kategori = $r['kategori'];
      // dd(implode(';',$r['no_skb']));

      for ($i=0; $i < count(array_filter($r['total_hutang'])); $i++) {
          if($kategori == 'C'){
            $get_id_akun_target = Cmt::select('akun_id')
            ->where('id', '=', $request['id_cmt'])
            ->get();
        } else {
            $get_id_akun_target = Supplier::select('akun_id')
            ->where('id', '=', $request['id_supplier'])
            ->get();
          }

      if (isset($get_id_akun_target[0]['akun_id'])) {
        $id_akun_tujuan = $get_id_akun_target[0]['akun_id'];
      } else {
        $id_akun_tujuan = '';
      }

      // Pengisian ke hutang
      $id_hutang = $this->genid('Hutang', 'H');
      $index_hutang = $this->genindex('Hutang');
      $type_hutang = ($kategori == 'C') ? 'cmt' : 'baj';
      $tanggal_faktur = $this->datetodb($r['tanggal']);
      $tanggal = Carbon::createFromDate(substr($r['tanggal'], 6, 4), substr($r['tanggal'], 3, 2), substr($r['tanggal'], 0, 2), 0);

      $data_hutang = [
        'id' => $id_hutang,
        'index' => $index_hutang,
        'type' => $type_hutang,
        'kategori' => $kategori,
        'tanggal_faktur' => $tanggal_faktur,
        'total_hutang' => $this->ribuantodb($r['total_footer']),
        'total_bayar' => 0,
        'total_sisa' => $this->ribuantodb($r['total_footer']),
        'status' => 0,
      ];

      ($kategori == 'C') ? $data_hutang['id_cmt'] = $r['id_cmt'] : $data_hutang['id_supplier'] = $r['id_supplier'];
      ($kategori == 'C') ? $data_hutang['kategori'] = $kategori : $data_hutang['id_supplier'] = $r['id_supplier'];
      ($kategori == 'C') ? $data_hutang['no_skb'] = implode(';',$r['no_skb']) : '';
      ($kategori == 'S') ? $data_hutang['no_faktur'] = implode(';',$r['no_faktur']) : '';
      
    //   dd($data_hutang);
      Hutang::create($data_hutang);
      
      }

      
    //Fungsi Akuntansi  
    $id = ['1101050001', $id_akun_tujuan];
    $debit = [(int)$this->ribuantodb($r['total_footer']), 0];
    $credit = [0, (int)$this->ribuantodb($r['total_footer'])];
    $ref_type = ['tambah_hutang', 'tambah_hutang'];
    $ref_id = [$r['id'], $r['id']];
    $memo = ['PENAMBAHAN HUTANG DENGAN ID : ' . $r['id'], 'PENAMBAHAN HUTANG DENGAN ID : ' . $r['id']];
    $date = $this->datenowtodb();
    $currency = 'IDR';

    $data = [
      'akun_id' => $id,
      'debit' => $debit,
      'credit' => $credit,
      'ref_type' => $ref_type,
      'ref_id' => $ref_id,
      'memo' => $memo,
      'date' => $date,
      'currency' => $currency,
    ];

    $create_jurnal = $this->create_jurnal($data);

      return response()->json(
          [
          'status'  => true,
          'message' => 'Transaksi Penambahan Hutang Created',
          ]
      );
  }

  public function hutang_index()
  {
      $date = Carbon::now()->format('my').'-';
      $data  = [
      'title'   =>  'Hutang',
      'tag'     =>  'hutang',
      'newid'   =>  $this->genid('Hutang', $date),
      'tanggal' =>  $this->datenowtoview(),
      ];
      // dd($data);
      return view('finance.hutang.index', $data);
  }

  public function hutang_bayar()
  {
      $id = $this->genid('PembayaranHutang', 'PH');
      $data = [
      'title' => 'Pembayaran Hutang',
      'tag' => 'pembayaran_hutang',
      'id' => $id,
      'tanggal' => $this->datenowtoview(),
      ];

      return view('finance.hutang.bayar', $data);
      
  }

  //Pembayaran Hutang
  public function hutang_create(Request $request)
  {
      $r    = $request->all();
      $i    = $this->genindex('PembayaranHutang');
      // dd($r);
      $data = [
      'id'            => $r['id'],
      'index'         => $i,
      'tanggal_bayar' => $this->dateviewtodb($r['tanggal']),
      'id_payment'    => $r['id_payment'],
      'total_bayar'   => $this->ribuantodb($r['total_footer']),
      'akun_id'       => $r['id_akun'],
      'status'        => 'A'
      ];

      ($r['kategori'] == 'C') ? $data['id_cmt'] = $r['id_cmt'] : ''; 
      ($r['kategori'] == 'S') ? $data['id_supplier'] = $r['id_supplier'] : ''; 

      // Insert Data Detail
      for ($i=0; $i < count($r['no_faktur']); $i++) {
        $data_detail = [
          'id_pembayaran' => $r['id'],
          'index'         => $i,
          'no_faktur'     => $r['no_faktur'][$i],
          'diskon'        => $this->ribuantodb($r['diskon'][$i]),
          'jumlah_bayar'  => $this->ribuantodb($r['jumlah_bayar'][$i]),
          'keterangan'    => $r['keterangan'][$i],
          'status'        => 'A'
        ];
        
          // dd($data_detail);
          PembayaranDetailHutang::create($data_detail);
      }
// dd($data_detail);
      // Update Hutang
      for ($i=0; $i < count($r['no_faktur']); $i++) {
          $data_hutang = Hutang::where('id','=',$r['no_faktur'][$i])->get();
          $total_bayar = (isset($data_hutang[0]->total_bayar)) ? $this->ribuantodb($data_hutang[0]->total_bayar) : 0;   
          $total_sisa = (isset($data_hutang[0]->total_sisa)) ? $this->ribuantodb($data_hutang[0]->total_sisa) : 0; 
          $status = 0;
          $bayar = $total_bayar + $this->ribuantodb($r['jumlah_bayar'][$i]);
          $saldo = $total_sisa - $this->ribuantodb($r['jumlah_bayar'][$i]);
          
          if ($saldo < 1){
            $status = 2;
          } else {
            $status = 1;
          }
          
          $data_update = [
            'total_bayar' => $bayar,
            'total_sisa' => $saldo,
            'status' => $status
          ];

        Hutang::where('id','=',$r['no_faktur'][$i])->update($data_update);
      }

      
      PembayaranHutang::create($data);

      if($r['kategori'] == 'C') {
        $get_id_akun = Cmt::select('akun_id')
        ->where('id', '=', $r['id_cmt'])
        ->get();
      }

      if($r['kategori'] == 'S') {
        $get_id_akun = Supplier::select('akun_id')
        ->where('id', '=', $r['id_supplier'])
        ->get();
      }

      if (isset($get_id_akun[0]['akun_id'])) {
          $id_akun_tujuan = $get_id_akun[0]['akun_id'];
      } else {
          $id_akun_tujuan = '';
      }

      //Fungsi Akuntansi  
      $id = [$r['id_akun'], $id_akun_tujuan];
      $debit = [0, (int)$this->ribuantodb($r['total_footer'])];
      $credit = [(int)$this->ribuantodb($r['total_footer']), 0];
      $ref_type = ['pembayaran_hutang', 'pembayaran_hutang'];
      $ref_id = [$r['id'], $r['id']];
      $memo = ['Pembayaran Hutang dengan Id : ' . $r['id'], 'Pembayaran Hutang dengan Id : ' . $r['id']];
      $date = $this->datenowtodb();
      $currency = 'IDR';

      $data = [
        'akun_id' => $id,
        'debit' => $debit,
        'credit' => $credit,
        'ref_type' => $ref_type,
        'ref_id' => $ref_id,
        'memo' => $memo,
        'date' => $date,
        'currency' => $currency,
      ];
      
      $create_jurnal = $this->create_jurnal($data);

      // $date = Carbon::now()->format('my').'-';
      // $newid = $this->genid('Hutang', $date);

      return response()->json(
          [
          'status'  => true,
          'message' => 'Transaksi Pembayaran Hutang Created',
          // 'newid'   => $newid
          ]
      );
  }

  public function hutang_api()
  {
      // dd(1);
      $data = DB::table('hutang')
      ->select('hutang.*', 'supplier.name as nama_supplier')
      ->join('supplier', 'hutang.id_supplier', '=', 'supplier.id')
      ->orderBy('id','DESC')
      ->get();
      return DataTables::of($data)
      ->editColumn(
          'status', function ($data) {
            if($data->status == '0' ){
              return 'Not Paid';
            } elseif ($data->status == '1') {
              return 'Partial';
            } else {
              return 'Paid';
            }
          }
      )
      ->editColumn(
          'tanggal_faktur', function ($data) {
              return date('d-m-Y', strtotime($data->tanggal_faktur)); 
          }
      )
      ->editColumn(
          'tanggal_jatuh_tempo', function ($data) {
              return date('d-m-Y', strtotime($data->tanggal_jatuh_tempo)); 
          }
      )
      ->editColumn(
          'total_hutang', function ($data) {
              return number_format($data->total_hutang, 2);
          }
      )
      ->editColumn(
          'total_bayar', function ($data) {
              return number_format($data->total_bayar, 2);
          }
      )
      ->editColumn(
          'total_sisa', function ($data) {
              return number_format($data->total_sisa, 2);
          }
      )
      ->addColumn(
          'action', function ($data) {
              return
              '<a onclick="bayarHutang(\''.$data->id.'\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-send"></i> Bayar</a> &nbsp;';
          }
      )
      ->make(true);
  }

  public function hutang_cmt_api()
  {
      // dd(1);
      $data = DB::table('hutang')
      ->select('hutang.*', 'cmt.name as nama_cmt')
      ->join('cmt', 'hutang.id_cmt', '=', 'cmt.id')
      ->orderBy('id','DESC')
      ->get();
      return DataTables::of($data)
      ->editColumn(
          'status', function ($data) {
            if($data->status == '0' ){
              return 'Not Paid';
            } elseif ($data->status == '1') {
              return 'Partial';
            } else {
              return 'Paid';
            }
          }
      )
      ->editColumn(
          'tanggal_faktur', function ($data) {
              return date('d-m-Y', strtotime($data->tanggal_faktur)); 
          }
      )
      ->editColumn(
          'tanggal_jatuh_tempo', function ($data) {
              return date('d-m-Y', strtotime($data->tanggal_jatuh_tempo)); 
          }
      )
      ->editColumn(
          'total_hutang', function ($data) {
              return number_format($data->total_hutang, 2);
          }
      )
      ->editColumn(
          'total_bayar', function ($data) {
              return number_format($data->total_bayar, 2);
          }
      )
      ->editColumn(
          'total_sisa', function ($data) {
              return number_format($data->total_sisa, 2);
          }
      )
      ->addColumn(
          'action', function ($data) {
              return
              '<a onclick="bayarHutang(\''.$data->id.'\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-send"></i> Bayar</a> &nbsp;';
          }
      )
      ->make(true);
  }

  public function hutang_view($id)
  {
      $profile   = Param::all();
      $hutang = DB::table('hutang')
      ->select(
          'hutang.*',
          'hutang_detail.*',
          'costumer.name as nama_costumer',
          'costumer.alamat as alamat_costumer',
          'proses.name as nama_proses',
          'satuan.name as nama_satuan',
          'barang.name as nama_barang'
      )
      ->join('costumer', 'hutang.id_costumer', '=', 'costumer.id')
      ->join('hutang_detail', 'hutang.id', '=', 'hutang_detail.id_hutang')
      ->join('proses', 'hutang.id_proses', '=', 'proses.id')
      ->join('satuan', 'hutang_detail.id_satuan', '=', 'satuan.id')
      ->join('barang', 'hutang_detail.id_barang', '=', 'barang.id')
      ->where('hutang.id', '=', $id)
      ->get();

      $currency = $this->cek_currency($hutang[0]->currency);

      return response()->json(
          [
          'data'    =>  $hutang,
          'profile' =>  $profile,
          'type'    =>  'M',
          'currency' =>  $currency,
          ]
      );
  }

  public function hutang_print($id)
  { 
      $check = Hutang::findOrFail($id);
      $title      = 'INVOICE';
      $data       = DB::table('hutang')
      ->select(
          'hutang.*',
          'hutang_detail.*',
          'costumer.name as nama_costumer'
      )
      ->leftJoin('costumer', 'hutang.id_costumer', '=', 'costumer.id')
      ->leftJoin('hutang_detail', 'hutang.id', '=', 'hutang_detail.id_hutang')
      ->where('hutang.id', '=', $id)
      ->get();

      $row = 1 - count($data);
      if ($row > 1) {
          $row = 0;
      }

      $currency = 'Rp';
      $data_perusahaan = Param::all();
      $data = [
        'title'       =>  $title,
        'data'        =>  $data,
        'name_company'=>  $data_perusahaan[0]['name_perusahaan'],
        'alamat'      =>  'Office : '.$data_perusahaan[0]['alamat'],
        'telepon'     =>  'Telepon : '.$data_perusahaan[0]['telepon'],
        'logo'        =>  $data_perusahaan[0]['logo_perusahaan'],
        'currency'    =>  $currency,
        'row'         =>  $row,
        'total_trans' =>  $data[0]->grand_total
      ];
      $pdf  = PDF::loadView('hutang.print.print', $data);
      $pdf->setPaper('a4', 'potrait');
      return $pdf->stream();
  }

  public function hutang_acc(Request $request)
  {
      $r          = $request->all();
      $userid     = Auth::user()->id;
      $verify     = User::findOrFail($userid);
      if ($r['pin'] != $verify->pin) {
          return response()->json(
              [
              'status' => false,
              'message' => 'Pin Salah! '
              ]
          );
      }
      $role       = Auth::user()->role;
      $hutang  = Hutang::findOrFail($r['id']);
      if ($role == '0004') {
          $data     = [
          'tgl_acc_1' => $this->datenowtodb(),
          'id_user_acc_1' => $userid
          ];
      } elseif ($role == '0003') {
          $data     = [
          'tgl_acc_2' => $this->datenowtodb(),
          'id_user_acc_2' => $userid
          ];
      } elseif ($role == '0002' || $role == '0001') {
          $data     = [
          'tgl_acc_3' => $this->datenowtodb(),
          'id_user_acc_3' => $userid,
          'status' => 'C',
          'isactive' => 'A'
          ];
          //212
          // Barang::where('id',)
      } else {
          return response()->json(
              [
              'status' => false,
              'message' => 'Acc Batal'
              ]
          );
      }

      $hutang->update($data);
      return response()->json(
          [
          'status' => true,
          'message' => 'Acc Berhasil'
            ]
      );
  }

  public function hutang_cancel(Request $request)
  {
      $r          = $request->all();
      $name       = Auth::user()->name;
      $data       = [
      'catatan_pembatalan' => $r['msg'].', by: '.$name,
      'isactive' => 'C'
      ];
      $hutang  = Hutang::findOrFail($r['id']);
      $hutang->update($data);
      return response()->json(
          [
          'status' => true,
          'message' => 'Cancel Berhasil'
            ]
      );
  }

  public function laporan_hutang_index($kategori)
  {
    $data = [
      'title' => 'Hutang',
      'tag' => 'hutang',
      // 'tanggal' => $this->datenowtoview(),
    ];
    return view('finance.report.hutang', $data);
  }

  public function laporan_giro_index()
  {
    $data = [
      'title' => 'Giro',
      'tag' => 'giro',
      'tanggal' => $this->datenowtoview(),
    ];
    return view('finance.report.giro', $data);
  }

  public function laporan_giro_view($from,$to,$kategori,$status)
  {
    ($from == 'all') ? $f = 'all': $f = Carbon::createFromDate(substr($from, 6, 4), substr($from, 0, 2), substr($from, 3, 2));
    ($to == 'all') ? $t = 'all': $t = Carbon::createFromDate(substr($to, 6, 4), substr($to, 0, 2), substr($to, 3, 2));
    $title = 'LAPORAN GIRO';
    $range = ($f != 'all' && $t != 'all') ? true : false ;
    $date_now = Carbon::now();
    $date_min_7 = Carbon::now()->subDays(7);
    $kategori = strtoupper($kategori);
    $status = strtoupper($status);

    $data = DB::table('cek_giro')
        ->select('cek_giro.*')
        ->when($range == true, function ($query) use ($f,$t) {
            return $query->whereBetween('cek_giro.tanggal_keluar', [$f,$t]); })
        ->when($kategori != 'ALL', function ($query) use ($kategori) {
            return $query->where('cek_giro.type', '=', $kategori); })
        ->when($status != 'ALL', function ($query) use ($status) {
            return $query->where('cek_giro.status', '=', $status); })
        ->orderBy('cek_giro.id', 'DESC')
        ->get();

    $total = DB::table('cek_giro')
      ->selectRaw('sum(cek_giro.nominal) as total')
      ->when($range == true, function ($query) use ($f,$t) {
        return $query->whereBetween('cek_giro.tanggal_keluar', [$f,$t]); })
      ->when($kategori != 'ALL', function ($query) use ($kategori) {
          return $query->where('cek_giro.type', '=', $kategori); })
      ->when($status != 'ALL', function ($query) use ($status) {
          return $query->where('cek_giro.status', '=', $status); })
      ->get();
      

    $currency = 'Rp';
    $data_perusahaan = Param::all();
    $data_send = [
      'title'       =>  $title,
      'data'        =>  $data,
      'name_company'=>  $data_perusahaan[0]['name_perusahaan'],
      'alamat'      =>  'Office : '.$data_perusahaan[0]['alamat'],
      'telepon'     =>  'Telepon : '.$data_perusahaan[0]['telepon'],
      'logo'        =>  $data_perusahaan[0]['logo_perusahaan'],
      'currency'    =>  $currency,
      'priode'      =>  ($from == 'all') ? '-' : Carbon::parse($f)->format('d/m/Y').' sampai '.Carbon::parse($t)->format('d/m/Y'),
      'total'       =>  (isset($total[0]->total)) ? $total[0]->total : 0,
    ];

    $pdf  = PDF::loadView('finance.report.print.print_giro', $data_send);
    $pdf->setPaper('a4', 'landscape');
    return $pdf->stream();
  }

  public function laporan_piutang_index()
  {
    $data = [
      'title' => 'Piutang',
      'tag' => 'piutang',
      'tanggal' => $this->datenowtoview(),
    ];
    return view('finance.report.piutang', $data);
  }

  public function laporan_piutang_view($from,$to,$status)
  {
    ($from == 'all') ? $f = 'all': $f = Carbon::createFromDate(substr($from, 6, 4), substr($from, 0, 2), substr($from, 3, 2));
    ($to == 'all') ? $t = 'all': $t = Carbon::createFromDate(substr($to, 6, 4), substr($to, 0, 2), substr($to, 3, 2));
    $title = 'LAPORAN PIUTANG';
    $range = ($f != 'all' && $t != 'all') ? true : false ;
    $date_now = Carbon::now();
    $date_min_7 = Carbon::now()->subDays(7);
    $status = strtoupper($status);

    $data = DB::table('piutang')
        ->select('piutang.*')
        ->when($range == true, function ($query) use ($f,$t) {
            return $query->whereBetween('piutang.tanggal_keluar', [$f,$t]); })
        ->when($status != 'ALL', function ($query) use ($status) {
            return $query->where('piutang.status', '=', $status); })
        ->orderBy('piutang.id', 'DESC')
        ->get();

    $total = DB::table('piutang')
      ->selectRaw('sum(piutang.nominal) as total')
      ->when($range == true, function ($query) use ($f,$t) {
        return $query->whereBetween('piutang.tanggal_keluar', [$f,$t]); })
      ->when($status != 'ALL', function ($query) use ($status) {
          return $query->where('piutang.status', '=', $status); })
      ->get();
      

    $currency = 'Rp';
    $data_perusahaan = Param::all();
    $data_send = [
      'title'       =>  $title,
      'data'        =>  $data,
      'name_company'=>  $data_perusahaan[0]['name_perusahaan'],
      'alamat'      =>  'Office : '.$data_perusahaan[0]['alamat'],
      'telepon'     =>  'Telepon : '.$data_perusahaan[0]['telepon'],
      'logo'        =>  $data_perusahaan[0]['logo_perusahaan'],
      'currency'    =>  $currency,
      'priode'      =>  ($from == 'all') ? '-' : Carbon::parse($f)->format('d/m/Y').' sampai '.Carbon::parse($t)->format('d/m/Y'),
      'total'       =>  (isset($total[0]->total)) ? $total[0]->total : 0,
    ];

    $pdf  = PDF::loadView('finance.report.print.print_piutang', $data_send);
    $pdf->setPaper('a4', 'landscape');
    return $pdf->stream();
  }

  public function laporan_pengeluaran_index()
  {
    $data = [
      'title' => 'Pengeluaran',
      'tag' => 'pengeluaran',
      'tanggal' => $this->datenowtoview(),
    ];
    return view('finance.report.pengeluaran', $data);
  }

  public function laporan_pengeluaran_view($from,$to,$id)
  {
    ($from == 'all') ? $f = 'all': $f = Carbon::createFromDate(substr($from, 6, 4), substr($from, 0, 2), substr($from, 3, 2));
    ($to == 'all') ? $t = 'all': $t = Carbon::createFromDate(substr($to, 6, 4), substr($to, 0, 2), substr($to, 3, 2));
    $title = 'LAPORAN PENGELUARAN';
    $range = ($f != 'all' && $t != 'all') ? true : false ;

    $data = DB::table('accounting_journal_transactions')
    ->select('accounting_journal_transactions.*')
    ->when($range == true, function ($query) use ($f,$t) {
        return $query->whereBetween('accounting_journal_transactions.post_date', [$f,$t]); })
    ->when($id != 'null', function ($query) use ($id) {
        return $query->where('accounting_journal_transactions.akun_id', '=', $id); })
    ->orderBy('accounting_journal_transactions.id', 'DESC')
    ->where('transaction_group','=','expense')
    ->get();
    // dd($data);
    $total = DB::table('accounting_journal_transactions')
    ->selectRaw('sum(accounting_journal_transactions.debit) as total')
    ->when($range == true, function ($query) use ($f,$t) {
      return $query->whereBetween('accounting_journal_transactions.post_date', [$f,$t]); })
    ->when($id != 'null', function ($query) use ($id) {
      return $query->where('accounting_journal_transactions.akun_id', '=', $id); })
    ->where('transaction_group','=','expense')
    ->get();
      

    $currency = 'Rp';
    $data_perusahaan = Param::all();
    $data_send = [
      'title'       =>  $title,
      'data'        =>  $data,
      'name_company'=>  $data_perusahaan[0]['name_perusahaan'],
      'alamat'      =>  'Office : '.$data_perusahaan[0]['alamat'],
      'telepon'     =>  'Telepon : '.$data_perusahaan[0]['telepon'],
      'logo'        =>  $data_perusahaan[0]['logo_perusahaan'],
      'currency'    =>  $currency,
      'priode'      =>  ($from == 'all') ? '-' : Carbon::parse($f)->format('d/m/Y').' sampai '.Carbon::parse($t)->format('d/m/Y'),
      'total'       =>  (isset($total[0]->total)) ? $total[0]->total : 0,
    ];

    $pdf  = PDF::loadView('finance.report.print.print_pengeluaran', $data_send);
    $pdf->setPaper('a4', 'landscape');
    return $pdf->stream();
  }

  public function invoice_index()
  {
      $date = Carbon::now()->format('my').'-';
      $data  = [
      'title'   =>  'Invoice',
      'tag'     =>  'invoice',
      'newid'   =>  $this->genid('Invoice', $date),
      'tanggal' =>  $this->datenowtoview(),
      ];
      // dd($data);
      return view('finance.invoice.index', $data);
  }

  public function piutang_index()
  {
      $data  = [
      'title'   =>  'Piutang',
      'tag'     =>  'piutang',
      ];
      return view('finance.piutang.index', $data);
  }

 public function piutang_api()
  {
      // dd(1);
      $data = DB::table('piutang')
      ->select('piutang.*', 'costumer.name as nama_costumer')
      ->join('costumer', 'piutang.id_costumer', '=', 'costumer.id')
      ->get();

      return DataTables::of($data)
      ->editColumn(
          'total_piutang', function ($data) {
              return 'Rp. '.number_format($data->total_piutang, 2);
          }
      )
      ->editColumn(
          'status', function ($data) {
            if($data->status == '2'){
              return 'Paid';
            } elseif ($data->status == '1'){
              return 'Partial';
            } else {
              return 'Not Paid';
            }
          }
      )
      ->addColumn(
          'action', function ($data) {
            if($data->status == 2){
              return
              '<a onclick="printData(\''.$data->no_invoice.'\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-print"></i> View & Print Invoice</a>';
            } else {
              return
              '<a onclick="printData(\''.$data->no_invoice.'\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-print"></i> View & Print Invoice</a> &nbsp;
              <a onclick="bayarData(\''.$data->no_invoice.'\')" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-import"></i> Terima Pembayaran</a> &nbsp;';
            }
          }
      )
      ->make(true);
  }

  public function bayar_invoice($id)
  {
      $data = Invoice::Select('invoice.*', 'piutang.*','costumer.name as nama_costumer')
      ->where('invoice.id', $id)
      ->leftJoin('costumer', 'invoice.id_costumer', '=', 'costumer.id')
      ->leftJoin('piutang', 'piutang.no_invoice', '=', 'invoice.id')
      ->get();
      // dd($data);
      $data_view = [
      'title' => 'Penerimaan Pembayaran',
      'id' => $data[0]['id'],
      'no_invoice' => $id,
      'id_costumer' => $data[0]['id_costumer'],
      'nama_costumer' => $data[0]['nama_costumer'],
      'total' => number_format($data[0]['total_piutang'], 2),
      'sisa' => (isset($data[0]['total_sisa'])) ? number_format($data[0]['total_sisa'], 2) : 0,
      // 'status_pembayaran' => ($data[0]['status'] == '2') ? 'Lunas' : 'Belum Lunas',
      'tag' => 'invoice',
      'tanggal' => $this->datenowtoview(),
      ];

      return view('finance.invoice.pembayaran', $data_view);
  }

//Pembayaran Invoice
  public function bayar_invoice_create(Request $request)
  {
      $r    = $request->all();
      $i    = $this->genindex('PembayaranPiutang');
      $id = $this->genid('PembayaranPiutang', 'PP');
      // dd($r);
      $data = [
      'id'            => $id,
      'index'         => $i,
      'tanggal_bayar' => $this->dateviewtodb($r['tanggal']),
      // 'id_payment'    => $r['id_payment'],
      'total_bayar'   => $this->ribuantodb($r['jumlah_bayar']),
      'akun_id'       => $r['id_akun'],
      'status'        => 'A'
      ];
      // dd($id);
      // Insert Data Detail
        $data_detail = [
          'id_pembayaran' => $id,
          'index'         => $i,
          'no_invoice'     => $r['no_invoice'],
          'jumlah_bayar'  => $this->ribuantodb($r['jumlah_bayar']),
          'keterangan'    => $r['deskripsi'],
          'status'        => 'A'
        ];
        
          PembayaranDetailPiutang::create($data_detail);

      // Update Piutang
          $data_piutang = Piutang::where('no_invoice','=',$r['no_invoice'])->get();
          $total_bayar = (isset($data_piutang[0]->total_bayar)) ? $this->ribuantodb($data_piutang[0]->total_bayar) : 0;   
          $total_sisa = (isset($data_piutang[0]->total_sisa)) ? $this->ribuantodb($data_piutang[0]->total_sisa) : 0; 
          $status = 0;
          $bayar = $total_bayar + $this->ribuantodb($r['jumlah_bayar']);
          $saldo = $total_sisa - $this->ribuantodb($r['jumlah_bayar']);
          
          if ($saldo < 1){
            $status = 2;
          } else {
            $status = 1;
          }
          
          $data_update = [
            'total_bayar' => $bayar,
            'total_sisa' => $saldo,
            'status' => $status
          ];

        Piutang::where('no_invoice','=',$r['no_invoice'])->update($data_update);

      
      PembayaranPiutang::create($data);

      $get_id_akun = Costumer::select('akun_id')
      ->where('id', '=', $r['id_costumer_text'])
      ->get();

      if (isset($get_id_akun[0]['akun_id'])) {
          $id_akun_tujuan = $get_id_akun[0]['akun_id'];
      } else {
          $id_akun_tujuan = '';
      }

      //Fungsi Akuntansi  
      $id_akun = [$r['id_akun'], $id_akun_tujuan];
      $debit = [0, (int)$this->ribuantodb($r['jumlah_bayar'])];
      $credit = [(int)$this->ribuantodb($r['jumlah_bayar']), 0];
      $ref_type = ['pembayaran_piutang', 'pembayaran_piutang'];
      $ref_id = [$id, $id];
      $memo = ['Pembayaran Piutang dengan Id : ' . $r['no_invoice'], 'Pembayaran Piutang dengan Id : ' . $r['no_invoice']];
      $date = [$this->datenowtodb(), $this->datenowtodb()];
      $currency = ['IDR', 'IDR'];
      
      $data = [
        'akun_id' => $id_akun,
        'debit' => $debit,
        'credit' => $credit,
        'ref_type' => $ref_type,
        'ref_id' => $ref_id,
        'memo' => $memo,
        'date' => $date,
        'currency' => $currency,
      ];
      // dd($data);
      $create_jurnal = $this->create_jurnal($data);

      return response()->json(
          [
          'status'  => true,
          'message' => 'Transaksi Pembayaran Piutang Created',
          ]
      );
  }


  public function invoice_create(Request $request)
  {
      $r    = $request->all();
      $i    = $this->genindex('Invoice');
      // dd($this->dateviewtodb($r['tanggal']));
      $data = [
      'id'            => $r['id'],
      'index'         => $i,
      'tanggal'       => $this->dateviewtodb($r['tanggal']),
    //   'jatuh_tempo'   => $this->dateviewtodb($r['jatuh_tempo']),
      'id_costumer'   => $r['id_costumer'],
    //   'top'           => $r['top'],
      'total_qty'     => $r['total_qty'],
      'sub_total'     => $this->ribuantodb($r['sub_total']),
      'dp'            => $this->ribuantodb($r['dp']),
      'pph'           => $this->ribuantodb($r['pph']),
      'grand_total'   => $this->ribuantodb($r['grand_total']),
      'terbilang'     => $r['terbilang'],
      'isactive'      => 'N'
      ];
// dd($data);
      for ($i=0; $i < count($r['master_bj_id']); $i++) {
          $data_detail = [
          'id_invoice'    => $r['id'],
          'index'         => $i,
          'kode_bj'       => $r['master_bj_id'][$i],
          'name'          => $r['deskripsi'][$i],
          'qty'           => $this->ribuantodb($r['qty'][$i]),
          'unit_price'    => $this->ribuantodb($r['price'][$i]),
          'discount'      => $this->ribuantodb($r['disc'][$i]),
          'total_price'   => $this->ribuantodb($r['total'][$i]),
          'isactive'      => 'A'
          ];

          $barang_stock = MasterBJ::where('id', $r['master_bj_id'][$i])->get();
          $a = $barang_stock[0]['stock'];
          $b = $this->ribuantodb($r['qty'][$i]);
          $c = $a-$b;
          if ($c<0) {
              InvoiceDetail::where('id_invoice', $r['id'])->delete();
              return response()->json(
                  [
                  'status'  => false,
                  'message' => 'Cek kembali stock barang!'
                  ]
              );
          } else {
              InvoiceDetail::create($data_detail);
              $data_update = [
              'stock' => $c
              ];
              MasterBJ::where('id', $r['master_bj_id'][$i])->update($data_update);
          }
      }

      $invoice = Invoice::create($data);

        if($request['pembayaran'] == 'C'){
             $id_akun_tujuan = $request['id_akun'];
        } else {
            $get_id_akun_costumer = Costumer::select('akun_id')
                ->where('id', '=', $r['id_costumer'])
                ->get();

            if (isset($get_id_akun_costumer[0]['akun_id'])) {
                $id_akun_tujuan = $get_id_akun_costumer[0]['akun_id'];
            } else {
                $id_akun_tujuan = '';
            }

            // Pengisian ke piutang
            $id_piutang = $this->genid('Piutang', 'P');
            $index_piutang = $this->genindex('Piutang');
            $type_piutang = 'inv';
            $tanggal_invoice = $this->datetodb($request['tanggal']);
            $tanggal = Carbon::createFromDate(substr($request['tanggal'], 6, 4), substr($request['tanggal'], 3, 2), substr($request['tanggal'], 0, 2), 0);
            $tempo = ($request['tempo'] == null) ? 0 : $request['tempo'];
            $tanggal_jatuh_tempo = $tanggal->addDays((int)$tempo);
            $data_piutang = [
                'id' => $id_piutang,
                'index' => $index_piutang,
                'id_costumer' => $request['id_costumer'],
                'type' => $type_piutang,
                'no_invoice' => $request['id'],
                'tanggal_invoice' => $tanggal_invoice,
                'total_piutang' => $this->ribuantodb($request['grand_total']),
                'total_bayar' => 0,
                'total_sisa' => $this->ribuantodb($request['grand_total']),
                'tempo' => $tempo,
                'tanggal_jatuh_tempo' => $tanggal_jatuh_tempo,
                'status' => 0,
            ];

            // dd($data_piutang);
            Piutang::create($data_piutang);
            $invoice->update(
                [
                  'jatuh_tempo' => $tanggal_jatuh_tempo,  
                  'top' => $tempo,  
                ]
            );

    }      

      //Fungsi Akuntansi 
      $total = $this->ribuantodb($r['grand_total']);
      $id = [$id_akun_tujuan, '4401010001', '5501010001', '5501020006'];
      $debit = [(int)$total, 0, (int)$total, 0];
      $credit = [0, (int)$total, 0, (int)$total];
      $ref_type = ['penjualan', 'penjualan', 'penjualan', 'penjualan'];
      $ref_id = [$r['id'], $r['id'], $r['id'], $r['id']];
      $memo = ['PENJUALAN DENGAN INVOICE NO : ' . $r['id'],'PENJUALAN DENGAN INVOICE NO : ' . $r['id'], 'PENJUALAN DENGAN INVOICE NO : ' . $r['id'], 'PENJUALAN DENGAN INVOICE NO : ' . $r['id']];
      $date = [$this->datenowtodb(), $this->datenowtodb(), $this->datenowtodb(), $this->datenowtodb()];
      $currency = ['IDR', 'IDR', 'IDR', 'IDR']; 

      $data = [
      'akun_id' => $id,
      'debit' => $debit,
      'credit' => $credit,
      'ref_type' => $ref_type,
      'ref_id' => $ref_id,
      'memo' => $memo,
      'date' => $date,
      'currency' => $currency,
      ];

      $create_jurnal = $this->create_jurnal($data);

      $date = Carbon::now()->format('my').'-';
      $newid = $this->genid('Invoice', $date);

      return response()->json(
          [
          'status'  => true,
          'message' => 'Transaksi Invoice created',
          'newid'   => $newid
          ]
      );
  }

  public function invoice_api()
  {
      // dd(1);
      $data = DB::table('piutang')
      ->select('invoice.*', 'costumer.name as nama_costumer')
      ->join('costumer', 'invoice.id_costumer', '=', 'costumer.id')
      ->get();
      return DataTables::of($data)
      ->editColumn(
          'grand_total', function ($data) {
              return 'Rp. '.number_format($data->grand_total, 2);
          }
      )
      ->editColumn(
          'total_qty', function ($data) {
              return number_format($data->total_qty, 0).' Pcs';
          }
      )
      ->addColumn(
          'action', function ($data) {
              return
              '<a onclick="printData(\''.$data->id.'\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-print"></i> View & Print</a> &nbsp;
              <a onclick="bayarData(\''.$data->id.'\')" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-import"></i> Terima Pembayaran</a> &nbsp;';
          }
      )
      ->make(true);
  }

  public function invoice_view($id)
  {
      $profile   = Param::all();
      $invoice = DB::table('invoice')
      ->select(
          'invoice.*', 
          'invoice_detail.*',
          'costumer.name as nama_costumer',
          'costumer.alamat as alamat_costumer',
          'proses.name as nama_proses',
          'satuan.name as nama_satuan',
          'barang.name as nama_barang'
      )
      ->join('costumer', 'invoice.id_costumer', '=', 'costumer.id')
      ->join('invoice_detail', 'invoice.id', '=', 'invoice_detail.id_invoice')
      ->join('proses', 'invoice.id_proses', '=', 'proses.id')
      ->join('satuan', 'invoice_detail.id_satuan', '=', 'satuan.id')
      ->join('barang', 'invoice_detail.id_barang', '=', 'barang.id')
      ->where('invoice.id', '=', $id)
      ->get();

      $currency = $this->cek_currency($invoice[0]->currency);

      return response()->json(
          [
          'data'    =>  $invoice,
          'profile' =>  $profile,
          'type'    =>  'M',
          'currency' =>  $currency,
          ]
      );
  }

  public function invoice_print($id)
  { 
      $check = Invoice::findOrFail($id);
      $title      = 'INVOICE';
      $data       = DB::table('invoice')
      ->select(
          'invoice.*',
          'invoice_detail.*',
          'costumer.name as nama_costumer'
      )
      ->leftJoin('costumer', 'invoice.id_costumer', '=', 'costumer.id')
      ->leftJoin('invoice_detail', 'invoice.id', '=', 'invoice_detail.id_invoice')
      ->where('invoice.id', '=', $id)
      ->get();

      $row = 1 - count($data);
      if ($row > 1) {
          $row = 0;
      }

      $currency = 'Rp';
      $data_perusahaan = Param::all();
      $data = [
        'title'       =>  $title,
        'data'        =>  $data,
        'name_company'=>  $data_perusahaan[0]['name_perusahaan'],
        'alamat'      =>  'Office : '.$data_perusahaan[0]['alamat'],
        'telepon'     =>  'Telepon : '.$data_perusahaan[0]['telepon'],
        'logo'        =>  $data_perusahaan[0]['logo_perusahaan'],
        'currency'    =>  $currency,
        'row'         =>  $row,
        'total_trans' =>  $data[0]->grand_total
      ];
      $pdf  = PDF::loadView('finance.invoice.print.print', $data);
      $pdf->setPaper('a4', 'potrait');
      return $pdf->stream();
  }

  public function invoice_acc(Request $request)
  {
      $r          = $request->all();
      $userid     = Auth::user()->id;
      $verify     = User::findOrFail($userid);
      if ($r['pin'] != $verify->pin) {
          return response()->json(
              [
              'status' => false,
              'message' => 'Pin Salah! '
              ]
          );
      }
      $role       = Auth::user()->role;
      $invoice  = Invoice::findOrFail($r['id']);
      if ($role == '0004') {
          $data     = [
          'tgl_acc_1' => $this->datenowtodb(),
          'id_user_acc_1' => $userid
          ];
      } elseif ($role == '0003') {
          $data     = [
          'tgl_acc_2' => $this->datenowtodb(),
          'id_user_acc_2' => $userid
          ];
      } elseif ($role == '0002' || $role == '0001') {
          $data     = [
          'tgl_acc_3' => $this->datenowtodb(),
          'id_user_acc_3' => $userid,
          'status' => 'C',
          'isactive' => 'A'
          ];
          //212
          // Barang::where('id',)
      } else {
          return response()->json(
              [
              'status' => false,
              'message' => 'Acc Batal'
              ]
          );
      }

      $invoice->update($data);
      return response()->json(
          [
          'status' => true,
          'message' => 'Acc Berhasil'
            ]
      );
  }

  public function invoice_cancel(Request $request)
  {
      $r          = $request->all();
      $name       = Auth::user()->name;
      $data       = [
      'catatan_pembatalan' => $r['msg'].', by: '.$name,
      'isactive' => 'C'
      ];
      $invoice  = Invoice::findOrFail($r['id']);
      $invoice->update($data);
      return response()->json(
          [
          'status' => true,
          'message' => 'Cancel Berhasil'
            ]
      );
  }

  public function laporan_hutang_view($from,$to,$type,$kategori,$id)
  {
    ($from == 'all') ? $f = 'all': $f = Carbon::createFromDate(substr($from, 6, 4), substr($from, 0, 2), substr($from, 3, 2));
    ($to == 'all') ? $t = 'all': $t = Carbon::createFromDate(substr($to, 6, 4), substr($to, 0, 2), substr($to, 3, 2));
    $title = 'Hutang';
    $range = ($f != 'all' && $t != 'all') ? true : false ;
    $date_now = Carbon::now();
    $date_min_7 = Carbon::now()->subDays(7);

    if($type == 'all'){
      if($kategori == 's'){
        $data = DB::table('hutang')
              ->select('hutang.*','supplier.name as nama')
              ->leftJoin('supplier','supplier.id','=','hutang.id_supplier')
              ->when($range == true, function ($query) use ($f,$t) {
                      return $query->whereBetween('hutang.tanggal_jatuh_tempo', [$f,$t]); })
              ->when($id != 'all', function ($query) use ($id) {
                      return $query->where('hutang.id_supplier', '=', $id); })
              ->where('status','<>','2')
              ->orderBy('hutang.id', 'DESC')
              ->get();
  
      $total = DB::table('hutang')
            ->selectRaw('sum(hutang.total_sisa) as total')
            ->when($range == true, function ($query) use ($f,$t) {
              return $query->whereBetween('hutang.tanggal_jatuh_tempo', [$f,$t]); })
            ->when($id != 'all', function ($query) use ($id) {
              return $query->where('hutang.id_supplier', '=', $id); })
            ->where('status','<>','2')
            ->get();
      } else {
        // dd(1);
        $data = DB::table('hutang')
              ->select('hutang.*','cmt.name as nama')
              ->leftJoin('cmt','cmt.id','=','hutang.id_cmt')
              ->when($id != 'all', function ($query) use ($id) {
                      return $query->where('hutang.id_cmt', '=', $id); })
              ->where('status','<>','2')
              ->orderBy('hutang.id', 'DESC')
              ->get();
  
      $total = DB::table('hutang')
            ->selectRaw('sum(hutang.total_sisa) as total')
            ->when($id != 'all', function ($query) use ($id) {
              return $query->where('hutang.id_cmt', '=', $id); })
            ->where('status','<>','2')
            ->get();
      }
      

    } elseif ($type == 'akan_jatuh_tempo') {
      if($kategori == 's'){
        $data = DB::table('hutang')
          ->select('hutang.*', 'supplier.name as nama')
          ->leftJoin('supplier', 'supplier.id', '=', 'hutang.id_supplier')
          ->where('status', '<>', '2')
          ->whereBetween('tanggal_jatuh_tempo',[$date_min_7,$date_now])
          ->orderBy('hutang.id', 'DESC')
          ->get();
  
        $total = DB::table('hutang')
            ->selectRaw('sum(hutang.total_sisa) as total')
            ->whereBetween('tanggal_jatuh_tempo', [$date_min_7,$date_now])
            ->where('status', '<>', '2')
            ->get();
      } else {
        $data = DB::table('hutang')
          ->select('hutang.*', 'cmt.name as nama')
          ->leftJoin('cmt', 'cmt.id', '=', 'hutang.id_cmt')
          ->where('status', '<>', '2')
          ->orderBy('hutang.id', 'DESC')
          ->get();
  
        $total = DB::table('hutang')
            ->selectRaw('sum(hutang.total_sisa) as total')
            ->where('status', '<>', '2')
            ->get();
      }        
    } elseif ($type == 'jatuh_tempo') {
      if($kategori == 's'){
        $data = DB::table('hutang')
          ->select('hutang.*', 'supplier.name as nama')
          ->leftJoin('supplier', 'supplier.id', '=', 'hutang.id_supplier')
          ->where('status', '<>', '2')
          ->whereDate('tanggal_jatuh_tempo', '<=', $date_now)
          ->orderBy('hutang.id', 'DESC')
          ->get();
  
        $total = DB::table('hutang')
            ->selectRaw('sum(hutang.total_sisa) as total')
            ->where('status', '<>', '2')
            ->whereDate('tanggal_jatuh_tempo', '<=', $date_now)
            ->get();
      } else {
        $data = DB::table('hutang')
          ->select('hutang.*', 'cmt.name as nama')
          ->leftJoin('cmt', 'cmt.id', '=', 'hutang.id_cmt')
          ->where('status', '<>', '2')
          ->orderBy('hutang.id', 'DESC')
          ->get();
  
        $total = DB::table('hutang')
            ->selectRaw('sum(hutang.total_sisa) as total')
            ->where('status', '<>', '2')
            ->get();
      }       
    }

    $currency = 'Rp';
    $data_perusahaan = Param::all();
    $data_send = [
      'title'       =>  $title,
      'data'        =>  $data,
      'name_company'=>  $data_perusahaan[0]['name_perusahaan'],
      'alamat'      =>  'Office : '.$data_perusahaan[0]['alamat'],
      'telepon'     =>  'Telepon : '.$data_perusahaan[0]['telepon'],
      'logo'        =>  $data_perusahaan[0]['logo_perusahaan'],
      'currency'    =>  $currency,
      'priode'      =>  ($from == 'all') ? '-' : Carbon::parse($f)->format('d/m/Y').' sampai '.Carbon::parse($t)->format('d/m/Y'),
      'total'       =>  (isset($total[0]->total)) ? $total[0]->total : 0,
    ];
      // dd($data_send);
      $pdf  = PDF::loadView('finance.report.print.print_hutang', $data_send);
      $pdf->setPaper('a4', 'landscape');
      return $pdf->stream();
  }

  public function laporan_pembelian_bahan_baku_index($kategori)
  {
    // dd($kategori);
    $data = [
    'title' => 'Laporan Pembelian Bahan Baku',
    'tag' => 'bahan_baku_by_supplier',
    'bulan' => $this->getbulan(),
    'tahun' => $this->gettahun(),
    'tanggal' => $this->datenowtoview(),
    'kategori' => $kategori,
    ];
    // dd($data);
    return view('finance.report.laporan_pembelian_bahan_baku', $data);
  }

  public function view_laporan_pembelian_bahan_baku($kategori,$from,$to,$id)
  {
    // dd($kategori,$from,$to,$id);
    $f = Carbon::createFromDate(substr($from, 6, 4), substr($from, 0, 2), substr($from, 3, 2));
    $t = Carbon::createFromDate(substr($to, 6, 4), substr($to, 0, 2), substr($to, 3, 2));

    
    $nama = '';
    $total = 0;
    $total_qty = 0;
    if($kategori == 'supplier'){
      $title      = 'LAPORAN PEMBELIAN PER SUPPLIER';
      $data       = PembelianBBDetail::select('pembelian_bb_detail.*', 'bahan_baku.name as nama_bahan_baku', 'satuan.name as nama_satuan')
      ->leftJoin('satuan', 'pembelian_bb_detail.id_satuan', '=', 'satuan.id')
      ->leftJoin('bahan_baku', 'pembelian_bb_detail.id_bb', '=', 'bahan_baku.id')
      ->whereBetween('pembelian_bb_detail.tanggal', [$f,$t])
      ->where('pembelian_bb_detail.id_supplier', '=', $id)
      ->orderBy('pembelian_bb_detail.tanggal', 'ASC')
      ->get();
      $data_nama = Supplier::select('name')    
      ->where('id', '=', $id)
      ->get();
      $nama = $data_nama[0]['name'];
      $data_total = PembelianBBDetail::select(DB::raw('sum(jumlah) as total'))    
      ->whereBetween('tanggal', [$f,$t])
      ->where('id_supplier', '=', $id)
      ->get();

      if(isset($data_total[0]['total'])) {
        $total = $data_total[0]['total'];
      }

     } elseif ($kategori == 'jenis') {
       $title      = 'LAPORAN PEMBELIAN PER ITEM BARANG';
       $data       = PembelianBBDetail::select('pembelian_bb_detail.*','pembelian_bb.id_faktur','pembelian_bb.tgl_faktur', 'bahan_baku.name as nama_bahan_baku', 'supplier.name as nama_supplier', 'satuan.name as nama_satuan')
       ->leftJoin('satuan', 'pembelian_bb_detail.id_satuan', '=', 'satuan.id')
       ->leftJoin('supplier', 'pembelian_bb_detail.id_supplier', '=', 'supplier.id')
       ->leftJoin('bahan_baku', 'pembelian_bb_detail.id_bb', '=', 'bahan_baku.id')
       ->leftJoin('pembelian_bb', 'pembelian_bb_detail.id_bp', '=', 'pembelian_bb.id')
       ->whereBetween('pembelian_bb_detail.tanggal', [$f,$t])
       ->where('pembelian_bb_detail.id_bb', '=', $id)
       ->orderBy('pembelian_bb_detail.tanggal', 'ASC')
       ->get();
        $data_nama = BahanBaku::select('name')    
        ->where('id', '=', $id)
        ->get();
        $nama = $data_nama[0]['name'];
        $data_total = PembelianBBDetail::select(DB::raw('sum(jumlah) as total'),DB::raw('sum(qty) as qty'))    
        ->whereBetween('tanggal', [$f,$t])
        ->where('id_bb', '=', $id)
        ->get();

        if(isset($data_total[0]['total'])) {
            $total = $data_total[0]['total'];
            $total_qty = $data_total[0]['qty'];
        }
      }
    //  dd($data);


    // dd($data);
      $currency = 'Rp';
      $data_perusahaan = Param::all();
      $data_send = [
        'title'       =>  $title,
        'data'        =>  $data,
        'name_company'=>  $data_perusahaan[0]['name_perusahaan'],
        'alamat'      =>  'Office : '.$data_perusahaan[0]['alamat'],
        'telepon'     =>  'Telepon : '.$data_perusahaan[0]['telepon'],
        'logo'        =>  $data_perusahaan[0]['logo_perusahaan'],
        'currency'    =>  $currency,
        'kode_name'   =>  'KODE : '.$id.' / NAMA : '.$nama,
        'priode'      =>  $from.' sampai '.$to,
        'total'       =>  $total,
        'total_qty'   =>  $total_qty,
      ];
      // dd($data_send);
      if($kategori == 'supplier'){
        $pdf  = PDF::loadView('finance.report.print.print_pembelian_bahan_baku_supplier', $data_send);
      } elseif ($kategori == 'jenis') {
        $pdf  = PDF::loadView('finance.report.print.print_pembelian_bahan_baku_jenis', $data_send);
      }

      $pdf->setPaper('a4', 'landscape');
      return $pdf->stream();
  } 



  // SKB
  public function skb_keluar_finance_index()
  {
    $tanggal = $this->datenowtoview();
    $title = 'SKB Keluar';
    $tag = 'skb_keluar_finance';
    return view('accounting.skb.skb_keluar', ['tanggal' => $tanggal, 'title' => $title, 'tag' => $tag]);
  }

  public function skb_masuk_finance_index()
  {
    $tanggal = $this->datenowtoview();
    $title = 'SKB Masuk';
    $tag = 'skb_masuk_finance';
    return view('accounting.skb.skb_masuk', ['tanggal' => $tanggal, 'title' => $title, 'tag' => $tag]);
  }

  public function skb_adjust_finance_index()
  {
    $tanggal = $this->datenowtoview();
    $title = 'SKB Adjust';
    $tag = 'skb_adjust_finance';
    return view('accounting.skb.skb_adjust', ['tanggal' => $tanggal, 'title' => $title, 'tag' => $tag]);
  }

  public function get_skb_keluar_finance(Request $request)
  {
    $r = $request->all();
    $param = (!isset($r['search'])) ? '' : $r['search'];
    $data = DB::select('select skb.id as id, skb.id as text
    from skb where id like \'%' . $param . '%\'
    AND type = \'K\' order by skb.id asc ');
    return response()->json($data);
  }

  public function get_skb_masuk_finance(Request $request)
  {
    $r = $request->all();
    $param = (!isset($r['search'])) ? '' : $r['search'];
    $data = DB::select('select skb.id as id, skb.id as text
    from skb where id like \'%' . $param . '%\'
    AND type = \'M\' order by skb.id asc ');
    return response()->json($data);
  }

  public function get_skb_adjust_finance(Request $request)
  {
    $r = $request->all();
    $param = (!isset($r['search'])) ? '' : $r['search'];
    $data = DB::select('select skb.id as id, skb.id as text
    from skb where id like \'%' . $param . '%\'
    AND type <> \'M\' AND type <> \'K\' order by skb.id asc ');
    return response()->json($data);
  }

  public function get_detail_skb_keluar_finance(Request $request)
  {
    $r = $request->all();
    $data = DB::table('skb')
      ->select('skb.*', 'skb_detail.qty', 'skb_detail.so_id', 'skb_detail.art_id', 'skb_detail.name as nama_produk', 
      'skb_detail.status_cmt as status', 'cmt.name as nama_cmt', 'proses.name as nama_proses', 'satuan.name as nama_satuan')
      ->join('skb_detail', 'skb.id', '=', 'skb_detail.skb_id')
      ->join('cmt', 'skb_detail.cmt_id', '=', 'cmt.id')
      ->join('satuan', 'skb_detail.satuan_id', '=', 'satuan.id')
      ->join('proses', 'skb.proses_id', '=', 'proses.id')
      ->where('skb.type', 'K')
      ->where('skb.id', $r['id'])
      ->get();
    return response()->json($data);
  }

  public function get_detail_skb_masuk_finance(Request $request)
  {
    $r = $request->all();
    $skm = DB::table('skb')
      ->select('skb.*', 'skb_detail.skk_id', 'skb_detail.qty', 'skb_detail.cmt_id', 'skb_detail.total as total_item', 
      'skb_detail.so_id', 'skb_detail.art_id', 'skb_detail.name as nama_produk', 'skb_detail.status_cmt as status', 
      'cmt.name as nama_cmt', 'proses.name as nama_proses', 'satuan.name as nama_satuan', 'skb_detail.harga as harga')
      ->join('skb_detail', 'skb.id', '=', 'skb_detail.skb_id')
      ->join('cmt', 'skb_detail.cmt_id', '=', 'cmt.id')
      ->join('satuan', 'skb_detail.satuan_id', '=', 'satuan.id')
      ->join('proses', 'skb.proses_id', '=', 'proses.id')
      ->where('skb.type', 'M')
      ->where('skb.id', $r['id'])
      ->get();
    $skk = DB::table('skb')
      ->select('skb.*', 'skb_detail.skk_id', 'skb_detail.qty', 'skb_detail.so_id', 'skb_detail.art_id', 'skb_detail.name as nama_produk', 
      'skb_detail.status_cmt as status', 'cmt.name as nama_cmt', 'proses.name as nama_proses', 'satuan.name as nama_satuan')
      ->join('skb_detail', 'skb.id', '=', 'skb_detail.skb_id')
      ->join('cmt', 'skb_detail.cmt_id', '=', 'cmt.id')
      ->join('satuan', 'skb_detail.satuan_id', '=', 'satuan.id')
      ->join('proses', 'skb.proses_id', '=', 'proses.id')
      ->where('skb.type', 'K')
      ->where('skb.id', $skm[0]->skk_id)
      ->get();
    $data = [
      'skm' => $skm,
      'skk' => $skk,
    ];
    return response()->json($data);
  }

  public function get_detail_skb_adjust_finance(Request $request)
  {
    $r = $request->all();
    $data = DB::table('skb')
      ->select('skb.*', 'skb_detail.qty', 'skb_detail.cmt_id', 'skb_detail.total as total_item', 'skb_detail.so_id', 'skb_detail.art_id', 'skb_detail.name as nama_produk', 'skb_detail.status_cmt as status', 'cmt.name as nama_cmt', 'proses.name as nama_proses', 'satuan.name as nama_satuan', 'skb_detail.harga as harga')
      ->join('skb_detail', 'skb.id', '=', 'skb_detail.skb_id')
      ->join('cmt', 'skb_detail.cmt_id', '=', 'cmt.id')
      ->join('satuan', 'skb_detail.satuan_id', '=', 'satuan.id')
      ->join('proses', 'skb.proses_id', '=', 'proses.id')
      ->where('skb.id', $r['id'])
      ->get();
    return response()->json($data);
  }

  public function skb_masuk_finance_create(Request $request)
  {
    $r = $request->all();
    $grand_total = 0;
    for ($i = 0; $i < count($r['harga']); $i++) {
      $harga = $this->ribuantodb($r['harga'][$i]);
      $total = $this->ribuantodb($r['total'][$i]);
      $grand_total = (int)$grand_total + (int)$total;
      $data_update = [
        'harga' => $harga,
        'total' => (int)$total,
      ];

      $update = SkbDetail::where('art_id', $r['art'][$i])
        ->where('so_id', $r['so'][$i])
        ->where('skb_id', $r['skb_id'])
        ->update($data_update);

      $cmt_id = Cmt::select('akun_id')
        ->where('cmt.id', $r['cmt_id'])
        ->get();

      $id = ['5501010001', $cmt_id[0]['akun_id']];
      $debit = [$total, 0];
      $credit = [0, $total];
      $ref_type = ['skb', 'skb'];
      $ref_id = [$r['so'][$i], $r['so'][$i]];
      $memo = ['skb so : ' . $r['so'][$i], 'skb so : ' . $r['so'][$i]];
      $date = $this->datenowtodb();
      $currency = 'IDR';

      $data = [
        'akun_id' => $id,
        'debit' => $debit,
        'credit' => $credit,
        'ref_type' => $ref_type,
        'ref_id' => $ref_id,
        'memo' => $memo,
        'date' => $date,
        'currency' => $currency,
      ];

      $create_jurnal = $this->create_jurnal($data);
    }

    $update = Skb::where('skb.id', $r['skb_id'])
      ->update([
        'total' => $grand_total,
      ]);

    return response()->json([
      'status' => true,
      'message' => 'SKB Masuk Finance Created',
    ]);
  }

  public function skb_adjust_finance_create(Request $request)
  {
    $r = $request->all();
    $grand_total = 0;
    for ($i = 0; $i < count($r['harga']); $i++) {
      $harga = $this->ribuantodb($r['harga'][$i]);
      $total = $this->ribuantodb($r['total'][$i]);
      $grand_total = (int)$grand_total + (int)$total;
      $data_update = [
        'harga' => $harga,
        'total' => (int)$total,
      ];

      $update = SkbDetail::where('art_id', $r['art'][$i])
        ->where('so_id', $r['so'][$i])
        ->where('skb_id', $r['skb_id'])
        ->update($data_update);

      if ($r['status'][$i] == 'Invoice CMT') {
        $cmt_id = Cmt::select('akun_id')
          ->where('cmt.id', $r['cmt_id'])
          ->get();

        $id = ['5501010001', $cmt_id[0]['akun_id']];
        $debit = [0, $total];
        $credit = [$total, 0];
        $ref_type = ['skb', 'skb'];
        $ref_id = [$r['so'][0], $r['so'][0]];
        $memo = ['skb so : ' . $r['so'][0], 'skb so : ' . $r['so'][0]];
        $date = $this->datenowtodb();
        $currency = 'IDR';

        $data = [
          'akun_id' => $id,
          'debit' => $debit,
          'credit' => $credit,
          'ref_type' => $ref_type,
          'ref_id' => $ref_id,
          'memo' => $memo,
          'date' => $date,
          'currency' => $currency,
        ];
        $create_jurnal = $this->create_jurnal($data);
      }
    }

    $update = Skb::where('skb.id', $r['skb_id'])
      ->update([
        'total' => $grand_total,
      ]);

    return response()->json([
      'status' => true,
      'message' => 'SKB Adjust Finance Created',
    ]);
  }

  public function giro_keluar_index()
  {
      $data  = [
      'title'   =>  'Giro Keluar',
      'tag'     =>  'giro_keluar',
      'tanggal' =>  $this->datenowtoview(),
      ];
      return view('finance.giro.keluar.giro_keluar', $data);
  }
  
  public function giro_keluar_create(Request $request)
  {
    $r = $request->all();
    $id = $this->genid('CekGiro', 'G');
    $index = $this->genindex('CekGiro');
    $type = 'K';
    $status = 'P';

    $data = [
        'id' => $id,
        'index' => $index,
        'type' => $type,
        'status' => $status,
        'tanggal_keluar' => $this->dateviewtodb($r['tanggal']),
        'tanggal_jatuh_tempo' => $this->dateviewtodb($r['tanggal_jatuh_tempo']),
        'no_cek_giro_pelanggan' => $r['no_giro_pelanggan'],
        'no_cek_giro_sendiri' => $r['no_giro_sendiri'],
        'id_akun_debet' => $r['id_akun_debet'],
        'id_akun_kredit' => $r['id_akun_kredit'],
        'nominal' => $this->ribuantodb($r['nilai_nominal']),
        'uraian' => $r['uraian'],
      ];
      
    $create = CekGiro::create($data);

    return response()->json([
      'status' => true,
      'message' => 'Giro Created',
    ]);
  }

  public function giro_keluar_aprove(Request $request)
  {
    $r = $request->all();
    $id = $r['id'];

    $data = CekGiro::where('id',$id)->get();

    //Fungsi Akuntansi  
    $id = [$data[0]->id_akun_debet, $data[0]->id_akun_kredit];
    $debit = [(int)$this->ribuantodb($data[0]->nominal),0];
    $credit = [0,(int)$this->ribuantodb($data[0]->nominal)];
    $ref_type = ['giro_keluar', 'giro_keluar'];
    $ref_id = [$r['id'], $r['id']];
    $memo = ['GIRO KELUAR DENGAN ID : ' . $r['id'], 'GIRO KELUAR DENGAN ID : ' . $r['id']];
    $date = $this->datenowtodb();
    $currency = 'IDR';
    $data = [
      'akun_id' => $id,
      'debit' => $debit,
      'credit' => $credit,
      'ref_type' => $ref_type,
      'ref_id' => $ref_id,
      'memo' => $memo,
      'date' => $date,
      'currency' => $currency,
    ];
    // dd($data);

    $create_jurnal = $this->create_jurnal($data);

    $update_grio = CekGiro::where('id',$r['id'])->update(['status'=>'A']);

    return response()->json([
      'status' => true,
      'message' => 'Giro Aproved',
    ]);
  }

  public function giro_keluar_api()
  {
      $data = DB::table('cek_giro')
      ->select('cek_giro.*')
      ->where('type','K')
      ->get();

      return DataTables::of($data)
      ->editColumn(
          'tanggal_keluar', function ($data) {
              return $this->datedbtoview($data->tanggal_keluar);
          }
      )
      ->editColumn(
          'tanggal_jatuh_tempo', function ($data) {
              return $this->datedbtoview($data->tanggal_jatuh_tempo);
          }
      )
      ->editColumn(
          'nominal', function ($data) {
              return 'Rp. '.number_format($data->nominal, 2);
          }
      )
      ->editColumn(
          'status', function ($data) {
            if($data->status == 'P'){
              return 'Process';
            } else {
              return 'Aproved';
            }
          }
      )
      ->addColumn(
          'action', function ($data) {
            if($data->status == 'P'){
              return '<a onclick="aprove(\''.$data->id.'\')" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-check"></i> Aprove</a> &nbsp;';
            } else {
              // return 'Aproved';
            }
          }
      )
      ->make(true);
  }

  public function giro_masuk_index()
  {
      $data  = [
      'title'   =>  'Giro Masuk',
      'tag'     =>  'giro_masuk',
      'tanggal' =>  $this->datenowtoview(),
      ];
      return view('finance.giro.masuk.giro_masuk', $data);
  }

    
  public function giro_masuk_create(Request $request)
  {
    $r = $request->all();
    $id = $this->genid('CekGiro', 'G');
    $index = $this->genindex('CekGiro');
    $type = 'M';
    $status = 'P';

    $data = [
        'id' => $id,
        'index' => $index,
        'type' => $type,
        'status' => $status,
        'tanggal_keluar' => $this->dateviewtodb($r['tanggal']),
        'tanggal_jatuh_tempo' => $this->dateviewtodb($r['tanggal_jatuh_tempo']),
        'no_cek_giro_pelanggan' => $r['no_giro_pelanggan'],
        'id_akun_debet' => $r['id_akun_debit'],
        'id_akun_kredit' => $r['id_akun_kredit'],
        'nominal' => $this->ribuantodb($r['nilai_nominal']),
        'uraian' => $r['uraian'],
      ];
      
    $create = CekGiro::create($data);

    return response()->json([
      'status' => true,
      'message' => 'Giro Created',
    ]);
  }

  public function giro_masuk_aprove(Request $request)
  {
    $r = $request->all();
    $id = $r['id'];

    $data = CekGiro::where('id',$id)->get();

    //Fungsi Akuntansi  
    $id = [$data[0]->id_akun_debet, $data[0]->id_akun_kredit];
    $debit = [(int)$this->ribuantodb($data[0]->nominal),0];
    $credit = [0,(int)$this->ribuantodb($data[0]->nominal)];
    $ref_type = ['giro_masuk', 'giro_masuk'];
    $ref_id = [$r['id'], $r['id']];
    $memo = ['GIRO KELUAR DENGAN ID : ' . $r['id'], 'GIRO KELUAR DENGAN ID : ' . $r['id']];
    $date = $this->datenowtodb();
    $currency = 'IDR';
    $data = [
      'akun_id' => $id,
      'debit' => $debit,
      'credit' => $credit,
      'ref_type' => $ref_type,
      'ref_id' => $ref_id,
      'memo' => $memo,
      'date' => $date,
      'currency' => $currency,
    ];
    // dd($data);

    $create_jurnal = $this->create_jurnal($data);

    $update_grio = CekGiro::where('id',$r['id'])->update(['status'=>'A']);

    return response()->json([
      'status' => true,
      'message' => 'Giro Aproved',
    ]);
  }

  public function giro_masuk_api()
  {
      $data = DB::table('cek_giro')
      ->select('cek_giro.*')
      ->where('type','M')
      ->get();

      return DataTables::of($data)
      ->editColumn(
          'tanggal_keluar', function ($data) {
              return $this->datedbtoview($data->tanggal_keluar);
          }
      )
      ->editColumn(
          'tanggal_jatuh_tempo', function ($data) {
              return $this->datedbtoview($data->tanggal_jatuh_tempo);
          }
      )
      ->editColumn(
          'nominal', function ($data) {
              return 'Rp. '.number_format($data->nominal, 2);
          }
      )
      ->editColumn(
          'status', function ($data) {
            if($data->status == 'P'){
              return 'Process';
            } else {
              return 'Aproved';
            }
          }
      )
      ->addColumn(
          'action', function ($data) {
            if($data->status == 'P'){
              return '<a onclick="aprove(\''.$data->id.'\')" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-check"></i> Aprove</a> &nbsp;';
            } else {
              // return 'Aproved';
            }
          }
      )
      ->make(true);
  }


  public function penjualan_index()
  {
    $data = [
      'title' => 'Penjualan',
      'tag' => 'penjualan',
      'tanggal' => $this->datenowtoview(),
    ];
    // dd($data);
    return view('finance.penjualan.index', $data);
  }


  public function penjualan_api(Request $request)
  {
    $r = $request->all();
    $f = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['from'], 6, 4) . '-' . substr($r['from'], 3, 2) . '-' . substr($r['from'], 0, 2) . ' 00:00:00');
    $t = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['to'], 6, 4) . '-' . substr($r['to'], 3, 2) . '-' . substr($r['to'], 0, 2) . ' 23:59:00');
    $data = DB::table('invoice')
      ->select(
        'invoice.id',
        'invoice.grand_total',
        'invoice.total_qty',
        'invoice.tanggal',
        'costumer.name as nama_customer'
      )
      ->leftJoin('costumer', 'costumer.id', '=', 'invoice.id_costumer')
      ->whereBetween('invoice.created_at', [$f, $t])
      ->get();

    return DataTables::of($data)
      ->editColumn('tanggal', function ($data) {
        return Carbon::parse($data->tanggal)->format('d/m/Y');
      })
      ->editColumn('grand_total', function ($data) {
        if ($data->grand_total > 0) {
          return 'Rp. ' . number_format($data->grand_total, 2);
        } else {
          return '';
        }
      })
      ->editColumn('total_qty', function ($data) {
        if ($data->total_qty > 0) {
          return number_format($data->total_qty, 2);
        } else {
          return '';
        }
      })
      ->addColumn('action', function ($data) {
        return 
      '<a onclick="viewData(\'' . $data->id . '\')" class="btn btn-primary btn-xs">View</a>';
      })
      ->make(true);
  }



}
