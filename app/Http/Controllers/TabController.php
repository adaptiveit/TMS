<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Option;
use App\Models\Group;
use Auth;
use Validator;
use DB;
use AdminHelper;



class TabController extends Controller
{
	 public function __construct() {
       // $this->middleware('admin');
       // $this->middleware('acl:fleet_add', ['only' => ['create', 'store']]);
       // $this->middleware('acl:fleet_edit', ['only' => ['edit', 'update']]);
       // $this->middleware('acl:fleet_delete', ['only' => ['destroy']]);
        //$this->middleware('acl:fleet_list', ['only' => ['index']]);
    }


    

    
    

    
 public function form()
    {
					
	$data=[
		'name'=>'anita',
		'mobile'=>'999999999',
		'email'=>'anita@gmail.com',
		'status'=>0
		
		
		];
		//$array = json_decode($data, true);
		 //return view('form',compact('data'));
		//$json_array = [];
		return response()->json($data);
		//$json_array[] = json_encode($data);
		//$json_array = json_decode($data);
		//return $data ;
		//return view('tab.form')->with('data', json_decode($data));
		
}		
    
    
public function list()
    {
				
	
	$title = "User";
    return view('tab.list',compact('title'));
        
                   
    }

    
    
    
    
     
    

}
