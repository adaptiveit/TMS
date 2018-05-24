<?php

namespace Modules\Admin\Http\Controllers\User;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Modules\Admin\Models\User;
use Modules\Admin\Models\Role;
use Auth;
use Validator;
use DB;
use AdminHelper;

class UserController extends Controller {

    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('admin');
        $this->middleware('acl:user_add', ['only' => ['create', 'store']]);
        $this->middleware('acl:user_edit', ['only' => ['edit', 'update']]);
        $this->middleware('acl:user_delete', ['only' => ['destroy']]);
        $this->middleware('acl:user_list', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $title = "User";
        $superAdminDetail = AdminHelper::superAdminDetail();
        if (AdminHelper::isSuperAdmin()) {
            $users = User::all();
        } else {
            $users = User::where('app_id', '=', Auth::user()->app_id)
                    ->where('id', '!=', $superAdminDetail->id)
                    ->get();
        }

        #echo'<pre>';print_r($users->toArray());die;
        return view('admin::user.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = "User";

        $clients = DB::table('tbl_app')->pluck('app_name', 'id');

        if (AdminHelper::isSuperAdmin()) {
            $roles = DB::table('tbl_role as r')
                ->join('tbl_app as a', 'a.id', '=', 'r.app_id')
                ->selectRaw('CONCAT(r.role_name, " - ", a.app_name) as role_name, r.id')
                ->pluck('role_name', 'r.id');
        }else{
            $roles = DB::table('tbl_role')
                    ->where('app_id', '=', Auth::user()->app_id)
                    ->pluck('role_name', 'id');
        }
        
        $states = DB::table('tbl_state')->pluck('state_name', 'id');
        $cities = DB::table('tbl_city')->get();

        #echo'<pre>';print_r($cities);die;
        return view('admin::user.create', compact('title', 'clients', 'roles', 'states', 'cities'));
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
            'client' => 'required|integer',
            'role' => 'required|integer',
            'user_name' => 'required|min:6|max:15|unique:tbl_user',
            #'user_name' => 'required|min:6|max:15|unique:tbl_user,user_name,NULL,NULL,app_id,'.$data['client'],
            'email' => 'required|email|unique:tbl_user',
            'password' => 'required|min:6',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'first_name' => 'required|alpha',
            'last_name' => 'alpha',
            'state' => 'required|integer',
            'city' => 'required',
            'status' => 'required|boolean',
        );
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/user/create')->withErrors($validator)->withInput();
        } else {
            $user = new User;
            $user->app_id = $request->get('client');
            $user->role_id = $request->get('role');
            #$user->rm_id = $request->get('rm_id');
            $user->user_name = $request->get('user_name');
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('password'));
            $user->phone = $request->get('phone');
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->address = $request->get('address');
            $user->api_token = str_random(60);
            $user->device_id = $request->get('device_id');
            $user->state_id = $request->get('state');
            $user->city_id = json_encode($request->get('city'));
            $user->status = $request->get('status');
            $user->created_by = Auth::user()->id;
            $user->save();

            // redirect
            $request->session()->flash('alert-success', 'User successfully created!');
            return redirect('admin/user');
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
        $title = "User";
        $user = User::find($id);

        $clients = DB::table('tbl_app')->pluck('app_name', 'id');
        if (AdminHelper::isSuperAdmin()) {
            $roles = DB::table('tbl_role as r')
                ->join('tbl_app as a', 'a.id', '=', 'r.app_id')
                ->selectRaw('CONCAT(r.role_name, " - ", a.app_name) as role_name, r.id')
                ->pluck('role_name', 'r.id');
        }else{
            $roles = DB::table('tbl_role')
                    ->where('app_id', '=', Auth::user()->app_id)
                    ->pluck('role_name', 'id');
        }
        $states = DB::table('tbl_state')->pluck('state_name', 'id');
        $cities = DB::table('tbl_city')->get();
        ##dd($roles);
        return view('admin::user.edit', compact('title', 'user', 'clients', 'roles', 'states', 'cities'));
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
            'client' => 'required|integer',
            'role' => 'required|integer',
            'user_name' => 'required|min:6|max:15||unique:tbl_user,user_name,' . $id,
            #'user_name' => 'required|min:6|max:15|unique:tbl_user,user_name,' . $id.',id,app_id,'.$data['client'],
            'email' => 'required|email|unique:tbl_user,email,' . $id,
            'password' => 'min:6',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'first_name' => 'required|alpha',
            'last_name' => 'alpha',
            'state' => 'required|integer',
            'city' => 'required',
            'status' => 'required|boolean',
        );
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/user/' . $id . '/edit')->withErrors($validator)->withInput();
        } else {
            $user = User::find($id);
            $user->app_id = $request->get('client');
            $user->role_id = $request->get('role');
            #$user->rm_id = $request->get('rm_id');
            $user->user_name = $request->get('user_name');
            $user->email = $request->get('email');
            if (!empty($request->get('password'))) {
                $user->password = bcrypt($request->get('password'));
            }
            $user->phone = $request->get('phone');
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->address = $request->get('address');
            #$user->api_token = str_random(60);
            #$user->device_id = $request->get('device_id');
            $user->state_id = $request->get('state');
            $user->city_id = json_encode($request->get('city'));
            $user->status = $request->get('status');
            $user->updated_by = Auth::user()->id;
            $user->save();


            // redirect
            $request->session()->flash('alert-success', 'User successfully updated!');
            return redirect('admin/user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $role = User::find($id);
        $role->delete();

        // redirect
        $request->session()->flash('alert-success', 'User successfully deleted!');
        return redirect('admin/user');
    }

}
