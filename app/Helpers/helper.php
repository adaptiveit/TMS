<?php

namespace App\Helpers;

use Auth;
use DB;
use App\Models\Role;
use App\Models\User;

class Helper {

    public static function getAdminMenu($parent = 0, $level = 0) {

        #echo'<pre>';print_r($moduleIds);die;
        $result = DB::table('tbl_module as m')
                ->leftJoin(DB::raw('(SELECT parent_id, COUNT(*) AS Count FROM tbl_module GROUP BY parent_id) as  pm'), function( $join ) {
                    $join->on('m.id', '=', 'pm.parent_id');
                })
                ->where('m.parent_id', '=', $parent)
                ->orderBy('m.position', 'ASC')
                ->get();
				
			//dd($result);
			//$result	= array();

        $navClass = $level == 0 ? 'nav' : 'nav nav-second-level';
        $navId = $level == 0 ? 'side-menu' : '';

        echo '<ul class="' . $navClass . '" id="' . $navId . '">';
        foreach ($result as $row) {
            $isMenuAllowed = Self::isMenuAllowed(Auth::user()->role_id, $row->id);

            if ($row->Count > 0 && $isMenuAllowed) {
                echo '<li><a href="' . url($row->url) . '">' . $row->fa_class . '&nbsp;' . $row->module_name . '<span class="fa arrow"></span></a>';
                Self::getAdminMenu($row->id, $level + 1);
                echo '</li>';
            } elseif ($row->Count == 0 && $isMenuAllowed) {
                echo '<li><a href="' . url($row->url) . '">' . $row->fa_class . '&nbsp;' . $row->module_name . '</a></li>';
            }
        }
        echo "</ul>";
    }

    /**
     * Get the module's ids.
     *
     * @param  int  $roleId
     * @param  int  $privilegeStatus optional
     * @return array
     */
    public static function isMenuAllowed($roleId, $moduleId) {
        $sql = DB::table('tbl_role_privilage');
        $sql->join('tbl_privilege', 'tbl_privilege.id', '=', 'tbl_role_privilage.privilege_id');
        $sql->join('tbl_module', 'tbl_module.id', '=', 'tbl_privilege.module_id');
        $sql->where('tbl_role_privilage.role_id', $roleId);
        #$sql->where('tbl_module.id', $moduleId);
        #$sql->orWhere('tbl_module.parent_id', $moduleId);
        $sql->where(function($query) use ($moduleId) {
            $query->where('tbl_module.id', $moduleId)
                    ->orWhere('tbl_module.parent_id', $moduleId);
        });

        $sql->select('*');

        $results = $sql->get();
        #echo $sql->toSql();die;

        if (count($results) > 0)
            return true;
        else
            return false;
    }

    /**
     * Check authenticated user permission.
     *
     * @param  int  $roleId
     * @return boolean
     */
    public static function checkPermission($permission) {
        $user = new User;
        if ($user->can($permission)) {
            return true;
        }
        return false;
    }

    /**
     * Check authenticated user is SuperAdmin.
     *
     * @param  int  $userId
     * @return boolean
     */
    public static function isSuperAdmin() {
        $superAdminUserId = self::getConfigurationValue('superAdminUserId');
        if (Auth::user()->id == $superAdminUserId) {
            return true;
        }
        return false;
    }

    /**
     * Check authenticated user is SuperAdmin.
     *
     * @param  int  $userId
     * @return boolean
     */
    public static function superAdminDetail() {
        $superAdminUserId = self::getConfigurationValue('superAdminUserId');
        $user = User::find($superAdminUserId);
        return $user;
    }

    /**
     * Get a single configuration value
     *
     * @param string $key
     * @param int $app_id
     * @return string Value
     */
    public static function getConfigurationValue($key, $app_id = null) {
        $sql = DB::table('tbl_app_configuration');
        $sql->where('config_name', $key);
        if ($app_id) {
            $sql->where('app_id', $app_id);
        }
        $results = $sql->pluck('config_value');

        if (isset($results[0]))
            return $results[0];

        return false;
    }

}
