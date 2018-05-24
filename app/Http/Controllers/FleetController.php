<?php

namespace App\Http\Controllers;

//use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Fleet;
use Auth;
use Validator;

class FleetController extends Controller {

    /**
     * Instantiate a new RoleController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('admin');
        $this->middleware('acl:fleet_add', ['only' => ['create', 'store']]);
        $this->middleware('acl:fleet_edit', ['only' => ['edit', 'update']]);
        $this->middleware('acl:fleet_delete', ['only' => ['destroy']]);
        $this->middleware('acl:fleet_list', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $title = "Fleet";
        // get all the nerds
        $limit = config('admin.record_per_page');
        #$clients = Client::paginate($limit);
        $fleets = Fleet::all();
		//dd($fleets);
        return view('fleet.index', compact('title', 'fleets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = "Fleet";

        return view('fleet.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $rules = array(
            'app_name' => 'required|max:255',
            'app_key' => 'required',
        );
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('fleet/create')->withErrors($validator)->withInput();
        } else {
            $client = new Client;
            $client->app_name = $data['app_name'];
            $client->app_key = $data['app_key'];
            $client->created_by = Auth::user()->id;
            $client->save();

            // redirect
            $request->session()->flash('alert-success', 'Client successfully created!');
            return redirect('fleet');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $title = "Fleet";
        $fleet = Fleet::find($id);
        return view('fleet.edit', compact('title', 'Fleets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = $request->all();
        $rules = array(
            'app_name' => 'required|max:255',
            'app_key' => 'required',
        );
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('fleet/' . $id . '/edit')->withErrors($validator)->withInput();
        } else {
            $fleet = Fleet::findOrFail($id);
            $fleet->app_name = $data['app_name'];
            $fleet->app_key = $data['app_key'];
            $fleet->updated_by = Auth::user()->id;
            $fleet->save();

            // redirect
            $request->session()->flash('alert-success', 'Fleet successfully updated!');
            return redirect('fleet');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $fleet = Fleet::findOrFail($id);
        $fleet->delete();

        // redirect
        $request->session()->flash('alert-success', 'Fleet successfully deleted!');
        return redirect('fleet');
    }

}
