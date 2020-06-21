<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    public $incrementing  = false;
    protected $table      = 'pages';
    protected $fillable   = ['id', 'title', 'name', 'content', 'featured_image', 'image_1', 'image_2', 'image_3','status'];
}
