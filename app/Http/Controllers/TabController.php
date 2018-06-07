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
		 //print_r('ggg');
       // $this->middleware('admin');
       // $this->middleware('acl:fleet_add', ['only' => ['create', 'store']]);
       // $this->middleware('acl:fleet_edit', ['only' => ['edit', 'update']]);
       // $this->middleware('acl:fleet_delete', ['only' => ['destroy']]);
        //$this->middleware('acl:fleet_list', ['only' => ['index']]);
    }


    

    
    

    
 public function form()
    {
					
	$title = $this->getActivity();
	$orders = json_decode($title, true); 
	//$title = "User";
	//print_r($title);exit;
	//return  view('tab.form')->with('title', json_decode($title, true));
    return view('tab.form',compact('orders'));
		
}		
    
    
public function list()
    {
				
	
	$title = "User";
	
    return view('tab.list',compact('title'));
        
                   
    }


public function getActivity(){
		$url			= 'http://training.opencloudcrm.in/sites/all/modules/civicrm/extern/rest.php';
		$parameters = [
			'api_key'	=>	'abcdefghi',
			'key'		=>	'a909bb04bc2a61a5ce7f57822626a24e',
			'json'		=>	1,
			'debug'		=>	1,
			'version'	=>	3,
			'entity' 	=> 'Activity',
			'action'	=> 'get',
			'email'		=> 'keshav@adaptiveit.net',
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
    
    
public function getContact(){
		$keyword	= $_REQUEST['keyword'];
		//echo $keyword; exit;
		$key_arr	= explode("::", $keyword);
		$sort_name	= trim($key_arr[0]);
		$email		= trim($key_arr[1]);
		
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
			'sort_name'	=> '',
			'email'		=> 'keshav@adaptiveit.net',
		];
		$method			= 'POST';
		
		//echo $url; exit;
		$response	= call_rest_webservice($url, $parameters, $method, 1);
		//echo $response;
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
    
     
    

}
