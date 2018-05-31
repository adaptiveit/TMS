<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\group;
use Auth;
use Validator;
use DB;
use AdminHelper;

class GroupController extends Controller
{
    //
     public function __construct() {
        $this->middleware('admin');
        $this->middleware('acl:fleet_add', ['only' => ['create', 'store']]);
        $this->middleware('acl:fleet_edit', ['only' => ['edit', 'update']]);
        $this->middleware('acl:fleet_delete', ['only' => ['destroy']]);
        $this->middleware('acl:fleet_list', ['only' => ['index']]);
    }
    
    
    
public function index() {
        $title = "Fleettype";
        // get all the nerds
        $limit = config('admin.record_per_page');
        #$clients = Client::paginate($limit);
        $fleets = Group::all();
		//dd($fleets);
        return view('fleettype.index', compact('title', 'fleets'));
}

    
public function create()
    {
		
		
		$title = "User";
        $id = DB::table('tbl_option_group')
                    ->pluck('id', 'id');

    return view('group.create',compact('title','id'));
        
        
        
       
    }
    
    
    
    
    /*ANITA*/

public function store(Request $req)
    {
//$data = $req->all();		
$this->validate($req, [
        'name' => 'required',
        'title' => 'required',
        'status' => 'required'
    ]);
   
    $name=$req->input('name');
    $title=$req->input('title');
    $status=$req->input('status');
    $description=$req->input('description');
    //$reserved='0';
    //$locked='0';
    $created_by=Auth::user()->id;
	$updated_by=Auth::user()->id;
	
	$data=array("name"=>$name,"title"=>$title,"description"=>$description,"status"=>$status,
	"created_by"=>$created_by,"updated_by"=>$updated_by
	
	);
	//print_r($data);exit;
	    DB::table('tbl_option_group')->insert($data);
	     return redirect('admin/group/create');
	   
   
    
		
	   
   
       
	}
	
	
public function show($id) {
        //
    }	
 public function edit($id) {
        $title = "Fleettype edit";
        $data = Group::find($id);
        return view('fleettype.edit', compact('title', 'data'));
  }
  
  
public function update(Request $request, $id) {
		$data= array();
		/*$this->validate($request, [
        'fleet_type' => 'required',
        'incharge_id' => 'required',
        'status' => 'required'
    ]);*/
		$data = array(
		'fleet_type' => $request->input('fleet_type'),
		'incharge_id' => $request->input('fleet_id'),
		'status' => $request->input('status')
		
		);
		$user = Group::find($id);
		$user->fleet_type=$request->get('fleet_type');
		$user->incharge_id=$request->get('fleet_id');
		$user->status=$request->get('status');
		$user->created_by=Auth::user()->id;
		$user->updated_by = Auth::user()->id;
        $user->save();
        
       // echo "record updated successfully"; exit;
        $request->session()->flash('alert-success', 'User successfully updated!');
            return redirect('admin/fleettype');
		//print_r($user->incharge_id);exit;
		
		
		
			
			
        }
        
        
        
public function destroy(Request $request, $id) {
        $role = Group::find($id);
        $role->delete();

        // redirect
        $request->session()->flash('alert-success', 'User successfully deleted!');
        return redirect('admin/fleettype');
    }

}

