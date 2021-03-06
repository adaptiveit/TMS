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
            $data = Data::latest()->paginate(10);
            return view('demo.datatable',compact('data','title'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
        
        
	public function datatableupdate(Request $request) {
			$request_data = $request->all();
			$rules = array (
					'fname' => 'required|alpha',
					'lname' => 'required',
					'email' => 'required|email',
					'gender' => 'required',
					'country' => 'required|regex:/^[\pL\s\-]+$/u',
					'salary' => 'required|regex:/^\d*(\.\d{2})?$/' 
			);
			$validator = Validator::make ($request_data, $rules );
			if ($validator->fails ())
				return Response::json ( array (             
						'errors' => $validator->getMessageBag ()->toArray () 
				) );
			else {
			    $created_by=Auth::user()->id;
			    $updated_by=Auth::user()->id;	
			    if(!empty($request->id)){			
				$data = Data::find ($request->id);
				}else{
				$data = new Data;	
				}
				$data->first_name = ($request->fname);
				$data->last_name = ($request->lname);
				$data->email = ($request->email);
				$data->gender = ($request->gender);
				$data->country = ($request->country);
				$data->salary = ($request->salary);
				$data->created_by = ($created_by);
				$data->updated_by = ($updated_by);
				//echo"<pre>";print_r($data); echo"</pre>";exit;
				$data->save ();
				return response ()->json ( $data );
			}
		}
        
    public function datatabledelete(Request $request) {
		 Data::find ( $request->id )->delete ();
		 return response ()->json ();
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
