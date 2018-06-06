<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
	protected $table = 'tbl_supplier_master';
    protected $fillable = ['id','supplier_name', 'address', 'contact_person', 'telephone', 'remarks', 'status',  'created_by', 'updated_by' ];
}
