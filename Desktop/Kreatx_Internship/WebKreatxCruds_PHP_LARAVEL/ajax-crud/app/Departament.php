<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    protected $fillable=[
        'first_name','parent_id'
    ];

    public $table = "table_departament";
    public function childs() {
        return $this->hasMany('App\Departament','parent_id','id') ;
}
}
