<?php  
 namespace App\Models;  
 use Illuminate\Database\Eloquent\Model;  
 class Pertandingan extends Model   
 {  
      protected $table ='pertandingan';  
      protected $fillable = array('ket_pertandingan','hasil_pertandingan','tima_id','timb_id','wasit_id','admin_id','turnamen_id','waktu');  

      public $timestamps = true;

      public function turnamen()
      {
        return $this->belongsTo(Turnamen::class,'turnamen_id');
      }

      public function tima()
      {
        return $this->belongsTo(Team::class,'tima_id');
      }

      public function timb()
      {
        return $this->belongsTo(Team::class,'timb_id');
      }

      public function wasit()
      {
        return $this->belongsTo(Wasit::class,'wasit_id');
      }

      public function admin()
      {
        return $this->belongsTo(Admin::class, 'admin_id');
      }
 }  