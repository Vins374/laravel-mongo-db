<?php

namespace App\Models;

use DB;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Cars extends Eloquent {

    protected $collection = 'cars';
    protected $connection = 'mongodb';

}