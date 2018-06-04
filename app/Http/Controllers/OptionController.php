<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Option;
use Auth;
use Validator;
use DB;
use AdminHelper;

class OptionController extends Controller
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
        $title = "Option";
        // get all the nerds
        $limit = config('admin.record_per_page');
        #$clients = Client::paginate($limit);
        $fleets = Option::all();
		//dd($fleets);
        return view('option.index', compact('title', 'fleets'));
}

    
public function create()
    {
		$title = "User";
        $id = DB::table('tbl_option_group')
                    ->pluck('id', 'id');

    return view('option.create',compact('title','id'));
        
        
        
       
    }
    
    
    public function addMore()
    {
        return view("addMore");
    }

    
 public function store(Request $request) {
        $data = $request->all();
        $rules = array(
             'status' => 'required|boolean',
        );
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/option/create')->withErrors($validator)->withInput();
        } else {
            $option = new Option;
         
            $created_by=Auth::user()->id;
			$updated_by=Auth::user()->id;
			$group = $data['group'];
			$status = $data['status'];
            foreach($data['option_value'] as  $key=>$row){
             	$a[$key]=array('option_group_id'=> $group,
             	'label'=> $row['label'],
             	'value'=> $row['value'],
             	'name'=> $row['name'],
             	'is_default'=> 0,
             	'weight'=> 1,
             	'status'=> $status,
				'created_by' => $created_by,
				'updated_by' => $updated_by,
				);
				    DB::table('tbl_option_value')->insert($a[$key]);
            //$a[$option]->save();
          
            
		}
		  // echo"<pre>";print_r($data);echo"</pre>";exit;
            $request->session()->flash('alert-success', 'User successfully created!');
            return redirect('admin/option');
        }
    }
    
    


	   
   
    
		

				
	
	
public function show($id) {
        //
    }	
 public function edit($id) {
        $title = "Option edit";
        $data = Option::find($id);
       //echo"<pre>";print_r($data);echo"</pre>";exit;
        return view('option.edit', compact('title', 'data'));
  }
  
  
public function update(Request $request, $id) {
		//$data= array();
		$this->validate($request, [
        'id' => 'required',
        'group' => 'required',
        'status' => 'required'
    ]);
		
		$user = Option::find($id);
		//$test=Group::find($id);
		//print_r($user);exit;
		//$user->id=$request->get('id');
		//$user->option_group_id=$request->get('option_group_id');
		if($user){
		$user->label=$request->get('label');
		$user->value=$request->get('value');
		$user->name=$request->get('name');
		$user->grouping=$request->get('grouping');
		$user->status=$request->get('status');
		$user->created_by=Auth::user()->id;
		$user->updated_by = Auth::user()->id;
        $user->save();
	}
        
       // echo "record updated successfully"; exit;
        $request->session()->flash('alert-success', 'User successfully updated!');
            return redirect('admin/option/create');
		//print_r($user->incharge_id);exit;
		
		
		
			
			
        }
        
        
        
public function destroy(Request $request, $id) {
        $role = Option::find($id);
        $role->delete();

        // redirect
        $request->session()->flash('alert-success', 'User successfully deleted!');
        return redirect('admin/fleettype');
    }

}

