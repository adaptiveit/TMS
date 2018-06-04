<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuelstation extends Model
{
	protected $table = 'tbl_fuel_station_master';
    protected $fillable = ['id','fuel_station', 'address', 'contact_person', 'contact_number', 'deposit', 'status',  'created_by', 'updated_by' ];
}
