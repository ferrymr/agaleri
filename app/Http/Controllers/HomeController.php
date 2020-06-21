<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dashboard;
use Carbon\Carbon;
use App\So;
use App\MasterBB;
use App\MasterAcc;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $y = Carbon::now()->year;
    $month = [0=>'Januari',1=>'Februari',2=>'Maret',3=>'April',4=>'Mei',5=>'Juni',6=>'Juli',7=>'Agustus',8=>'September',9=>'Oktober',10=>'November',11=>'Desember'];
    $report_income = array();
    for ($i=1; $i < 13; $i++) {
      $query = DB::select('select * from (select transaction_group, sum(credit) as amount,
      EXTRACT(month from created_at) AS m,
      EXTRACT(year from created_at) AS y
      from accounting_journal_transactions group by m,y,transaction_group) ss
      where m = '.$i.' and y = '.$y.' and transaction_group = \'income\'');
      if (isset($query[0]->amount)) {
        array_push($report_income, $query[0]->amount);
      } else {
        array_push($report_income, 0);
      }
    }

    $report_income2  = [
      0   =>  $report_income[0],
      1   =>  $report_income[1],
      2   =>  $report_income[2],
      3   =>  $report_income[3],
      4   =>  $report_income[4],
      5   =>  $report_income[5],
      6   =>  $report_income[6],
      7   =>  $report_income[7],
      8   =>  $report_income[8],
      9   =>  $report_income[9],
      10   =>  $report_income[10],
      11   =>  $report_income[11],
    ];

    $report_expense = array();
    for ($i=1; $i < 13; $i++) {
      $query = DB::select('select * from (select transaction_group, sum(debit) as amount,
      EXTRACT(month from created_at) AS m,
      EXTRACT(year from created_at) AS y
      from accounting_journal_transactions group by m,y,transaction_group) ss
      where m = '.$i.' and y = '.$y.' and transaction_group = \'expense\'');
      if (isset($query[0]->amount)) {
        array_push($report_expense, $query[0]->amount);
      } else {
        array_push($report_expense, 0);
      }
    }

    $report_expense2  = [
      0   =>  $report_expense[0],
      1   =>  $report_expense[1],
      2   =>  $report_expense[2],
      3   =>  $report_expense[3],
      4   =>  $report_expense[4],
      5   =>  $report_expense[5],
      6   =>  $report_expense[6],
      7   =>  $report_expense[7],
      8   =>  $report_expense[8],
      9   =>  $report_expense[9],
      10   =>  $report_expense[10],
      11   =>  $report_expense[11],
    ];

    $day    = Carbon::now()->format('d');
    $month2  = Carbon::now()->format('m');
    $year   = Carbon::now()->format('Y');

    $data  = [
      'title'             =>  'Profit',
      'tag'               =>  'profit',
      'tanggal'           =>  $this->datenowtoview(),
      'month'             =>  $month,
      'report_income'     =>  $report_income2,
      'report_expense'    =>  $report_expense2,
      'sales_per_day'     =>  count(So::where('ispost','P')->whereDay('tanggal_order',$day)->get()),
      'sales_per_month'   =>  count(So::where('ispost','P')->whereMonth('tanggal_order',$month2)->get()),
      'sales_per_year'    =>  count(So::where('ispost','P')->whereYear('tanggal_order',$year)->get()),
      'stock_bb'          =>  number_format(MasterBB::sum('stock'),2),
      'stock_acc'         =>  number_format(MasterAcc::sum('stock'),2),
    ];

    // dd($data);

    return view('home', $data);
  }

  public function showAll($userTableData)
  {
    $y = Carbon::now()->year;
    $month = [0=>'Januari',1=>'Februari',2=>'Maret',3=>'April',4=>'Mei',5=>'Juni',6=>'Juli',7=>'Agustus',8=>'September',9=>'Oktober',10=>'November',11=>'Desember'];
    $report = array();
    for ($i=1; $i < 13; $i++) {
      $query = DB::select('select * from (select sum(credit) as amount,
      EXTRACT(month from created_at) AS m,
      EXTRACT(year from created_at) AS y
      from accounting_journal_transactions group by m,y) ss where m = '.$i.' and y = '.$y);
      if (isset($query[0]->amount)) {
        array_push($report, $query[0]->amount);
      } else {
        array_push($report, 0);
      }
    }


    $data = Barang::all();
    $report2  = [
      0   =>  $report[0],
      1   =>  $report[1],
      2   =>  $report[2],
      3   =>  $report[3],
      4   =>  $report[4],
      5   =>  $report[5],
      6   =>  $report[6],
      7   =>  $report[7],
      8   =>  $report[8],
      9   =>  $report[9],
      10   =>  $report[10],
      11   =>  $report[11],
    ];


    $data  = [
      'title'   =>  'Penjualan',
      'tag'     =>  'income',
      'tanggal' =>  $this->datenowtoview(),
      'report'  =>  $report2,
      'month'  =>  $month,
    ];

    return view('home', $data);
  }

  public function about()
  {
    return view('about');
  }

  public function changelog()
  {
    return view('changelog');
  }
}
