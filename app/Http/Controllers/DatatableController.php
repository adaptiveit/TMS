<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Option;
use App\Models\Group;
use App\Models\Demo;
use App\Models\Data;
use Auth;
use Validator;
use DB;
use AdminHelper;



class DatatableController extends Controller
{
	public function __construct() {
    
    }

public function show($id) {
        //
    }
    
    
//Demo controller by Keshav

   public function index()
        {
			$title = "Datatable";
            $datas = Data::latest()->paginate(10);
            return view('datatable.index',compact('datas','title'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
   public function create()
        {
		$title = "Supplier";

        return view('demo.create', compact('title'));
        }   
         
	public function store(Request $request)
        {
           $request_data = $request->all();
           $rules = array(
                'supplier_name' => 'required',
                'contact_person' => 'required',
                'remarks' => 'required',
                'status' => 'required' );
                
           
           $validator = Validator::make($request_data, $rules);
           if ($validator->fails()) {
            return redirect('admin/demo/create')->withErrors($validator)->withInput();
		   }
		   else{
			   $data = new Demo;
			   
			   $created_by=Auth::user()->id;
			   $updated_by=Auth::user()->id;
			   
			   $data->supplier_name = $request->input('supplier_name');
			   $data->address = $request->input('address');
			   $data->contact_person = $request->input('contact_person');
			   $data->telephone = $request->input('contact_number');
			   $data->remarks = $request->input('remarks');
			   $data->status = $request->input('status');
			   $data->created_by = $created_by;
			   $data->updated_by = $updated_by;
	       }
            $data->save();
            return redirect()->route('demo.index')
                            ->with('success','Fuelstation created successfully');
		}

//Custom Demo
	public function cdemo()
        {
			$title = "Custom Supplier";
			//echo "Welcome Demo";exit;
            $demos = Demo::latest()->paginate(5);
            return view('demo.cdemo',compact('demos','title'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
		public function autocomplete(Request $request)
		{
			$term=$request->term;
			$data = Demo::where('supplier_name','LIKE','%'.$term.'%')
			->take(10)
			->get();
			//print_r($data);
			$result=array();
			foreach ($data as $key => $v){
			//print_r($v);	
			$result[]=['id'=>$v['id'],'name' =>$v['supplier_name']];
					}
			return response()->json($result);
		}

//Autocomplete
		public function optiondemo(){
			
			/*$title = "Option Group & Values";
            $options = Option::latest()->paginate(10);
            echo"<pre>";print_r($options);echo"</pre>";
            return view('demo.optiondemo',compact('options','title'))
                ->with('i', (request()->input('page', 1) - 1) * 5);	
            */
            	    
			$orders = Option::select(array(
				'id', 'value', 'name', 'option_group_id'
			));

        return Datatables::of($orders)->make(true);
		}
		public function filter(){
			
			$title = "Option Group & Values";
            $options = Option::latest()->paginate(10);
            return view('demo.optiondemo',compact('options','title'))
                ->with('i', (request()->input('page', 1) - 1) * 5);	
		}
    
    
    
     
    

}
