<?php  
 namespace App\Http\Controllers;  
 use App\Models\Pemain;  
use Illuminate\Http\Request;

 class PemainController extends Controller  
 {  
      public function index(Request $request)  
      
      {
           
      $acceptHeader = $request->header('Accept');

      if ($acceptHeader === 'application/json')
      {
           $pemain = Pemain::with('tim:nama_team,id')->OrderBy("id", "DESC")->paginate(10);

           if ($acceptHeader === 'application/json')
           {
                return response()->json($pemain->items('data'), 200);
           } else
          {
               return response('Not Acceptable!', 406);
          }
     } 
}

      /**  
       * Store a newly created resource in storage.  
       *  
       * @param \Illuminate\Http\Request $request  
       * @return \Illuminate\Http\Respons  
       */  
      public function store(Request $request)  
      {  
           $input = $request->all(); 
           $validationRules = [  
               'nama' => 'required',  
               'posisi' => 'required',  
               'no_punggung' => 'required',  
               'email' => 'required|email',
               'team_id' => 'required'  
          ];  
          $validator = \Validator::make($input, $validationRules);  
          if ($validator->fails()) {  
                    return response()->json($validator->errors(), 400);  
          }  
           $pemain = Pemain::create($input);  
           return response()->json($pemain,200);  
      }  

      /**   
      *Display the specified resource  
      *  
      *@param int $id  
      *@return \Illuminate\Http\Response  
      */  
      public function show(Request $request, $id)  
      {  
          $acceptHeader = $request->header('Accept');

          if ($acceptHeader === 'application/json'){
           $pemain = Pemain::with('tim:nama_team,id')->find($id);  
           if(!$pemain) {  
                abort(404);  
           }  
           return response()->json($pemain,200);  
          } else {
               return response('Not Acceptable!', 406);
          }
     }
       

      /**
 * Update the specified resource in storage
 *
 * @param \Illuminate\Http\Request $request
 * @param int $id
 * @return  \Illuminate\Http\Response
 */

 public function update(Request $request, $id)
 {
  $input = $request->all();

  $pemain = Pemain::find($id);

  if(!$pemain) {
   abort(404);
  }

  $validationRules = [  
     'nama' => 'required',  
     'posisi' => 'required',  
     'no_punggung' => 'required',  
     'email' => 'required|email',
     'team_id' => 'required'  
];  
$validator = \Validator::make($input, $validationRules);  
if ($validator->fails()) {  
          return response()->json($validator->errors(), 400);  
}  

  $pemain->fill($input);
  $pemain->save();

  return response()->json($pemain,200);
 }

 /**
 * Remove the specified resource from storage
 *
 * @param int $id
 * @return  \Illuminate\Http\Response
 */

public function delete($id)
{
 $pemain= Pemain::find($id);

 if(!$pemain) {
  abort(404);
 }

 $pemain->delete();
 $message =['message' => 'deleted succesfully', 'id' => $id];

 return response()->json($message,200);
}
 }  