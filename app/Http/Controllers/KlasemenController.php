<?php  
 namespace App\Http\Controllers;  
 use App\Models\Klasemen;  
use Illuminate\Http\Request;

 class KlasemenController extends Controller  
 {  
      public function index()  
      {  
          $acceptHeader = $request->header('Accept');

          if ($acceptHeader === 'application/json')
          {
               $klasemen = Klasemen::with(['tim:nama_team,id','turnamen:nama_turnamen,id'])->OrderBy("id","DESC")->paginate(10);  
     
               if ($acceptHeader === 'application/json')
               {
                    return response()->json($klasemen->items('data'), 200);
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
               'peringkat' => 'required',  
               'menang' => 'required',  
               'kalah' => 'required', 
               'seri' => 'required',
               'turnamen_id' => 'required',
               'tim_id' => 'required', 
               'admin_id' => 'required' 
          ];  
          $validator = \Validator::make($input, $validationRules);  
          if ($validator->fails()) {  
                    return response()->json($validator->errors(), 400);  
          }    
           $klasemen = Klasemen::create($input);  
           return response()->json($klasemen,200);  
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
           $klasemen = Klasemen::with(['tim:nama_team,id','turnamen:nama_turnamen,id','admin:username'])->find($id);  
           if(!$klasemen) {  
                abort(404);  
           }  
           return response()->json($klasemen,200);  
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

  $klasemen = Klasemen::find($id);

  if(!$klasemen) {
   abort(404);
  }

  $validationRules = [  
     'peringkat' => 'required',  
     'menang' => 'required',  
     'kalah' => 'required', 
     'seri' => 'required',
     'turnamen_id' => 'required',
     'tim_id' => 'required', 
     'admin_id' => 'required' 
];  
$validator = \Validator::make($input, $validationRules);  
if ($validator->fails()) {  
          return response()->json($validator->errors(), 400);  
}    

  $klasemen->fill($input);
  $klasemen->save();

  return response()->json($klasemen,200);
 }

 /**
 * Remove the specified resource from storage
 *
 * @param int $id
 * @return  \Illuminate\Http\Response
 */

public function delete($id)
{
 $klasemen= Klasemen::find($id);

 if(!$klasemen) {
  abort(404);
 }

 $klasemen->delete();
 $message =['message' => 'deleted succesfully', 'id' => $id];

 return response()->json($message,200);
}
 }  