<?php  
 namespace App\Models;  
 use Illuminate\Database\Eloquent\Model;  
 class Klasemen extends Model   
 {  
      protected $table ='klasemen';  
      protected $fillable = array('tim_id','menang','kalah','seri','turnamen_id','poin','peringkat','admin_id');  

      public $timestamps = true;

      public function tim()
      {
           return $this->belongsTo(Team::class, 'tim_id');
      }

      public function turnamen()
      {
           return $this->belongsTo(Turnamen::class, 'turnamen_id');
      }

      public function admin()
      {
           return $this->belongsTo(Admin::class, 'admin_id');
      }
 }  