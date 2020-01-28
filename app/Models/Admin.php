<?php  
 namespace App\Models;  
 use Illuminate\Auth\Authenticatable;  
 use Laravel\Lumen\Auth\Authorizable;  
 use Illuminate\Database\Eloquent\Model;  
 use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;  
 use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;  

 use Tymon\JWTAuth\Contracts\JWTSubject;

 class Admin extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
 {  
      use Authenticatable, Authorizable;  
      /**  
      * The attributes that are mass assignable  
      * @var array  
      */  
      protected $table = 'admin';
      protected $fillable = [  
           'username','email','password',  
      ];  
      /**  
      * The attributes excluded from the model's JSON form  
      *  
      * @var array  
      */  
      protected $hidden = [  
           'password',  
      ]; 
      
      /**  
      * JWT Implementations  
      * Get the identifier that will be stored in the subject claim of the JWT  
      *  
      * @return mixed  
      */  
      public function getJWTIdentifier()  
      {  
           return $this->getKey();  
      }  
      /**  
      * Return a key value array, containing any custom to be addedd to the JWT  
      *  
      * @return array  
      */  
      public function getJWTCustomClaims()  
      {  
           return [];  
      }  
 }  
 ?>  