<?php  
 namespace App\Http\Controllers;  
 use App\Models\Wasit;  
use Illuminate\Http\Request;

 class WasitController extends Controller  
 {  
      public function index()  
      {  
          $acceptHeader = $request->header('Accept');

          if ($acceptHeader === 'application/json')
          {
               $wasit = Wasit::with('pertandingan:tima_id,timb_id,id','admin:username')->OrderBy("id","DESC")->paginate(10); 
     
               if ($acceptHeader === 'application/json')
               {
                    return response()->json($wasit->items('data'), 200);
               }
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
               'nama_wasit' => 'required',  
               'email' => 'required|email',  
               'alamat' => 'required', 
               'telepon' => 'required|min:8|max:12', 
               'admin_id' => 'required' 
          ];  
          $validator = \Validator::make($input, $validationRules);  
          if ($validator->fails()) {  
                    return response()->json($validator->errors(), 400);  
          }   
           $wasit = Wasit::create($input);  
           return response()->json($wasit,200);  
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
           $wasit = Wasit::with('pertandingan:tima_id,timb_id,id','admin:username')->find($id);  
           if(!$wasit) {  
                abort(404);  
           }  
           return response()->json($wasit,200);
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

  $wasit = Wasit::find($id);

  if(!$wasit) {
   abort(404);
  }

  $validationRules = [  
     'nama_wasit' => 'required',  
     'email' => 'required|email',  
     'alamat' => 'required', 
     'telepon' => 'required|min:8|max:12', 
     'admin_id' => 'required' 
];  
$validator = \Validator::make($input, $validationRules);  
if ($validator->fails()) {  
          return response()->json($validator->errors(), 400);  
}   

  $wasit->fill($input);
  $wasit->save();

  return response()->json($wasit,200);
 }

 /**
 * Remove the specified resource from storage
 *
 * @param int $id
 * @return  \Illuminate\Http\Response
 */

public function delete($id)
{
 $wasit= Wasit::find($id);

 if(!$wasit) {
  abort(404);
 }

 $wasit->delete();
 $message =['message' => 'deleted succesfully', 'id' => $id];

 return response()->json($message,200);
}
 }  