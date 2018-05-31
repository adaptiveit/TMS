<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Role;
use App\Models\Privilege;
use App\Models\User;
use Auth;
use Validator;
use DB;
use AdminHelper;

class RoleController extends Controller {

    /**
     * Instantiate a new RoleController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('admin');
        $this->middleware('acl:role_add', ['only' => ['create', 'store']]);
        $this->middleware('acl:role_edit', ['only' => ['edit', 'update']]);
        $this->middleware('acl:role_delete', ['only' => ['destroy']]);
        $this->middleware('acl:role_list', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$title = "Role";
        $superAdminDetail = AdminHelper::superAdminDetail();
        $roles = Role::all();
        return view('user.role.index', compact('title', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = "Role";

        $privileges = Privilege::orderBy('module_id', 'ASC')->get();
		
		//echo'<pre>';print_r($privileges);die;
        return view('user.role.create', compact('title', 'privileges'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        #dd($data);
        $rules = array(
            'client' => 'required',
            'role_name' => 'required|unique:tbl_role,role_name,NULL,NULL,app_id,' . $data['client'],
            'role_privilage' => 'required',
            'status' => 'required',
        );
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/role/create')->withErrors($validator)->withInput();
        } else {
            $role = new Role;
            $role->app_id = $data['client'];
            $role->role_name = $data['role_name'];
            $role->status = $data['status'];
            $role->created_by = Auth::user()->id;
            $role->save();

            if (!empty($role->id)) {
                foreach ($data['role_privilage'] as $key => $privilege) {
                    $privilages[$key]['role_id'] = $role->id;
                    $privilages[$key]['privilege_id'] = $privilege;
                    $privilages[$key]['created_at'] = date('Y-m-d H:i:s');
                    $privilages[$key]['created_by'] = Auth::user()->id;
                }
                DB::table('tbl_role_privilage')->insert($privilages);
            }
            // redirect
            $request->session()->flash('alert-success', 'Role successfully created!');
            return redirect('admin/role');
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
        $title = "Role";
        $role = Role::find($id);

        $rolePrivileges = Role::getRolePrivilegesId($id);

        $client = ['' => 'Select'];
        $clients = DB::table('tbl_app')->pluck('app_name', 'id');
        $clients = $client + $clients;
        #echo'<pre>';print_r($clients);die;
        $privileges = Privilege::orderBy('module_id', 'ASC')->get();

        return view('user::role.edit', compact('title', 'role', 'clients', 'privileges', 'rolePrivileges'));
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
            'role_name' => 'required|unique:tbl_role,role_name,' . $id . ',id,app_id,' . $data['client'],
            'role_privilage' => 'required',
            'status' => 'required',
        );
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/role/' . $id . '/edit')->withErrors($validator)->withInput();
        } else {
            $role = Role::findOrFail($id);
            $role->role_name = $data['role_name'];
            $role->status = $data['status'];
            $role->updated_by = Auth::user()->id;
            $role->save();

            $rolePrivileges = Role::getRolePrivilegesId($id);

            if ($data['role_privilage'] != $rolePrivileges) {
                /* Delete role privilege */
                DB::table('tbl_role_privilage')
                        ->where('role_id', '=', $id)
                        ->delete();
                foreach ($data['role_privilage'] as $key => $privilege) {
                    /* Insert role privilege */
                    $privilages[$key]['role_id'] = $id;
                    $privilages[$key]['privilege_id'] = $privilege;
                    $privilages[$key]['created_at'] = date('Y-m-d H:i:s');
                    $privilages[$key]['created_by'] = Auth::user()->id;
                }
                DB::table('tbl_role_privilage')->insert($privilages);
            }
            // redirect
            $request->session()->flash('alert-success', 'Role successfully updated!');
            return redirect('admin/role');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = DB::table('users')
                ->where('role_id', '=', $id)
                ->get();
        if ($user) {
            return redirect('admin/role')->withErrors('First delete associated users then delete this role.');
        }
        $role = Role::find($id);
        $role->delete();

        DB::table('tbl_role_privilage')
                ->where('role_id', '=', $id)
                ->delete();

        // redirect
        $request->session()->flash('alert-success', 'Role successfully deleted!');
        return redirect('admin/role');
    }

}
