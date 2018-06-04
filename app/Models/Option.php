<?php

//namespace Modules\Admin\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Auth;
//use DB;		// this is required when u need to write queries from db

class Option extends Model {

    protected $table = 'tbl_option_value';
    protected $fillable = ['option_group_id', 'label', 'value', 'name','grouping','is_default', 'weight','description','is_optgroup','	is_reserved','status','component_id','visibility_id','created_by','updated_by'];
    
}
