<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;
  protected $table          = 'users';
  protected $primaryKey     = 'id';
  // public $incrementing   = false;
  protected $fillable       = [
    'name', 'email', 'no_ktp', 'telepon', 'alamat', 'password',
    'pin', 'isactive', 'remember_token', 'created_at', 'updated_at',
  ];

  protected $hidden         = [
    'password', 'remember_token',
  ];
  
  /*
  * Method untuk yang mendefinisikan relasi antara model user dan model Role
  */
  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }
  /*
  * Method untuk menambahkan role (hak akses) baru pada user
  */
  public function putRole($role)
  {
    if (is_string($role))
    {
      $role = Role::whereRoleName($role)->first();
    }
    return $this->roles()->attach($role);
  }
  /*
  * Method untuk menghapus role (hak akses) pada user
  */
  public function forgetRole($role)
  {
    if (is_string($role))
    {
      $role = Role::whereRoleName($role)->first();
    }
    return $this->roles()->detach($role);
  }
  /*
  * Method untuk mengecek apakah user yang sedang login punya hak akses untuk mengakses page sesuai rolenya
  */
  public function hasRole($roleName)
  {
    foreach ($this->roles as $role)
    {
      if ($role->role_name === $roleName) return true;
    }
    return false;
  }

}
