<?php  
 namespace App\Models;  
 use Illuminate\Database\Eloquent\Model;  
 class Wasit extends Model   
 {  
      protected $table ='wasit';  
      protected $fillable = array('nama_wasit','email','telepon','alamat','admin_id');  

      public $timestamps = true;

      public function pertandingan()
      {
           return $this->hasMany(Pertandingan::class, 'wasit_id');
      }

      public function admin()
      {
           return $this->hasMany(Admin::class, 'admin_id');
      }
 }