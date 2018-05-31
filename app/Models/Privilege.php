<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Privilege extends Model {

    protected $table = 'tbl_privilege';
    protected $fillable = ['module_id', 'privilege_name', 'privilege_desc', 'status', 'created_by', 'updated_by'];

    public static function getModuleSelectList($parent = 0, $default = '') {
        $result = DB::table('tbl_module as m')
                ->where('m.parent_id', '=', $parent)
                ->orderBy('m.position', 'ASC')
                ->get();

        $count = count($result);

        if ($count > 0) {
            foreach ($result as $row) {
                $id = $row->id;
                $haveChild = DB::table('tbl_module as m')
                        ->where('m.parent_id', '=', $id)
                        ->count();
                if ($haveChild) {
                    echo '<optgroup label="' . $row->module_name . '">';
                    self::getModuleSelectList($id, $default);
                    echo '</optgroup>';
                } else {
                    $selected = ($default == $id ? 'selected="selected"' : '');
                    echo "<option value=" . $id . " " . $selected . " >" . $row->module_name . "</option>";
                }
            }
        }
    }

    /*
      |--------------------------------------------------------------------------
      | Relationship Methods
      |--------------------------------------------------------------------------
     */

    /**
     * many-to-many relationship method
     *
     * @return QueryBuilder
     */
    public function roles() {
        return $this->belongsToMany('App\Models\Role');
    }

}
