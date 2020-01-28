<?php  
 namespace App\Models;  
 use Illuminate\Database\Eloquent\Model;  
 class Turnamen extends Model   
 {  
      protected $table ='turnamen';  
      protected $fillable = array('nama_turnamen','tgl_mulai','tgl_selesai','admin_id');  

      public $timestamps = true;

      public function turney()
      {
       return $this->hasMany(Turnamen::class,'turnamen_id');
      } 

      public function admin()
      {
        return $this->hasMany(Admin::class, 'admin_id');
      }
 }  