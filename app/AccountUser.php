<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountUser extends MyModel
{
    //
    protected $table="admin";
   // protected $uniqueColumn="fullname";
    protected $uniqueColumn="email";


}
