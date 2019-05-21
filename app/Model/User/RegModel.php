<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class RegModel extends Model
{
    public $table="reg";
    public $timestamps = false;
    protected $primaryKey="r_id";

}
