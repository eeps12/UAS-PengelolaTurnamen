<?php  
 namespace App\Http\Controllers;  
 use App\Models\Turnamen;  
use Illuminate\Http\Request;

 class TurnamenController extends Controller  
 {  
      public function index()  
      {  

          $acceptHeader = $request->header('Accept');

          if ($acceptHeader === 'application/json')
          {
               $turnamen = Turnamen::with('admin:username')->OrderBy("id","DESC")->paginate(10);
     
               if ($acceptHeader === 'application/json')
               {
                    return response()->json($turnamen->items('data'), 200);
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
               'nama_turnamen' => 'required',  
               'tgl_mulai' => 'required|date',  
               'tgl_selesai' => 'required|date',  
               'admin_id' => 'required' 
          ];  
          $validator = \Validator::make($input, $validationRules);  
          if ($validator->fails()) {  
                    return response()->json($validator->errors(), 400);  
          }   
           $turnamen = Turnamen::create($input);  
           return response()->json($turnamen,200);  
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
           $turnamen = Turnamen::with('admin:username')->find($id);  
           if(!$turnamen) {  
                abort(404);  
           }  
           return response()->json($turnamen,200);
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

  $turnamen = Turnamen::find($id);

  if(!$turnamen) {
   abort(404);
  }

  $validationRules = [  
     'nama_turnamen' => 'required',  
     'tgl_mulai' => 'required|date',  
     'tgl_selesai' => 'required|date',  
     'admin_id' => 'required' 
];  
$validator = \Validator::make($input, $validationRules);  
if ($validator->fails()) {  
          return response()->json($validator->errors(), 400);  
}   

  $turnamen->fill($input);
  $turnamen->save();

  return response()->json($turnamen,200);
 }

 /**
 * Remove the specified resource from storage
 *
 * @param int $id
 * @return  \Illuminate\Http\Response
 */

public function delete($id)
{
 $turnamen= Turnamen::find($id);

 if(!$turnamen) {
  abort(404);
 }

 $turnamen->delete();
 $message =['message' => 'deleted succesfully', 'id' => $id];

 return response()->json($message,200);
}
 }  