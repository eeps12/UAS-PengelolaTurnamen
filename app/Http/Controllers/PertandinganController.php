<?php  
 namespace App\Http\Controllers;  
 use App\Models\Pertandingan;  
use Illuminate\Http\Request;

 class PertandinganController extends Controller  
 {  
      public function index()  
      {  
          $acceptHeader = $request->header('Accept');

          if ($acceptHeader === 'application/json')
          {
               $pertandingan = Pertandingan::with(['turnamen:nama_turnamen,id','tima:nama_team,id','timb:nama_team,id','admin:username'])->OrderBy("id","DESC")->paginate(10);
    
               if ($acceptHeader === 'application/json')
               {
                    return response()->json($pertandingan->items('data'), 200);
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
               'tima_id' => 'required',  
               'timb_id' => 'required',  
               'wasit_id' => 'required',  
               'admin_id' => 'required',
               'turnamen_id' => 'required',
               'waktu' => 'required|dateTime' 
          ];  
          $validator = \Validator::make($input, $validationRules);  
          if ($validator->fails()) {  
                    return response()->json($validator->errors(), 400);  
          }   
           $pertandingan = Pertandingan::create($input);  
           return response()->json($pertandingan,200);  
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
           $pertandingan = Pertandingan::with(['turnamen:nama_turnamen,id','tima:nama_team,id','timb:nama_team,id'])->find($id);  
           if(!$pertandingan) {  
                abort(404);  
           }  
           return response()->json($pertandingan,200);  
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

  $pertandingan = Pertandingan::find($id);

  if(!$pertandingan) {
   abort(404);
  }

  $validationRules = [  
     'tima_id' => 'required',  
     'timb_id' => 'required',  
     'wasit_id' => 'required',  
     'admin_id' => 'required',
     'turnamen_id' => 'required',
     'waktu' => 'required|dateTime' 
];  
$validator = \Validator::make($input, $validationRules);  
if ($validator->fails()) {  
          return response()->json($validator->errors(), 400);  
}   

  $pertandingan->fill($input);
  $pertandingan->save();

  return response()->json($pertandingan,200);
 }

 /**
 * Remove the specified resource from storage
 *
 * @param int $id
 * @return  \Illuminate\Http\Response
 */

public function delete($id)
{
 $pertandingan= Pertandingan::find($id);

 if(!$pertandingan) {
  abort(404);
 }

 $pertandingan->delete();
 $message =['message' => 'deleted succesfully', 'id' => $id];

 return response()->json($message,200);
}
 }  