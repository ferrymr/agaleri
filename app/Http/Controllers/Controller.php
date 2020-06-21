<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\BahanBaku;
use App\Warna;
use App\Brand;
use App\BarangJadi;
use App\Supplier;
use App\Costumer;
use App\Cmt;
use App\Acc;
use App\Category;
use App\Proses;
use App\Bank;
use App\Ledger;
use App\Journal;
use App\JournalTransaction;
use App\So;
use App\Art;
use App\Akun;
use App\AkunCostumer;
use App\AkunSupplier;
use App\AkunCmt;
use App\CatatanProduksi;
use App\PembelianBB as PembelianBB;
use App\PembelianBBDetail;
use App\MasterBB;
use App\KartuPersediaanBB;
use App\KartuPersediaanAcc;
use App\KartuPersediaanBJ;
use App\User;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


  public function genIdIndexAkun($model='')
  {
    if ($model == 'Costumer') {
      $id_kategori = '11';
      $id_parent = '110106';
    } elseif ($model == 'Supplier' || $model == 'Cmt') {
      $id_kategori = '21';
      $id_parent = '210101';
    }

    $i = Akun::select('akun.*')->orderBy('index', 'desc')
    ->where('level','4')
    ->where('id_kategori',$id_kategori)
    ->where('k3',$id_parent)
    ->take(1)
    ->get();

    if (!isset($i[0])){
      $id_akun      = $id_parent.'0001';
      $index        = 1;
    } else {
      $index        = $i[0]->index + 1;
      $pad          = str_pad($index,4,'0',STR_PAD_LEFT);
      $id_akun      = $id_parent.$pad;
    }

    $data = [
      'id_akun'     => $id_akun,
      'index'       => $index,
      'id_parent'   => $id_parent,
      'id_kategori' => $id_kategori,
    ];

    return $data;
  }

  public function genidtrans($m='',$k='')
  {
    $m      = 'App\\'.$m;
    $i      = $m::orderBy('index', 'desc')->take(1)->get();

    if(!isset($i[0])){
      return $newid     = '0000001';
    } else {
      $i                = $i[0]->index + 1;
      $pad              = str_pad($i,7,'0',STR_PAD_LEFT);
      return $newid     = $pad;
    }
  }

  public function genid($m='',$k='',$w='',$v='')
  {
    $model              = 'App\\'.$m;
    ($w == '') ? $index = $model::orderBy('index', 'desc')->take(1)->get() : $index = $model::orderBy('index', 'desc')->where($w,$v)->take(1)->get();

    if(!isset($index[0])){
      return $newid     = $k.'00001';
    } else {
      $index            = $index[0]->index + 1;
      $pad              = str_pad($index,5,'0',STR_PAD_LEFT);
      return $newid     = $k.$pad;
    }
  }

  public function genid3($m='',$k='',$w='',$v='')
  {
    $model              = 'App\\'.$m;
    ($w == '') ? $index = $model::orderBy('index', 'desc')->take(1)->get() : $index = $model::orderBy('index', 'desc')->where($w,$v)->take(1)->get();

    if(!isset($index[0])){
      return $newid     = $k.'001';
    } else {
      $index            = $index[0]->index + 1;
      $pad              = str_pad($index,3,'0',STR_PAD_LEFT);
      return $newid     = $k.$pad;
    }
  }

  public function genid2($m='',$w='',$v='')
  {
    $model              = 'App\\'.$m;
    $index = $model::orderBy('index', 'desc')->where($w,$v)->take(1)->get();

    if(!isset($index[0])){
      return $newid     = '01';
    } else {
      $index            = $index[0]->index + 1;
      $pad              = str_pad($index,3,'0',STR_PAD_LEFT);
      return $newid     = $pad;
    }
  }

  public function genpad($i='')
  {

    if($i==0){
      return $newid     = '0001';
    } else {
      $i                = $i + 1;
      $pad              = str_pad($i,4,'0',STR_PAD_LEFT);
      return $newid     = $pad;
    }
  }

  public function genpad3($i='')
  {

    if($i==0){
      return $newid     = '001';
    } else {
      $i                = $i + 1;
      $pad              = str_pad($i,3,'0',STR_PAD_LEFT);
      return $newid     = $pad;
    }
  }

  public function genindex($m='',$w='',$v='')
  {
    $model          = 'App\\'.$m;
    ($w == '') ? $index = $model::orderBy('index', 'desc')->take(1)->get() : $index = $model::orderBy('index', 'desc')->where($w,$v)->take(1)->get();

    if(!isset($index[0])){
      return $index     = 1;
    } else {
      return $index     = $index[0]->index + 1;
    }

  }

  public function genidstd($m='')
  {
    $model          = 'App\\'.$m;
    $id = $model::orderBy('id', 'desc')->take(1)->get();

    if(!isset($id[0])){
      return $id     = 1;
    } else {
      return $id     = $id[0]->id + 1;
    }

  }

  public function ribuantodb($v='')
  {
    return str_replace(',','',$v);
  }

  public function datenowtoview()
  {
    return Carbon::now('Asia/Jakarta')->format('d/m/Y');
  }

  public function datedbtoview($value='')
  {
    return Carbon::createFromFormat('Y-m-d',$value)->format('d/m/Y');
  }

  public function dateviewtodb($d='')
  {
    return Carbon::createFromFormat('d/m/Y',$d)->format('Y-m-d');
  }

  public function datenowtodb()
  {
    return Carbon::now('Asia/Jakarta')->format('Y-m-d');
  }

  public function datenowtorange()
  {
    return Carbon::now('Asia/Jakarta')->format('m/d/Y');
  }

  public function datetoview($value='')
  {
    return Carbon::createFromFormat('Y-m-d', $value);
  }

  public function datetodb($v='')
  {
    return Carbon::createFromFormat('d/m/Y', $v);
  }

  public function getbulan()
  {
    $data = [
      '01' => 'Januari',
      '02' => 'Februari',
      '03' => 'Maret',
      '04' => 'April',
      '05' => 'Mei',
      '06' => 'Juni',
      '07' => 'Juli',
      '08' => 'Agustus',
      '09' => 'September',
      '10' => 'Oktober',
      '11' => 'November',
      '12' => 'Desember'
    ];
    return $data;
  }

  public function gettahun()
  {
    $data = [
      '18' => '2018',
      '19' => '2019',
      '20' => '2020',
      '21' => '2021',
      '22' => '2022',
      '23' => '2023',
      '24' => '2024',
      '25' => '2025',
      '26' => '2026',
      '27' => '2027',
      '28' => '2028',
    ];
    return $data;
  }

  public function tosql($v='')
  {
    return str_replace('"','',$v);
  }

  public function addAkun($r,$id,$table)
  {
    $currency = 'IDR';
    $r['id_category'] = $r['id_kategori'];
    $data     = $r;

    $akun = Akun::where('id',$r['id'])->count();
    if ($akun > 0) {
      return 0;
    }
    Akun::create($data);

    $get_type = Category::select('category.type')
    ->where('id',$r['id_category'])
    ->get();

    $type = $get_type[0]->type;

    $data_link = [
      'id_akun'      => $r['id'],
      'id_'.$table   => $id,
      'created_at'   => $this->datenowtodb(),
    ];

    if (floatval($this->ribuantodb($r['saldo'])) <= 0) {
      return 1;
    } else {
      $data_ledger = [
        'name'         => $r['deskripsi'],
        'type'         => $type,
        'created_at'   => $this->datenowtodb(),
      ];
      $create_ledger = Ledger::create($data_ledger);

      $data_jurnal = [
        'ledger_id'     => $create_ledger->id,
        'balance'       => floatval($this->ribuantodb($r['saldo'])),
        'currency'      => $currency,
        'akun_id'       => $r['id'],
        'tanggal'       => $this->datenowtodb(),
      ];
      $create_jurnal = Journal::create($data_jurnal);

      $debit = 0;
      $kredit = 0;
      $value = floatval($this->ribuantodb($r['saldo']));

      if ($type == 'asset') {
        $debit = $value;
        $jenis = 'd';
      } elseif ($type == 'liability') {
        $kredit = $value;
        $jenis = 'k';
      } elseif ($type == 'equity') {
        $kredit = $value;
        $jenis = 'k';
      } elseif ($type == 'income') {
        $kredit = $value;
        $jenis = 'k';
      } elseif ($type == 'expense') {
        $debit = $value;
        $jenis = 'd';
      }

      $newid = $this->genidtrans('JournalTransaction');
      $index = $this->genindex('JournalTransaction');
      $dataJournalTransaction   = [
        'id'                  => $newid,
        'index'               => $index,
        'transaction_group'   => $get_type[0]->type,
        'journal_id'          => $create_jurnal->id,
        'debit'               => $debit,
        'credit'              => $kredit,
        'currency'            => $currency,
        'memo'                => $r['deskripsi'],
        'type'                => $jenis,
        'akun_id'             => $r['id'],
        'post_date'           => $this->datenowtodb(),
      ];
      $journaltransaction = JournalTransaction::create($dataJournalTransaction);

      return 1;
    }
  }
  // Sudah Tidak Digunakan SO
  // public function addJurnalSo($r)
  // {
  //   $currency       = 'IDR';
  //   $id_akun_sumber = $r['id_akun_sumber'];
  //   $id_akun_tujuan = $r['id_akun_tujuan'];
  //   $reftype        = 'dp_so';
  //   $refid          = $r['id_so'];
  //   $id_akun        = [$id_akun_tujuan,$id_akun_sumber];
  //   $dataproses     = [ 'dp dari','dp untuk'];
  //   $type_kelompok  = [ 'asset','asset'];
  //   $type           = '';

  //   for ($i=0; $i < count($dataproses); $i++) {
  //     $data_ledger = [
  //       'name'         => $dataproses[$i].' so : '.$r['id_so'],
  //       'type'         => $type_kelompok[$i],
  //     ];
  //     $create_ledger = Ledger::create($data_ledger);

  //     $nilai_ballance = Journal::select('accounting_journals.balance')
  //     ->where('accounting_journals.akun_id','=',$id_akun[$i])
  //     ->orderBy('id', 'desc')
  //     ->get();

  //     $debit  = 0;
  //     $kredit = 0;

  //     if ($type_kelompok[$i] == 'asset') {
  //       if ($dataproses[$i] == 'dp dari') {
  //         $debit  = $r['dp'];
  //         $kredit = 0;
  //       } else {
  //         $debit  = 0;
  //         $kredit  = $r['dp'];
  //       }
  //       if (!isset($nilai_ballance[0]->balance)) {
  //         if ($dataproses[$i] == 'dp dari') {
  //           $balance = $debit;
  //         } else {
  //           $balance = $kredit;
  //         }
  //       } else {
  //         if ($dataproses[$i] == 'dp dari') {
  //           $balance = floatval($nilai_ballance[0]->balance) + floatval($debit);
  //         } else {
  //           $balance = floatval($nilai_ballance[0]->balance) + (-abs(floatval($kredit)));
  //         }
  //       }
  //     }

  //     $data_jurnal = [
  //       'ledger_id'     => $create_ledger->id,
  //       'balance'       => $balance,
  //       'currency'      => $currency,
  //       'akun_id'       => $id_akun[$i],
  //       'tanggal'       => $r['tanggal'],
  //     ];

  //     $create_jurnal = Journal::create($data_jurnal);

  //     // Update Balance Akun
  //     $this->updateBalance($id_akun[$i],$balance);


  //     $newid = $this->genidtrans('JournalTransaction');
  //     $index = $this->genindex('JournalTransaction');

  //     $dataJournalTransaction   = [
  //       'id'                  => $newid,
  //       'index'               => $index,
  //       'transaction_group'   => $type_kelompok[$i],
  //       'journal_id'          => $create_jurnal->id,
  //       'debit'               => $debit,
  //       'credit'              => $kredit,
  //       'currency'            => $currency,
  //       'memo'                => $dataproses[$i].' so : '.$r['id_so'],
  //       'type'                => ($type_kelompok[$i] == 'dp untuk') ? 'd' : 'k',
  //       'akun_id'             => $id_akun[$i],
  //       'ref_type'            => $reftype,
  //       'ref_id'              => $refid,
  //       'post_date'           => $this->datenowtodb(),
  //     ];

  //     $journaltransaction = JournalTransaction::create($dataJournalTransaction);

  //   }

  //   return [
  //     'status'  => true,
  //     'message' => 'Jurnal created',
  //   ];

  // }

  public function updateBalance($akun_id='',$balance='')
  {
    $akun = Akun::where('id',$akun_id);
    $data = [
      'saldo' =>  $balance
    ];
    $akun->update($data);
  }

  public function jurnalPembelian($request)
  {
    $r        = $request;
    $currency = 'IDR';
    $data     = [
      'pembayaran'  => $r['pembayaran'],
      'id_supplier' => $r['id_supplier'],
      'total'       => floatval($r['total_trans']),
    ];
    $debit_master = [0,$data['total']];
    $kredit_master = [$data['total'],0];

    if ($data['pembayaran'] == 'C') {
      $type_kelompok_u      = ['k', 'd'];
      $id_akun            = ['1-10001','5-50000'];
    } else {
      $type_kelompok_u      = ['k', 'd'];
      $id_akun            = ['2-20100','5-50000'];
    }
    // dd($data);

    for ($i=0; $i < count($type_kelompok_u); $i++) {
      $type     = $type_kelompok_u[$i];
      $reftype  = 'supplier';
      $refid    = $data['id_supplier'];
      $memo     = 'Pembelian Bahan Baku dari : '.$data['id_supplier'];
      $debit    = $debit_master[$i];
      $kredit   = $kredit_master[$i];

      $get_type = Akun::select('category.type')
      ->join('category','akun.id_kategori','=','category.id')
      ->where('akun.id',$id_akun[$i])
      ->get();

      $type_kelompok = $get_type[0]['type'];
      $data_ledger = [
        'name'         => $memo,
        'type'         => $type_kelompok,
        'created_at'   => $r['tanggal'],
      ];
      $create_ledger = Ledger::create($data_ledger);

      $nilai_ballance = Journal::select('accounting_journals.balance')
      ->where('accounting_journals.akun_id','=',$id_akun[$i])
      ->orderBy('id', 'desc')
      ->get();

      if ($type == 'd') {
        if (!isset($nilai_ballance[0]->balance)) {
          $balance = $debit;
        } else {
          if ($type_kelompok == 'asset') {
            $balance = floatval($nilai_ballance[0]->balance) + floatval($debit);
          } elseif ($type_kelompok == 'liability') {
            $balance = floatval($nilai_ballance[0]->balance) - floatval($debit);
          } elseif ($type_kelompok == 'equity') {
            $balance = floatval($nilai_ballance[0]->balance) - floatval($debit);
          } elseif ($type_kelompok == 'income') {
            $balance = floatval($nilai_ballance[0]->balance) - floatval($debit);
          } elseif ($type_kelompok == 'expense') {
            $balance = floatval($nilai_ballance[0]->balance) + floatval($debit);
          }
        }
      } elseif ($type == 'k') {
        if (!isset($nilai_ballance[0]->balance)) {
          $balance = $kredit;
        } else {
          if ($type_kelompok == 'asset') {
            $balance = floatval($nilai_ballance[0]->balance) - floatval($kredit);
          } elseif ($type_kelompok == 'liability') {
            $balance = floatval($nilai_ballance[0]->balance) + floatval($kredit);
          } elseif ($type_kelompok == 'equity') {
            $balance = floatval($nilai_ballance[0]->balance) + floatval($kredit);
          } elseif ($type_kelompok == 'income') {
            $balance = floatval($nilai_ballance[0]->balance) + floatval($kredit);
          } elseif ($type_kelompok == 'expense') {
            $balance = floatval($nilai_ballance[0]->balance) - floatval($kredit);
          }
        }
      }

      $data_jurnal = [
        'ledger_id'     => $create_ledger->id,
        'balance'       => $balance,
        'currency'      => $currency,
        'akun_id'       => $id_akun[$i],
        'tanggal'       => $r['tanggal'],
      ];

      $create_jurnal = Journal::create($data_jurnal);
      $this->updateBalance($id_akun[$i],$balance);

      $newid = $this->genidtrans('JournalTransaction');
      $index = $this->genindex('JournalTransaction');
      $dataJournalTransaction   = [
        'id'                  => $newid,
        'index'               => $index,
        'transaction_group'   => $get_type[0]['type'],
        'journal_id'          => $create_jurnal->id,
        'debit'               => $debit,
        'credit'              => $kredit,
        'currency'            => $currency,
        'memo'                => $memo,
        'tags'                => '',
        'type'                => $type,
        'ref_type'            => $reftype,
        'ref_id'              => $refid,
        'akun_id'             => $id_akun[$i],
        'post_date'           => $r['tanggal'],
      ];
      $journaltransaction = JournalTransaction::create($dataJournalTransaction);

    }

    return response()->json([
      'status'  => true,
      'message' => 'Jurnal created',
    ]);
  }

  // Sudah Tidak Dipakai
  // public function jurnalBiaya($r)
  // {
  //   $currency   = 'IDR';
  //   $data       = [
  //     'tanggal'       => $r['tanggal'],
  //     'id_akun_sumber'=> $r['id_akun'],
  //     'id_akun_tujuan'=> $r['id_akun_tujuan'],
  //     'deskripsi'     => $r['deskripsi'],
  //     'memo'          => $r['memo'],
  //     'jumlah'        => $r['jumlah'],
  //     'total'         => $r['total'],
  //     'id_payment'    => $r['id_payment'],
  //   ];

  //   $debit_master      = array(0);
  //   $kredit_master     = array($data['total']);
  //   $type_kelompok_u   = array('k');
  //   $id_akun           = array($data['id_akun_sumber']);
  //   for ($i=0; $i < count($data['id_akun_tujuan']) ; $i++) {
  //     array_push($type_kelompok_u,'d');
  //     array_push($id_akun,$data['id_akun_tujuan'][$i]);
  //     array_push($debit_master,floatval($this->ribuantodb($data['jumlah'][$i])));
  //     array_push($kredit_master,0);
  //   }

  //   // dd($id_akun);

  //   for ($i=0; $i < count($type_kelompok_u); $i++) {
  //     $type     = $type_kelompok_u[$i];
  //     $reftype  = 'supplier';
  //     $refid    = $data['id_supplier'];
  //     $memo     = 'Biaya ke : '.$data['id_supplier'];
  //     $debit    = $debit_master[$i];
  //     $kredit   = $kredit_master[$i];

  //     $get_type = Akun::select('category.type')
  //     ->join('category','akun.id_kategori','=','category.id')
  //     ->where('akun.id',$id_akun[$i])
  //     ->get();

  //     $type_kelompok = $get_type[0]['type'];
  //     $data_ledger = [
  //       'name'         => $memo,
  //       'type'         => $type_kelompok,
  //       'created_at'   => $r['tanggal'],
  //     ];
  //     $create_ledger = Ledger::create($data_ledger);

  //     $nilai_ballance = Journal::select('accounting_journals.balance')
  //     ->where('accounting_journals.akun_id','=',$id_akun[$i])
  //     ->orderBy('id', 'desc')
  //     ->get();

  //     if ($type == 'd') {
  //       if (!isset($nilai_ballance[0]->balance)) {
  //         $balance = $debit;
  //       } else {
  //         if ($type_kelompok == 'asset') {
  //           $balance = floatval($nilai_ballance[0]->balance) + floatval($debit);
  //         } elseif ($type_kelompok == 'liability') {
  //           $balance = floatval($nilai_ballance[0]->balance) - floatval($debit);
  //         } elseif ($type_kelompok == 'equity') {
  //           $balance = floatval($nilai_ballance[0]->balance) - floatval($debit);
  //         } elseif ($type_kelompok == 'income') {
  //           $balance = floatval($nilai_ballance[0]->balance) - floatval($debit);
  //         } elseif ($type_kelompok == 'expense') {
  //           $balance = floatval($nilai_ballance[0]->balance) + floatval($debit);
  //         }
  //       }
  //     } elseif ($type == 'k') {
  //       if (!isset($nilai_ballance[0]->balance)) {
  //         $balance = $kredit;
  //       } else {
  //         if ($type_kelompok == 'asset') {
  //           $balance = floatval($nilai_ballance[0]->balance) - floatval($kredit);
  //         } elseif ($type_kelompok == 'liability') {
  //           $balance = floatval($nilai_ballance[0]->balance) + floatval($kredit);
  //         } elseif ($type_kelompok == 'equity') {
  //           $balance = floatval($nilai_ballance[0]->balance) + floatval($kredit);
  //         } elseif ($type_kelompok == 'income') {
  //           $balance = floatval($nilai_ballance[0]->balance) + floatval($kredit);
  //         } elseif ($type_kelompok == 'expense') {
  //           $balance = floatval($nilai_ballance[0]->balance) - floatval($kredit);
  //         }
  //       }
  //     }

  //     $data_jurnal = [
  //       'ledger_id'     => $create_ledger->id,
  //       'balance'       => $balance,
  //       'currency'      => $currency,
  //       'akun_id'       => $id_akun[$i],
  //       'tanggal'       => $r['tanggal'],
  //     ];

  //     $create_jurnal = Journal::create($data_jurnal);
  //     $this->updateBalance($id_akun[$i],$balance);

  //     $newid = $this->genidtrans('JournalTransaction');
  //     $index = $this->genindex('JournalTransaction');
  //     $dataJournalTransaction   = [
  //       'id'                  => $newid,
  //       'index'               => $index,
  //       'transaction_group'   => $get_type[0]['type'],
  //       'journal_id'          => $create_jurnal->id,
  //       'debit'               => $debit,
  //       'credit'              => $kredit,
  //       'currency'            => $currency,
  //       'memo'                => $memo,
  //       'tags'                => '',
  //       'type'                => $type,
  //       'ref_type'            => $reftype,
  //       'ref_id'              => $refid,
  //       'akun_id'             => $id_akun[$i],
  //       'post_date'           => $r['tanggal'],
  //     ];
  //     $journaltransaction = JournalTransaction::create($dataJournalTransaction);

  //   }

  //   return response()->json([
  //     'status'  => true,
  //     'message' => 'Jurnal created',
  //   ]);
  // }

  public function validateDebitCredit($value)
  {
    if (!isset($value)) {
      number_format(0,2);
    } else {
      if ($value == null) {
        number_format(0,2);
      } else {
        return number_format($value,2);
      }
    }
  }

