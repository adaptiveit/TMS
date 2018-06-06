<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Webservice;
use Auth;
use Validator;
use DB;
use AdminHelper;



class WebserviceController extends Controller
{
	public function __construct() {
    
    }

	public function show($id) {
        //
    }
    
    
//Demo controller by Keshav

   public function index()
        {
			$param = array('email'=>'keshav@adaptiveit.net');
			//$result = $this->getActivity($param);
			$result = $this->getContact($param);
			$data = json_decode($result);
			//echo"<pre>";print_r($data);echo"</pre>";
			$title = "Datatable";
            //$data = Webservice::all()->paginate(10);
            //echo"<pre>";print_r($data);echo"</pre>";exit;
            return view('webservice.datatable',compact('data','title'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
/**
 * Webservice Consume Start
 */         
  
	public function getActivity($params = NULL){
		//echo"<pre>";print_r($p);echo"</pre>";exit;
		$url			= 'http://training.opencloudcrm.in/sites/all/modules/civicrm/extern/rest.php';
		$parameters = [
			'api_key'	=>	'abcdefghi',
			'key'		=>	'a909bb04bc2a61a5ce7f57822626a24e',
			'json'		=>	1,
			'debug'		=>	1,
			'version'	=>	3,
			'entity' 	=> 'Activity',
			'action'	=> 'get',
			'email'		=> $params['email'],
		];
		//$parameters		= 'api_key=abcdefghi&key=a909bb04bc2a61a5ce7f57822626a24e&json=1&debug=1&version=3&entity=Activity&action=get&first_name=Keshav';
		$method			= 'POST';
		
		//echo $url; exit;
		$response	= $this->call_rest_webservice($url, $parameters, $method);
		 return $response;
		//print_r($response);exit;
		//echo $response;
		//exit;
	}
    
    
   public function getContact($params = NULL){
		//$keyword	= $_REQUEST['keyword'];
		//echo $keyword; exit;
		//$key_arr	= explode("::", $keyword);
		//$sort_name	= trim($key_arr[0]);
		//$email		= trim($key_arr[1]);
		
		//debug($key_arr);exit;
		
		$url			= 'http://training.opencloudcrm.in/sites/all/modules/civicrm/extern/rest.php';
		//$parameters		= 'api_key=abcdefghi&key=a909bb04bc2a61a5ce7f57822626a24e&json=1&debug=1&version=3&entity=Contact&action=get&first_name=Keshav';
		$parameters = [
			'api_key'	=>	'abcdefghi',
			'key'		=>	'a909bb04bc2a61a5ce7f57822626a24e',
			'json'		=>	1,
			'debug'		=>	1,
			'version'	=>	3,
			'entity' 	=> 'Contact',
			'action'	=> 'get',
			//'sort_name'	=> '',
			//'email'		=> $params['email'],
		];
		$method			= 'POST';
		
		//echo $url; exit;
		$response	= $this->call_rest_webservice($url, $parameters, $method, 1);
		return $response;
		//exit;
	}
	
	
	
	public function call_rest_webservice($url, $parameters, $method, $returnFlag=0){
		$response	= $this->curl_request($url, $parameters, $method='GET');
		//print_r($response);exit;
		
		// handling errors
		$decoded_response	= json_decode($response);
		//echo "<pre>"; print_r($decoded_response); echo "</pre>"; exit;
		
		if($decoded_response->is_error == 1){
			$response				= 'Some error occured';
			
			if(isset($decoded_response->error_message) && $decoded_response->error_message != '')
				$response	.= '<br />ERROR : ' . $decoded_response->error_message;
			if(isset($decoded_response->error_code) && $decoded_response->error_code != '')
				$response 	.= '<br />[ERROR_CODE : ]' . $decoded_response->error_code;
		}
		
		//debug($decoded_response->values); exit;
		//echo "<pre>"; print_r($response); echo "</pre>"; exit;
		
		if($returnFlag == 1)
			return json_encode($decoded_response->values);
		else
			return $response;
		
	}
	
	
	
	
	function curl_request($url, $parameters, $method='GET'){
		//print_r($parameters); exit;
		$params	=   http_build_query($parameters);
		//$params		= $parameters;
		//echo $params;
		//exit;
		if($method == 'GET')
			$url	.= '?' . $params;	
	
		// create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);
				
		if($method == 'POST'){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
		}

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		
        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch); 
		
		//echo "<pre>"; print_r($output); echo "</pre>"; exit;
		return $output;
	} 
        
/**
 * Webservice Consume End
 */         
        
/*	public function datatableupdate(Request $request) {
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
/*   public function create()
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
            	    
		/*	$orders = Option::select(array(
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
		*/
    
    
    
     
    

}
