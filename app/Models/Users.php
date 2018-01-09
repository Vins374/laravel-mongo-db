<?php

namespace App\Models;

use DB;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Users extends Eloquent {

    protected $collection = 'users';
    protected $connection = 'mongodb';

    public static function getAllUsers()
    {
    	return $user = DB::connection('mongodb')->collection('users')->get();
    }

    public static function getCollectionNames()
    {
    	return DB::connection('mongodb')->getCollectionNames();
    	// return DB::connection('mongodb')->getCollectionInfo();
    	return DB::connection('mongodb')->listCollections();
    }


    // function cars()
    // {
    //     return $this->hasMany('App\Models\Cars', 'user_id', '_id');   
    // }

}