<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends MyModel
{
    //
    protected $table="store";
    protected $uniqueColumn="name";
}
