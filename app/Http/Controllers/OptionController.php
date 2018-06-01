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
            //'role' => 'required|integer',
            //'user_name' => 'required|min:6|max:15|unique:users',
           
			//'name' => 'required',
             'status' => 'required|boolean',
        );
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/option/create')->withErrors($validator)->withInput();
        } else {
            $option = new Option;
            //echo"<pre>";print_r($data);echo"</pre>";
            $created_by=Auth::user()->id;
			$updated_by=Auth::user()->id;
			$group = $data['group'];
			$status = $data['status'];
            foreach($data['option_value'] as  $row){
             	$option->option_group_id= $group;
             	$option->label= $row['label'];
             	$option->value= $row['value'];
             	$option->name= $row['name'];
             	$option->is_default= 0;
             	$option->weight= 1;
             	$option->status= $status;
				$option->created_by 	= $created_by;
				$option->updated_by 	= $updated_by;
            $option->save();
           //Option::create($option->save());
            
		}
		//echo"<pre>";print_r($option);echo"</pre>";exit;
		//id`, `option_group_id`, `label`, `value`, `name`, `grouping`, `filter`, `is_default`, `weight`, `description`, `is_optgroup`, `is_reserved`, //`status`, `component_id`, `visibility_id`, `created_by`, `updated_by`, `created_at`, `updated_at`
		
	
            // redirect
            $request->session()->flash('alert-success', 'User successfully created!');
            return redirect('admin/user');
        }
    }
    
    
    /*ANITA*/

/*public function store(Request $req)
    {
$data = $req->all();
echo '<pre>'; print_r($data); '</pre>';exit;
$input = Option::all();		
/*$this->validate($req, [
        'group' => 'required',
        'status' => 'required'
    ]);*/
 /*$medicineData = array();
 
   $group=$req->input('group');
  $label=$req->input('label');
  $value=$req->input('value');
  
    $name=$req->input('name');
    $grouping=$req->input('grouping');
    $status=$req->input('status');
    $isdefault=	'0';
    $weight='1';
    $created_by=Auth::user()->id;
	$updated_by=Auth::user()->id;
	
	$data=array("option_group_id"=>$group,"label"=>$label,"value"=>$value, "name"=>$name,"grouping"=>$grouping,"is_default"=>$isdefault,"weight"=>$weight,
	"status"=>$status,
	"created_by"=>$created_by,"updated_by"=>$updated_by);
	    DB::table('tbl_option_value')->insert($data);
	     return redirect('admin/option/create');
	   
   
    
		
	   
   
       
	}*/
	
	/*public function store(Request $request) { 
		
		$request_data = $request->all(); 
		$rules = array( 
		'id' => 'required', 
		'group' => 'required',  
		'status' => 'required'); 
		$validator = Validator::make($request_data, $rules); 
		if ($validator->fails()) { 
			return redirect('admin/option/create')->withErrors($validator)->withInput(); 
			} 
			else{ 
				$data = new Option; 
				$created_by=Auth::user()->id; 
				$updated_by=Auth::user()->id; 
				//print_r($request_data);exit;
				$data->id = $request->input('id'); 
				$data->option_group_id = $request->input('group'); 
				$data->label = $request->input('label'); 
				$data->value = $request->input('value');
				/*$test=array();
				foreach($data->value as $key=>$val){
				$test[]=array(
				$data->value=$val[$key];
		
				);
				
					
				}	*/ 
				/*$data->name = $request->input('name'); 
				$data->grouping = $request->input('grouping'); 
				$data->is_default = '0'; 
				$data->weight = '0'; 
				
				$data->status = $request->input('status'); 
				$data->created_by = $created_by; 
				$data->updated_by = $updated_by; 
				} 
				Option::create($data->save()); 
				return redirect()->route('option.index') ->with('success','Fuelstation created successfully'); 
				}*/
	
	
public function show($id) {
        //
    }	
 public function edit($id) {
        $title = "Option edit";
        $data = Option::find($id);
        /* print_r( $data);exit;*/
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
		/*print_r($user);exit;*/
		$user->id=$request->get('id');
		//$user->option_group_id=$request->get('option_group_id');
		$user->label=$request->get('label');
		$user->value=$request->get('value');
		$user->name=$request->get('name');
		$user->grouping=$request->get('grouping');
		$user->status=$request->get('status');
		$user->created_by=Auth::user()->id;
		$user->updated_by = Auth::user()->id;
        $user->save();
        
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

