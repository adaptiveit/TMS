<?php

//namespace Modules\Admin\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Auth;
//use DB;		// this is required when u need to write queries from db

class Group extends Model {

    protected $table = 'tbl_option_group';
    protected $fillable = ['id','name', 'title', 'description', 'is_reserved','status','is_locked', 'created_by','updated_by'];
    
}
