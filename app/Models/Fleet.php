<?php

//namespace Modules\Admin\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Auth;
//use DB;		// this is required when u need to write queries from db

class Fleet extends Model {

    protected $table = 'tbl_fleet_master';
    protected $fillable = ['fleet_id', 'reg_no', 'fleet', 'fleet_type_id', 'reg_date', 'cost', 'driver_assigned_id', 'make', 'model', 'insurance_due', 'status', 'created_by'];
    
}
