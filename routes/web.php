<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/get-users', 'SiteController@getUsers');

Route::get('/add-user', 'SiteController@addUser');

Route::get('/add-user-form', 'SiteController@addUserForm');

Route::post('/add-user-process', 'SiteController@addUserProcess');

Route::get('/delete-user','SiteController@deleteUser');

Route::get('/delete-user-id/{id}','SiteController@deleteUserId');

Route::get('/edit-user-form/{id}', 'SiteController@editUserForm');

Route::get('/get-collections','SiteController@getCollectionNames');

Route::post('/edit-user-process', 'SiteController@editUserProcess');

Route::get('/get-user/{id}', 'SiteController@getUser');

// Add Car

Route::get('/add-car-form/{id}', 'SiteController@addCar');
Route::post('/add-car-process', 'SiteController@addCarProcess');

Route::get('/heartbeat', function () {
    try {
        $client = DB::getMongoClient();
        $db = DB::getMongoDB();
        $collection_names =[];
        $collections = $db->listCollections();
        $laravel = app();
        if($collections){
            foreach ($collections as $collection) {
                array_push($collection_names, $collection);
            }
        return array('status'=>true,
                    "code"=> 200,
                    'data'=>array("Laravel Version"=> $laravel::VERSION, 
                                "PHP Version"=>phpversion(),
                                'MongoDb Path'=>(string)$client,
                                "Tables in this DB" => $collection_names,
                                'Base Collection Name'=>(string)$db),
                    "error"=>"");
        }
    } catch (\Exception $e) {
        return array('status'=>false,
                     'code'=>502, 
                     'data'=>array("Laravel Version"=> $laravel::VERSION, 
                                    "PHP Version"=>phpversion(),
                                    'MongoDb Path'=>(string)$client,
                                    "Tables in this DB" =>'',
                                    'Base Collection Name'=>(string)$db),
                     'error'=>$e->getMessage());
    }
});