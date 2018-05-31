<?php

//namespace Modules\Admin\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Auth;
//use DB;		// this is required when u need to write queries from db

class Fleettype extends Model {

    protected $table = 'tbl_fleet_type_master';
    protected $fillable = ['fleet_type_id', 'fleet_type', 'incharge_id', 'status', 'created_by','updated_at'];
    
}