/*

Fungsi dalam membuat jurnal otomatis dapat digunakan banyak proses
Data yg dibutuhkan :
1. Array ID akun_id
2. Array Value Debit
3. Array Value Kredit
4. Array Ref Type
5. Array Ref ID
6. Array Memo/Deskripsi
7. Date
8. Currency

$id       = ['',''];
$debit    = ['',''];
$credit   = ['',''];
$ref_type = ['',''];
$ref_id   = ['',''];
$memo     = ['',''];
$date     = $this->datenowtodb();
$currency = 'IDR';

$data       = [
  'akun_id'       => $id,
  'debit'         => $debit,
  'credit'        => $credit,
  'ref_type'      => $ref_type,
  'ref_id'        => $ref_id,
  'memo'          => $memo,
  'date'          => $date,
  'currency'      => $currency,
];

*/
  public function create_jurnal($data)
  {
    for ($i=0; $i < count($data['akun_id']); $i++) {
      if((int)$data['debit'][$i]>0 && (int)$data['credit'][$i]==0){
        $data_insert       = [
          'akun_id'       => $data['akun_id'][$i],
          'debit'         => $data['debit'][$i],
          'credit'        => 0,
          'ref_type'      => $data['ref_type'][$i],
          'ref_id'        => $data['ref_id'][$i],
          'memo'          => $data['memo'][$i],
          'date'          => $data['date'][$i],
          'currency'      => $data['currency'][$i],
        ];
        $this->proses_jurnal($data_insert);
      } 
    }

    for ($i=0; $i < count($data['akun_id']); $i++) {
      if((int)$data['credit'][$i]>0){
        $data_insert       = [
          'akun_id'       => $data['akun_id'][$i],
          'debit'         => 0,
          'credit'        => $data['credit'][$i],
          'ref_type'      => $data['ref_type'][$i],
          'ref_id'        => $data['ref_id'][$i],
          'memo'          => $data['memo'][$i],
          'date'          => $data['date'][$i],
          'currency'      => $data['currency'][$i],
        ];
        $this->proses_jurnal($data_insert);
      }       
    }
    
    return [
      'status'  => true,
      'message' => 'Success Created',
    ];

  }

  public function proses_jurnal($data)
  {
      // dd($data);
      $id         = $data['akun_id'];
      $debit      = (!isset($data['debit'])) ? '' : floatval($data['debit']);
      $credit     = (!isset($data['credit'])) ? '' : floatval($data['credit']);
      $ref_type   = (!isset($data['ref_type'])) ? '' : $data['ref_type'];
      $ref_id     = (!isset($data['ref_id'])) ? '' : $data['ref_id'];
      $memo       = (!isset($data['memo'])) ? '' : $data['memo'];
      $date       = $data['date'];
      $currency   = $data['currency'];

      $type = Category::select('category.type')
      ->leftJoin('akun','akun.id_kategori','=','category.id')
      ->where('akun.id',$id)
      ->get();

      $type = (!isset($type[0]['type'])) ? '' : $type[0]['type'];

      $data_ledger = [
        'name'         => $memo,
        'type'         => $type,
      ];
      $create_ledger = Ledger::create($data_ledger);

      $nilai_ballance = Journal::select('accounting_journals.balance')
      ->where('accounting_journals.akun_id','=',$id)
      ->orderBy('id', 'desc')
      ->get();
      if (!isset($nilai_ballance[0]->balance)) {
        $balance = 0;
      } else {
        $balance = floatval($nilai_ballance[0]->balance);
      }

      if ($debit > 0) {
          if ($type == 'asset') {
            $balance = $balance + $debit;
          } elseif ($type == 'liability') {
            $balance = $balance - $debit;
          } elseif ($type == 'equity') {
            $balance = $balance - $debit;
          } elseif ($type == 'income') {
            $balance = $balance - $debit;
          } elseif ($type == 'expense') {
            $balance = $balance + $debit;
          }
      }

      if ($credit > 0) {
          if ($type == 'asset') {
            $balance = $balance - $credit;
          } elseif ($type == 'liability') {
            $balance = $balance + $credit;
          } elseif ($type == 'equity') {
            $balance = $balance + $credit;
          } elseif ($type == 'income') {
            $balance = $balance + $credit;
          } elseif ($type == 'expense') {
            $balance = $balance - $credit;
          }
      }

      $data_jurnal = [
        'ledger_id'     => $create_ledger->id,
        'balance'       => $balance,
        'currency'      => $currency,
        'akun_id'       => $id,
        'tanggal'       => $date,
      ];

      $create_jurnal = Journal::create($data_jurnal);

      // Update Balance Akun
      $this->updateBalance($id,$balance);
      $newid = $this->genidtrans('JournalTransaction');
      $index = $this->genindex('JournalTransaction');

      $dataJournalTransaction   = [
        'id'                  => $newid,
        'index'               => $index,
        'transaction_group'   => $type,
        'journal_id'          => $create_jurnal->id,
        'debit'               => $debit,
        'credit'              => $credit,
        'currency'            => $currency,
        'memo'                => $memo,
        'type'                => ($debit > 0) ? 'd' : 'k',
        'akun_id'             => $id,
        'ref_type'            => $ref_type,
        'ref_id'              => $ref_id,
        'post_date'           => $date,
      ];
      // dd($dataJournalTransaction);
      $journaltransaction = JournalTransaction::create($dataJournalTransaction);
  }

  /* 
  Fungsi merata-ratakan pembelian bahan baku/accessories
  guna mendapatkan nilai yang digunakan untuk kartu persediaan dan akuntansi
  
  data yang dibutuhkan :
  1. Kode Barang
  2. Jenis (Bahan Baku/ Acc)


  $kode     = ;
  $jenis    = 'BB/Acc';
  $type    = 'B/R'; Beli dr Pembelian /Retur Pemakaian
  $date     = $this->datenowtodb();

  $data       = [
    'kode_bb'     => $id,
    'jenis'       => $jenis,
    'type'       => $type,
    'date'        => $date,
  ];

   */
  public function average_persediaan($data){
    $model = 'App\\KartuPersediaan'.$data['jenis'];
    $average = $model::select(DB::raw('sum(qty) as saldo_qty') , DB::raw('sum(jumlah) / sum(qty) as saldo_harga'), DB::raw('sum(jumlah) as saldo_jumlah'))
    ->where('kode_'.strtolower($data['jenis']),$data['kode'])
    ->where('type_ref',$data['type_ref'])
    ->get();
    return $average;
  }

  /* 
  Fungsi membuat kartu stock  

  //Fungsi Kartu Persediaan
    $jenis_persediaan = 'BB';
    $id_barang = $request['kode_bb'][$i];
    $id_ref = $request['id'];
    $type_ref = 'B'; // B/P'; + Beli B, - Keluar K, - Retur R
    $qty_persediaan = floatval($this->ribuantodb($request['qty'][$i]));
    $harga_persediaan = floatval($this->ribuantodb($request['harga'][$i]));

    $data_kartu_persediaan = [
      'jenis' => $jenis_persediaan,
      'id_barang' => $id_barang,
      'id_ref' => $id_ref,
      'type_ref' => $type_ref,
      'qty' => $qty_persediaan,
      'harga' => $harga_persediaan,
    ];

    $this->create_kartu_persediaan($data_kartu_persediaan);

   */
  public function create_kartu_persediaan($data){
    
    // Cek Average Pembelian    
    $model = 'App\\KartuPersediaan' . $data['jenis'];
    $jenis = strtolower($data['jenis']);
    $tabel = 'kartu_persediaan_' . $jenis;
    $id_barang = $data['id_barang'];
    // dd($jenis);

    $total_qty_pembelian = $model::where('kode_' . $jenis, $id_barang)
    ->where('type_ref', 'B')
    ->sum('qty');
    $total_jumlah_pembelian = $model::where('kode_' . $jenis, $id_barang)
    ->where('type_ref', 'B')
    ->sum('jumlah');
    $total_qty_retur = $model::where('kode_' . $jenis, $id_barang)
    ->where('type_ref', 'R')
    ->sum('qty');
    $total_jumlah_retur = $model::where('kode_' . $jenis, $id_barang)
    ->where('type_ref', 'R')
    ->sum('jumlah');
    $total_qty_keluar = $model::where('kode_' . $jenis, $id_barang)
    ->where('type_ref', 'K')
    ->sum('qty');
    
      // dd($total_jumlah_pembelian > 0);
      if ($total_jumlah_pembelian > 0 && $total_qty_pembelian > 0){
        if ($data['type_ref'] == 'B'){
          $saldo_qty = (floatval($total_qty_pembelian) + floatval($data['qty'])) - floatval($total_qty_keluar);
          $saldo_harga = (floatval($total_jumlah_pembelian) + floatval($data['jumlah']) ) / (floatval($total_qty_pembelian) + floatval($data['qty']));
        } elseif ($data['type_ref'] == 'R'){
          $saldo_qty = (floatval($total_qty_pembelian) + floatval($data['qty'])) - floatval($total_qty_keluar);
          $saldo_harga = (floatval($total_jumlah_pembelian) + floatval($total_jumlah_retur) + floatval($data['jumlah']) ) / (floatval($total_qty_pembelian) + floatval($total_qty_retur) + floatval($data['qty']));
        } else {
          $saldo_qty = floatval($total_qty_pembelian) - (floatval($total_qty_keluar) + floatval($data['qty']));
          $saldo_harga = floatval($total_jumlah_pembelian) / floatval($total_qty_pembelian);
        }
      } else {
        $saldo_qty = $data['qty'];
        $saldo_harga = $data['harga'];
      }
      $saldo_jumlah = floatval($saldo_qty) * floatval($saldo_harga);
      
      $data['index'] = $this->genindex('KartuPersediaanBB');
      $data['kode_'.$jenis] = $id_barang;
      $data['saldo_qty'] = $saldo_qty;
      $data['saldo_harga'] = $saldo_harga;
      $data['saldo_jumlah'] = $saldo_jumlah;
    // dd($data);
    $model::create($data);

    // Update Harga Default
    $data_harga = [
      'stock' => $saldo_qty,
      'id_satuan' => $data['satuan'],
      'harga_default' => $saldo_harga,
    ];
    $model_update = 'App\\Master' . $data['jenis'];
    if($jenis == 'bb'){
      $model_update::where('id', $data['kode_bb'])->update($data_harga);
    }
    if($jenis == 'acc'){
      $model_update::where('id', $data['kode_acc'])->update($data_harga);
    }
    return true;
  }


  public function validasi_pin_super_admin(Request $request)
  { 
    $r          = $request->all();
    $userid     = '2';
    $verify     = User::findOrFail($userid);

    if ($r['pin'] != $verify->pin) {
      return response()->json([
        'status' => false,
        'message' => 'Pin Salah! '
      ]);
    }

    return response()->json([
      'status' => true,
      'message' => 'Approved'
    ]);
  }

  // sample data send
    // $data_send = [
    //   'akun_id' => $data[0]->akun_id,
    //   'jurnal_id' => $r['jurnal_id'],
    //   'date_jurnal' => $data[0]->created_at,
    //   'date_now' => $this->datenowtodb()
    // ];

  public function proses_update_saldo($data){
    $nilai_ballance = Journal::select('id','balance','akun_id')
    ->where('akun_id',$data['akun_id'])
    ->where('id','<',$data['jurnal_id'])
    ->orderBy('id', 'desc')
    ->limit(1)
    ->get();

    $debit = $data['debit'];
    $credit = $data['credit'];
    $type = $data['type'];

      if (!isset($nilai_ballance[0]->balance)) {
        $balance = 0;
      } else {
        $balance = floatval($nilai_ballance[0]->balance);
      }

      if ($debit > 0) {
          if ($type == 'asset') {
            $balance = $balance + $debit;
          } elseif ($type == 'liability') {
            $balance = $balance - $debit;
          } elseif ($type == 'equity') {
            $balance = $balance - $debit;
          } elseif ($type == 'income') {
            $balance = $balance - $debit;
          } elseif ($type == 'expense') {
            $balance = $balance + $debit;
          }
      }

      if ($credit > 0) {
          if ($type == 'asset') {
            $balance = $balance - $credit;
          } elseif ($type == 'liability') {
            $balance = $balance + $credit;
          } elseif ($type == 'equity') {
            $balance = $balance + $credit;
          } elseif ($type == 'income') {
            $balance = $balance + $credit;
          } elseif ($type == 'expense') {
            $balance = $balance - $credit;
          }
      }

      $data_jurnal = [
        'balance'       => $balance,
      ];

      $update_jurnal = Journal::where('id',$data['jurnal_id'])
      ->update($data_jurnal);

      // Update Balance Akun
      $this->updateBalance($data['akun_id'],$balance);

      //Proses Loop
      return $data_result = [
        'akun_id' => $data['akun_id'],
        'jurnal_id' => $data['jurnal_id'],
        'type' => $data['type'],
        'debit' => $data['debit'],
        'credit' => $data['credit'],
      ];
  }



}
