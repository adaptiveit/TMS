<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model {

    protected $table = 'tbl_role';
    protected $fillable = ['role_name', 'status', 'created_by', 'updated_by'];

    /**
     * Get the role's privileges.
     *
     * @param  int  $roleId
     * @param  int  $privilegeStatus optional
     * @return array
     */
    public static function getRolePrivileges($roleId, $privilegeStatus = null) {
        $sql = DB::table('tbl_role_privilage');
        $sql->join('tbl_privilege', 'tbl_privilege.id', '=', 'tbl_role_privilage.privilege_id');
        $sql->where('tbl_role_privilage.role_id', $roleId);
        if ($privilegeStatus != null) {
            $sql->where('tbl_privilege.status', $privilegeStatus);
        }
        $sql->select('*');
        $results = $sql->get();

        return $results;
    }

    /**
     * Get the role's privileges id.
     *
     * @param  int  $roleId
     * @param  int  $privilegeStatus optional
     * @return array
     */
    public static function getRolePrivilegesId($roleId, $privilegeStatus = null) {
        $rolePrivileges = self::getRolePrivileges($roleId, $privilegeStatus);
        $all_data = array();
        foreach ($rolePrivileges as $rp) {
            $all_data[] = $rp->id;
        }

        return $all_data;
    }

    /*
      |--------------------------------------------------------------------------
      | Relationship Methods
      |--------------------------------------------------------------------------
     */

    /**
     * many-to-many relationship method.
     *
     * @return QueryBuilder
     */
    public function users() {
        //return $this->belongsToMany('App\Models\User');
		return $this->hasMany('App\Models\User');
    }

    /**
     * many-to-many relationship method.
     *
     * @return QueryBuilder
     */
    public function permissions() {
        return $this->belongsToMany('App\Models\Privilege');
    }

}
