<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Fuelstation;
use Auth;
use Validator;
use DB;
use AdminHelper;

class FuelstationController extends Controller
{

        public function index()
        {
			$title = "fuelstation";
            $fuelstation = Fuelstation::latest()->paginate(10);
            return view('fuelstation.index',compact('fuelstation','title'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
		$title = "fuelstation";

        return view('fuelstation.create', compact('title'));
        }
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
           $request_data = $request->all();
           $rules = array(
                'fuel_station' => 'required',
                'contact_person' => 'required',
                'deposit' => 'required',
                'status' => 'required');
            
           $validator = Validator::make($request_data, $rules);
           if ($validator->fails()) {
            return redirect('admin/fuelstation/create')->withErrors($validator)->withInput();
		   }
		   else{
			   $data = new Fuelstation;
			   
			   $created_by=Auth::user()->id;
			   $updated_by=Auth::user()->id;
			   
			   $data->fuel_station = $request->input('fuel_station');
			   $data->address = $request->input('address');
			   $data->contact_person = $request->input('contact_person');
			   $data->contact_number = $request->input('contact_number');
			   $data->deposit = $request->input('deposit');
			   $data->status = $request->input('status');
			   $data->created_by = $created_by;
			   $data->updated_by = $updated_by;
	       }
            $data->save();
            return redirect()->route('fuelstation.index')
                            ->with('success','Fuelstation created successfully');
        }
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show(Fuelstation $fuelstation)
        {
            //return view('fuelstations.show',compact('fuelstation'));
        }
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(Fuelstation $fuelstation)
        {
            return view('fuelstations.edit',compact('fuelstation'));
        }
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request,Fuelstation $fuelstation)
        {
            request()->validate([
                'fuel_station' => 'required',
                'contact_person' => 'required',
                'deposit' => 'required',
                'status' => 'required',
            ]);
            $fuelstation->update($request->all());
            return redirect()->route('fuelstation.index')
                            ->with('success','Fuelstation updated successfully');
        }
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            Fuelstation::destroy($id);
            return redirect()->route('fuelstation.index')
                            ->with('success','Fuelstation deleted successfully');
        }
    }
