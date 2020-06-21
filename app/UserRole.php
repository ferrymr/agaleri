<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'role_user';
    public $timestamps = false;
    public $incrementing  = false;
  	protected $fillable = [
  		'role_id', 'user_id'
  	];

    public function getUserObject()
  {
    return $this->belongsToMany(User::class)->using(UserRole::class);
  }
}
