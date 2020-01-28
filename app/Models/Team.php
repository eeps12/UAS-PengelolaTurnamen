<?php  
 namespace App\Models;  
 use Illuminate\Database\Eloquent\Model;  
 class Team extends Model   
 {  
      protected $table ='team';  
      protected $fillable = array('nama_team','nama_manajer','stadion','email','turnamen_id');  

      public $timestamps = true;

      public function pemain()
      {
           return $this->hasMany(Pemain::class, 'team_id');
      }

      public function turnamen()
      {
           return $this->belongsTo(Turnamen::class, 'turnamen_id');
      }
 }  