<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\Role;
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
            //$users = User::all();
			$users = User::with(['role'])->get();
        } else {
			$users = User::with(['role'])
					->where('id', '!=', $superAdminDetail->id)
					->get();
        }

        //echo'<pre>';print_r($users->toArray());die;
        return view('user.user.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
		$title = "User";

        $roles = DB::table('tbl_role')
                    ->pluck('role_name', 'id');
		
        //echo'<pre>';print_r($roles);die;
        return view('user.user.create', compact('title', 'roles'));
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
            'role' => 'required|integer',
            'user_name' => 'required|min:6|max:15|unique:users',
            #'user_name' => 'required|min:6|max:15|unique:users,user_name,NULL,NULL,app_id,'.$data['client'],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            #'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            #'name' => 'required|alpha',
			'name' => 'required',
            #'last_name' => 'alpha',
             'status' => 'required|boolean',
        );
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/user/create')->withErrors($validator)->withInput();
        } else {
            $user = new User;
            $user->role_id 		= $request->get('role');
            $user->user_name 	= $request->get('user_name');
            $user->email 		= $request->get('email');
            $user->password 	= bcrypt($request->get('password'));
            $user->name 		= $request->get('name');
            $user->status 		= $request->get('status');
            $user->created_by 	= Auth::user()->id;
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

        $roles = DB::table('tbl_role')
                    ->pluck('role_name', 'id');
					
        //dd($user);
        //return view('user::user.edit', compact('title', 'user', 'clients', 'roles', 'states', 'cities'));
		return view('user.user.edit', compact('title', 'user', 'roles'));
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
            'role' 		=> 'required|integer',
            'user_name' => 'required|min:6|max:15||unique:users,user_name,' . $id,
            'email' 	=> 'required|email|unique:users,email,' . $id,
            'password' 	=> 'min:6',
            'name' 		=> 'required',
            'status' 	=> 'required|boolean',
        );
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/user/' . $id . '/edit')->withErrors($validator)->withInput();
        } else {
            $user = User::find($id);
            $user->role_id = $request->get('role');
            $user->user_name = $request->get('user_name');
            $user->email = $request->get('email');
            if (!empty($request->get('password'))) {
                $user->password = bcrypt($request->get('password'));
            }
            $user->name = $request->get('name');
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
