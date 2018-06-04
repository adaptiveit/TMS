<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Option;
class AjaxAutocompleteController extends Controller
{
    public function index(){        
        return view('autocomplete');
    }
    public function searchResponse(Request $request){
		 //$data = $request->all();
        $searchquery = $request->searchquery;
       // print_r( $searchquery);exit;
        $data = Option::where('name','like','%'.$searchquery.'%')->get();
       //print_r($data);exit;

        return response()->json($data);
    }
}
