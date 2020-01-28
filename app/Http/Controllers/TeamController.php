<?php  
 namespace App\Http\Controllers;  
 use App\Models\Team;  
use Illuminate\Http\Request;

 class TeamController extends Controller  
 {  
     public function index(Request $request)  
      
     {
          
     $acceptHeader = $request->header('Accept');

     if ($acceptHeader === 'application/json')
     {
          $team = Team::with(['pemain:nama,no_punggung,id','turnamen:nama_turnamen,id'])->OrderBy("id", "DESC")->paginate(10);

          if ($acceptHeader === 'application/json')
          {
               return response()->json($team->items('data'), 200);
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
               'nama_team' => 'required',  
               'nama_manajer' => 'required',  
               'stadion' => 'required',  
               'email' => 'required|email' 
          ];  
          $validator = \Validator::make($input, $validationRules);  
          if ($validator->fails()) {  
                    return response()->json($validator->errors(), 400);  
          }  
           $team = Team::create($input);  
           return response()->json($team,200);  
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
           $team = Team::with(['pemain:nama,no_punggung,id','turnamen:nama_turnamen,id'])->find($id);  
           if(!$team) {  
                abort(404);  
           }  
           return response()->json($team,200);  
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

  $team = Team::find($id);

  if(!$team) {
   abort(404);
  }

  $validationRules = [  
     'nama_team' => 'required',  
     'nama_manajer' => 'required',  
     'stadion' => 'required',  
     'email' => 'required|email' 
];  
$validator = \Validator::make($input, $validationRules);  
if ($validator->fails()) {  
          return response()->json($validator->errors(), 400);  
}  

  $team->fill($input);
  $team->save();

  return response()->json($team,200);
 }

 /**
 * Remove the specified resource from storage
 *
 * @param int $id
 * @return  \Illuminate\Http\Response
 */

public function delete($id)
{
 $team= Team::find($id);

 if(!$team) {
  abort(404);
 }

 $team->delete();
 $message =['message' => 'deleted succesfully', 'id' => $id];

 return response()->json($message,200);
}
 }  