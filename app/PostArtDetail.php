<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostArtDetail extends Model
{
    protected $table = 'post_art_detail';
    protected $fillable = [
        'so_id','art_id','qty_art_total','qty_art_detail','created_at','updated_at'
    ];
    protected $casts = [
        'so_id' => 'string',
        'art_id' => 'string',
    ];
    protected $primaryKey = 'so_id';
}
