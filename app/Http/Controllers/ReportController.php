<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

use PDF;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function report_transaksi_index()
  {
    $data = [
      'title' => 'Report Transaksi',
      'tag' => 'report_transaksi',
      'tanggal' => $this->datenowtoview(),
    ];
    return view('report.report_transaksi', $data);
  }

  public function report_stok_index()
  {
    $data = [
      'title' => 'Report Stok',
      'tag' => 'report_stok',
      'tanggal' => $this->datenowtoview(),
    ];
    return view('report.report_stok', $data);
  }

  public function view_print_report_transaksi($param, $from, $to)
  {
    // dd($param, $from, $to);
    $r['from'] = $from;
    $r['to'] = $to;
    $f = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['from'], 6, 4) . '-' . substr($r['from'], 3, 2) . '-' . substr($r['from'], 0, 2) . ' 00:00:00');
    $t = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['to'], 6, 4) . '-' . substr($r['to'], 3, 2) . '-' . substr($r['to'], 0, 2) . ' 23:59:00');
    $table = 'order';
    $data = DB::table($table)
      ->select($table . '.*', 'costumer.name as nama_customer','costumer.alamat as alamat')
      ->leftJoin('costumer', $table . '.user_id', '=', 'costumer.id')
      ->whereBetween($table.'.created_at', [$f, $t])
      ->orderBy($table . '.id', 'DESC');

    if ($param == 'a') {
      $data = $data->get();
      $total = DB::table($table)
        ->select(DB::raw('sum(total_transaksi) as total'))
        ->whereBetween($table . '.created_at', [$f, $t])
        ->get();
    } else {
      $data = $data->where($table . '.status_order', '=', $param)->get();
      $total = DB::table($table)
        ->select(DB::raw('sum(total_transaksi) as total'))
        ->whereBetween($table . '.created_at', [$f, $t])
        ->where($table . '.status_order', '=', $param)
        ->get();
    } 
    // dd($total);
    if ($param == 'a') {
      $title = 'ALL';
    } elseif ($param == 's') {
      $title = 'SELESAI';
    } elseif ($param == 'b') {
      $title = 'BATAL';
    } elseif ($param == 'p') {
      $title = 'PROCESS';
    } else {
      $title = 'BARU';
    }

    $data = [
      'title' => $title,
      'data' => $data,
      'total' => $total,
    ];

    $pdf = PDF::loadView('report.print.view_print_transaksi', $data);
    $pdf->setPaper('a4', 'landscape');
    return $pdf->stream();
  }

  public function export_report_transaksi($param, $from, $to)
  {
    global $title, $tag;
    $title = 'Order';
    $tag = 'order';
    $r['from'] = $from;
    $r['to'] = $to;
    $f = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['from'], 6, 4) . '-' . substr($r['from'], 3, 2) . '-' . substr($r['from'], 0, 2) . ' 00:00:00');
    $t = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['to'], 6, 4) . '-' . substr($r['to'], 3, 2) . '-' . substr($r['to'], 0, 2) . ' 23:59:00');
    $table = 'order';
    $file = $r['from'] . '/' . $r['to'];
    $data = DB::table($table)
      ->select($table . '.*', 'costumer.name as nama_customer', 'costumer.alamat as alamat')
      ->leftJoin('costumer', $table . '.user_id', '=', 'costumer.id')
      ->whereBetween($table . '.created_at', [$f, $t])
      ->orderBy($table . '.id', 'DESC');

    if ($param == 'a') {
      $data = $data->get()->toArray();
    } else {
      $data = $data->where($table . '.status_order', '=', $param)->get()->toArray();
    }
    $data = json_decode(json_encode($data), true);
    return Excel::create($tag, function ($excel) use ($data) {
      global $title, $tag;
      $excel->setTitle($title);
      $excel->sheet($tag, function ($sheet) use ($data) {
        $sheet->fromArray($data, null, 'A1', true, true);
      });
    })->download('xlsx');

  }


}
