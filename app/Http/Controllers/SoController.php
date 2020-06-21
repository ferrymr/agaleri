<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Auth;
use PDF;
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
use App\Art;
use App\CatatanProduksi;
use App\PostArtDetail;
use DataTables;

class SoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // SO
    public function add_so()
    {
      $msg      = '';
      $date     = Carbon::now('Asia/Jakarta');
      $d        = $date->toDateTimeString();
      $tanggal_order = $this->datenowtoview();
      $y        = substr($d,2,2);
      $m        = substr($d,5,2);
      $time     = substr($d,11,5);
      $idtgl    = $m.$y;
      $bulan_produksi = 'T'.$m;
      $trans_id = DB::table('so')->orderBy('index','max')->take(1)->get();
      $costumer = DB::table('costumer')
      ->select('costumer.id','costumer.name','akun.id as akun_id')
      ->leftJoin('akun','costumer.akun_id','=','akun.id')
      ->where('costumer.isactive','A')
      ->orderBy('name','asc')
      ->get();
      $produk   = DB::table('barang_jadi')->where('isactive','A')->orderBy('name','asc')->get();
      $brand    = DB::table('brand')->where('isactive','A')->orderBy('name','asc')->get();
      $bahanbaku= DB::table('bahan_baku')->where('isactive','A')->orderBy('name','asc')->get();
      $warna    = DB::table('warna')->where('isactive','A')->orderBy('name','asc')->get();

      if (!isset($trans_id[0])) {
        $trans_id  = '0001';
      } else {
        $trans_id  = $trans_id[0]->index + 1;
        $trans_id  = str_pad($trans_id, 4, "0", STR_PAD_LEFT);
      }

      return view('so.add_so',['msg'=>$msg,'costumer'=>$costumer,'trans_id'=>$trans_id,
      'produk'=>$produk,'brand'=>$brand,'warna'=>$warna,'bahan_baku'=>$bahanbaku,'bulan_produksi'=>$bulan_produksi,
      'time'=>$time,'tanggal_order'=>$tanggal_order,
    ]);
    }

    public function send_so(Request $request)
    {
      $r           = $request->all();
      $jml_catatan    = (!isset($r['data_catatan'])) ? 0 : count($r['data_catatan']);
      $jml_art        = $r['art'];
      $index          = $this->genindex('So');


      $f = array('id','jam_order','status_kerjaan','tanggal_order','ket','dead','dead_end',
      'qty_produksi','art','term','harga_jual_spk','nilai_pekerjaan','dp','no_produksi','kode_barang',
      'nama_barang_jadi','catatan');
      $total            = floatval($this->ribuantodb($r['nilai_pekerjaan']));
      $dp               = floatval($this->ribuantodb($r['dp']));
      $sisa_pembayaran  = floatval($r['sisa_pembayaran']);

      if ($sisa_pembayaran == 0) {
        $status_pembayaran = 1;
      } elseif ($sisa_pembayaran > 0 && $dp < $total) {
        $status_pembayaran = 0;
      } elseif ($sisa_pembayaran == $total) {
        $status_pembayaran = '';
      }

      $add            = So::create([
        'id'              => $r[$f[0]],
        'index'           => $index,
        'jam_order'       => $r[$f[1]],
        'status'          => $r[$f[2]],
        'tanggal_order'   => $this->datetodb($r[$f[3]]),
        'ket'             => $r[$f[4]],
        'tanggal_masuk'   => $this->datetodb($r[$f[5]]),
        'tanggal_akhir'   => $this->datetodb($r[$f[6]]),
        'qty'             => round($r[$f[7]]),
        'art'             => $r[$f[8]],
        'term'            => $r[$f[9]],
        'harga_jual_spk'  => $r[$f[10]],
        'nilai_pekerjaan' => $r[$f[11]],
        'dp'              => $r[$f[12]],
        'produksi_id'     => $r[$f[13]],
        'barang_jadi_id'  => $r[$f[14]],
        'costumer_id'     => substr($r[$f[13]],0,5),
        'name'            => $r[$f[15]],
        'catatan'         => $r[$f[16]],
        'isactive'        => 'N',
        'bj_id'           => substr($r['no_produksi'],10,5),
        'brand_id'        => substr($r['no_produksi'],16,4),
        'bb_id'           => substr($r['no_produksi'],21,5),
        'bulan_id'        => substr($r['no_produksi'],6,3),
        'status_pembayaran'=> $status_pembayaran,
        'sisa_pembayaran' => $sisa_pembayaran,
        'created_at'      => Carbon::now(),
        'updated_at'      => Carbon::now(),
      ]);


      for ($i=0; $i < $jml_art; $i++) {
        $art_id = $this->genpad3($i);
        $add            = Art::create([
          'id'              => $r['data_art'][0]['id'].'-'.$art_id,
          'index'           => $i+1,
          'produksi_id'     => $r['no_produksi'],
          'so_id'           => substr($r['no_produksi'],27,4),
          'art_id'          => $art_id,
          'costumer_id'     => substr($r['no_produksi'],0,5),
          'qty'             => round($r[$f[7]]/$r[$f[8]]),
          'target_id'       => substr($r['no_produksi'],6,3),
          'created_at'      => Carbon::now(),
          'updated_at'      => Carbon::now(),
        ]);
      }

      $index    = CatatanProduksi::orderBy('index','max')->take(1)->get();

      if ($jml_catatan > 0) {
        for ($i=0; $i < $jml_catatan; $i++) {
          $add            = CatatanProduksi::create([
            'id'              => $r['data_catatan'][$i]['id'],
            'produksi_id'     => $r['no_produksi'],
            'index'           => $i+1,
            'warna_a'         => $r['data_catatan'][$i]['warna_a'],
            'warna_b'         => $r['data_catatan'][$i]['warna_b'],
            's'               => $r['data_catatan'][$i]['s'],
            'm'               => $r['data_catatan'][$i]['m'],
            'l'               => $r['data_catatan'][$i]['l'],
            'xl'              => $r['data_catatan'][$i]['xl'],
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now(),
          ]);
        }
      }


      if (floatval($this->ribuantodb($r['dp'])) > 0) {
       //Fungsi Akuntansi 
      $id = [$r['id_akun_tujuan'] ,$r['id_akun_sumber'] ];
      $debit = [(int)$this->ribuantodb($r['dp']), 0];
      $credit = [0, (int)$this->ribuantodb($r['dp'])];
      $ref_type = ['so', 'so'];
      $ref_id = [$r['id'], $r['id']];
      $memo = ['SALES ORDER DENGAN ID : ' . $r['id'], 'SALES ORDER DENGAN ID : ' . $r['id']];
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

      return back();
    }

    public function list_so()
    {
      $tag = 'SO';
      $title = 'SO';
      $data = DB::table('so')->get();
      return view('so.list_so',['data'=>$data,'tag'=>$tag,'title'=>$title]);
    }

    public function api_so()
    {
      $data = So::orderBy('id', 'DESC');;
      return DataTables::of($data)
      ->editColumn('status', function($data){
        if($data->status == 'S'){
          $status = 'Sendiri';
        } else {
          $status = 'FOB';
        }
        return $status;

      })
      ->editColumn('isactive', function($data){
        if($data->ispost == 'Y'){
          $status = 'Sudah Di Posting';
        } else {
          $status = 'Belum Di Posting';
        }
        if ($data->status == 'F') {
          return '';
        }
        return $status;

      })
      ->addColumn('action', function($data){
        if($data->ispost == 'P' || $data->ispost == 'Y'){
          $status = 'Sudah Di Posting';
          $disabled = 'disabled';
        } else {
          $status = 'Belum Di Posting';
          $disabled = '';
        }
        if ($data->status == 'F') {
          return '<a onclick="printData(\''.$data->id.'\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-print"></i> View & Print</a>';
        }
        return
        '<a onclick="printData(\''.$data->id.'\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-print"></i> Cetak</a> &nbsp;'.
        '<a onclick="showEdit(\''.$data->id.'\')" class="btn btn-warning btn-xs '.$disabled.'"><i class="glyphicon glyphicon-pencil"></i> Edit</a> &nbsp;'.
        '<a onclick="showProses(\''.$data->id.'\')" class="btn btn-success btn-xs '.$disabled.'" data-toggle="modal" data-target="#modalProses"><i class="glyphicon glyphicon-send"></i> Proses</a>';
      })
      ->make(true);
    }
    
    public function posting_proses(Request $request)
    {
      $r      = $request->all();
      $so_id  = $r['so'];

      $update = So::where('id', $r['so'])
        ->update([
          'ispost' => 'P',
          'updated_at'  => $this->datenowtodb()
                  ]);

      $update = Art::where('so_id', $r['so'])
        ->update([
          'proses_printing' => $r['data'][0],
          'proses_embro' => $r['data'][1],
          'proses_sewing' => $r['data'][2],
          'proses_washing' => $r['data'][3],
          'proses_lain2' => $r['data'][4],
          'proses_finishing' => $r['data'][5],
          'alur_proses' => $r['alur_proses'],
          'updated_at'  => Carbon::now()
                  ]);
        echo json_encode(array("data"=>1));
    }

    public function so_print($id)
    {
      $data = So::findOrFail($id);
      $note = CatatanProduksi::
      select('catatan_produksi.*','w1.name as warnanya_a','w2.name as warnanya_b')
      ->where('produksi_id',$data->produksi_id)
      ->leftjoin('warna as w1','catatan_produksi.warna_a','=','w1.id')
      ->leftjoin('warna as w2','catatan_produksi.warna_b','=','w2.id')
      ->get();
      // dd($note);
      if (!isset($data)) {
        abort(404);
      } else {
        $title      = 'SALES ORDER';
        $data       = DB::table('so')
        ->select(
          'so.*', DB::raw("substr(so.produksi_id,11,5) as barang_jadi_id"),
          'costumer.name as nama_costumer',
          'barang_jadi.name as nama_barang_jadi',
          'bahan_baku.name as nama_bahan_baku',
          'brand.name as nama_brand'
          )
          ->join('costumer', 'so.costumer_id', '=', 'costumer.id')
          ->join('barang_jadi', 'so.bj_id', '=', 'barang_jadi.id')
          ->join('bahan_baku', 'so.bb_id', '=', 'bahan_baku.id')
          ->join('brand', 'so.brand_id', '=', 'brand.id')
          ->where('so.id', '=', $id)
          ->get();

          $data = [
            'title'       =>  $title,
            'data'        =>  $data,
            'note'        =>  $note
          ];

          $pdf  = PDF::loadView('so.print.master', $data);
          $pdf->setPaper('a4', 'potrait');
          return $pdf->stream();
        }
      }


}
