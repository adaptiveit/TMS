<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class User extends Model {

    //protected $table = 'tbl_user';
    protected $fillable = ['id', 'role_id', 'name', 'email', 'user_name', 'password', 'status', 'created_by'];

    /*
      |--------------------------------------------------------------------------
      | ACL Methods
      |--------------------------------------------------------------------------
     */

    /**
     * Checks a Permission
     *
     * @param  String permission Slug of a permission (i.e: manage_user)
     * @return Boolean true if has permission, otherwise false
     */
    public function can($permission = null) {
        return !is_null($permission) && $this->checkPermission($permission);
    }

    /**
     * Check if the permission matches with any permission user has
     *
     * @param  String permission slug of a permission
     * @return Boolean true if permission exists, otherwise false
     */
    protected function checkPermission($perm) {
        $permissions = $this->getAllPernissionsFormAllRoles();
		//echo "<pre>"; print_r($permissions); die;
        $permissionArray = is_array($perm) ? $perm : [$perm];
        return count(array_intersect($permissions, $permissionArray));
    }

    /**
     * Get all permission slugs from all permissions of all roles
     *
     * @return Array of permission slugs
     */
    protected function getAllPernissionsFormAllRoles() {
        $permissionsArray = [];
        #$permissions = $this->roles->load('permissions')->fetch('permissions')->toArray(); //original code when use user_role table
        $permissions = $this->getRolePrevilagesl(Auth::user()->role_id);
        //echo'<pre>';print_r($permissions);
        return array_map('strtolower', array_unique(array_flatten(array_map(function ($permission) {
                                    return array_get($permission, 'privilege_slug');
                                }, $permissions))));
    }

    /*
      |--------------------------------------------------------------------------
      | Relationship Methods
      |--------------------------------------------------------------------------
     */

    /**
     * Many-To-Many Relationship Method for accessing the User->roles
     *
     * @return QueryBuilder Object
     */
    public function role() {
        //return $this->belongsToMany('App\Models\Role');
		return $this->belongsTo('App\Models\Role');
    }

    function getRolePrevilagesl($roleId) {
        $data = DB::table('tbl_privilege')
                ->where('tbl_privilege.status', 1)
                ->where('tbl_role_privilage.role_id', '=', $roleId)
                ->join('tbl_role_privilage', 'tbl_role_privilage.privilege_id', '=', 'tbl_privilege.id')
                ->get(['tbl_privilege.id', 'tbl_privilege.module_id', 'tbl_privilege.privilege_name', 'tbl_privilege.privilege_slug', 'tbl_privilege.url', 'tbl_privilege.status', 'tbl_privilege.created_at', 'tbl_privilege.updated_at', 'tbl_privilege.created_by', 'tbl_privilege.updated_by'])->toArray();
		
		//echo "<pre>"; print_r($data); exit;
		$arrayData	= array();
		//if(is_array($data)){
			$arrayData = array_map(function($item) {
				return (array) $item;
			}, $data);
		//}
		//dd($arrayData);
        return $arrayData;
    }

}
