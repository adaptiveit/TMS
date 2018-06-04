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



class DemoController extends Controller
{
	 public function __construct() {
       // $this->middleware('admin');
       // $this->middleware('acl:fleet_add', ['only' => ['create', 'store']]);
       // $this->middleware('acl:fleet_edit', ['only' => ['edit', 'update']]);
       // $this->middleware('acl:fleet_delete', ['only' => ['destroy']]);
        //$this->middleware('acl:fleet_list', ['only' => ['index']]);
    }

 /*public function myform()
    {
		$state="gg";
        //$states = DB::table("demo_state")->lists("name","id");
        return view('my',compact('states'));
    }


 
 public function myformAjax($id)
    {
        $cities = DB::table("demo_cities")
                    ->where("state_id",$id)
                    ->lists("name","id");
        return json_encode($cities);
    }*/
    
public function create()
    {
		
		
		$title = "User";
        $id = DB::table('tbl_option_group')
                    ->pluck('id', 'id');

    return view('demo.create',compact('title','id'));
        
        
        
       
    }
      
public function index() {
        $title = "Option";
        $limit = config('admin.record_per_page');
         $fleets = DB::table('tbl_option_group')->pluck('name','id');
        //echo"<pre>";print_r($fleets);echo"</pre>";exit;
        
        return view('demo.index', compact('title', 'fleets'));
}

public function show($id) {
        //
    }
    
 public function myformAjax($id)
    {		
        $cities = DB::table("tbl_option_value")
                    ->where("option_group_id",$id)
                    ->pluck("value","id");
        return json_encode($cities);
    }
    
 
    


    
    
    
    
     
    

}
