<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webservice extends Model
{
    protected $table="datatables_data";
     protected $fillable = ['id','first_name', 'last_name', 'email', 'gender', 'country', 'salary', 'status', 'created_by', 'updated_by' ];
 
    
}
