<?php  
 namespace App\Http\Controllers;  
 use Illuminate\Http\Request;  
 use App\Models\Admin;  
use Illuminate\Support\Facades\Auth;
 class AuthController extends Controller  
 {  
      /**  
      * Store a new user  
      *  
      * @param Request $request  
      * @return Response  
      */  
      public function register (Request $request)  
      {  
           $this->validate($request, [  
                'username' => 'required|string',  
                'email' => 'required|email|unique:admin',  
                'password' => 'required|confirmed',  
           ]);  
           $input = $request->all();  
           //validation  
           $validationRules = [  
                'username' => 'required|string',  
                'email' => 'required|email|unique:admin',  
                'password' => 'required|confirmed',  
           ];  
           $validator = \Validator::make($input, $validationRules);  
           if ($validator->fails()) {  
                return response()->json($validator->errors(), 400);  
           }  
           // validation end  
           //create user  
           $admin = new Admin;  
           $admin->username = $request->input('username');  
           $admin->email = $request->input('email');  
           $plainPassword = $request->input('password');  
           $admin->password = app('hash')->make($plainPassword);  
           $admin->save();  
           return response()->json($admin, 200);  
      }  

       /**  
      * Get a JWT via given credentials.  
      *  
      * @param Request $request  
      * @return Response  
      */  
      public function login(Request $request)  
      {  
           $input = $request->all();  
           // validation  
           $validationRules = [  
                'email' => 'required|string',  
                'password' => 'required|string',  
           ];  
           $validator = \Validator::make($input, $validationRules);  
           if ($validator->fails()) {  
                return response()->json($validator->errors(), 400);  
           }  
           // process login  
           $credentials = $request->only(['email','password']);  
           if (! $token = Auth::attempt($credentials)) {  
                return response()->json(['message' => 'Unauthorized'], 401);  
           }  
           return response()->json([  
                'token' => $token,  
                'token_type' => 'bearer',  
                'expires_in' => Auth::factory()->getTTL() * 60  
           ], 200);  
      }  
 }  
 ?>  