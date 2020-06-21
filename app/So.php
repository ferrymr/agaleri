<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class So extends Model
{
    protected $table = 'so';
    protected $fillable = [
      'id','index','jam_order','status','tanggal_order','tanggal_masuk','tanggal_akhir','ket',
      'qty','art','term','harga_jual_spk','nilai_pekerjaan','dp','produksi_id','barang_jadi_id','costumer_id',
      'name','catatan','isactive','created_at','updated_at', 'bj_id', 'brand_id', 'bb_id', 'bulan_id', 'status_pembayaran', 'sisa_pembayaran', 'iscomplete',
      'pemakaian_acc_post'

    ];
    protected $casts = [
   'id' => 'string',
    ];
    public $timestamps = true;
}
