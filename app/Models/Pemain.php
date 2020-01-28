<?php  
 namespace App\Models;  
 use Illuminate\Database\Eloquent\Model;  
 class Pemain extends Model   
 {  
      protected $table ='pemain';  
      protected $fillable = array('nama','posisi','no_punggung','email','team_id');  

      public $timestamps = true;

      public function tim()
      {
           return $this->belongsTo(Team::class, 'team_id');
      }
 }  