<?php

namespace App\Http\Controllers\User;

//use Pingpong\Modules\Routing\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Privilege;
use Auth;
use Validator;
use DB;

class PrivilegeController extends Controller {

    /**
     * Instantiate a new RoleController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('admin');
        $this->middleware('acl:privilege_add', ['only' => ['create', 'store']]);
        $this->middleware('acl:privilege_edit', ['only' => ['edit', 'update']]);
        $this->middleware('acl:privilege_delete', ['only' => ['destroy']]);
        $this->middleware('acl:privilege_list', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $title = "Privilege";
        // get all the nerds
        $limit = config('admin.record_per_page');
        #$privileges = Privilege::paginate($limit);
        $privileges = Privilege::all();

        return view('user::privilege.index', compact('title', 'privileges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = "Privilege";

        $module = ['' => 'Select'];
        $modules = DB::table('tbl_module')->where('parent_id', '>', 0)->pluck('module_name', 'id');
        $modules = $module + $modules;
        #dd($modules);

        return view('user::privilege.create', compact('title', 'modules'));
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
            'module_id' => 'required',
            'privilege_name' => 'required|max:255',
            'privilege_slug' => 'required|max:255|unique:tbl_privilege',
            'privilege_desc' => 'required',
            'url' => 'required',
            'status' => 'required',
        );
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/privilege/create')->withErrors($validator)->withInput();
        } else {
            $privilege = new Privilege;
            $privilege->module_id = $data['module_id'];
            $privilege->privilege_name = $data['privilege_name'];
            $privilege->privilege_slug = $data['privilege_slug'];
            $privilege->privilege_desc = $data['privilege_desc'];
            $privilege->url = $data['url'];
            $privilege->status = $data['status'];
            $privilege->created_by = Auth::user()->id;
            $privilege->save();

            // redirect
            $request->session()->flash('alert-success', 'Privilege successfully created!');
            return redirect('admin/privilege');
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
        $title = "Privilege";
        $privilege = Privilege::find($id);

        $module = ['' => 'Select'];
        $modules = DB::table('tbl_module')->where('parent_id', '>', 0)->pluck('module_name', 'id');
        $modules = $module + $modules;

        return view('user::privilege.edit', compact('title', 'privilege', 'modules'));
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
            'module_id' => 'required',
            'privilege_name' => 'required|max:255',
            'privilege_desc' => 'required',
            'status' => 'required',
        );
        $validator = Validator::make($data, $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('admin/privilege/' . $id . '/edit')->withErrors($validator)->withInput();
        } else {
            $privilege = Privilege::findOrFail($id);
            $privilege->module_id = $data['module_id'];
            $privilege->privilege_name = $data['privilege_name'];
            $privilege->privilege_desc = $data['privilege_desc'];
            $privilege->status = $data['status'];
            $privilege->updated_by = Auth::user()->id;
            $privilege->save();

            // redirect
            $request->session()->flash('alert-success', 'Privilege successfully updated!');
            return redirect('admin/privilege');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $rolePrivilage = DB::table('tbl_role_privilage')
                ->where('privilege_id', '=', $id)
                ->get();
        if ($rolePrivilage) {
            return redirect('admin/privilege')->withErrors('First delete role then delete this privilage.');
        }
        $privilege = Privilege::findOrFail($id);
        $privilege->delete();

        // redirect
        $request->session()->flash('alert-success', 'Privilege successfully deleted!');
        return redirect('admin/privilege');
    }

}
