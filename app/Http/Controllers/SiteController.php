<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Cars;

class SiteController extends Controller
{
   function getUsers()
   {
   		//echo "Users";

   		$users = Users::orderBy('email','ASC')->get();

   		foreach ($users as $key => $value) {
   			echo $value->_id.' - '.$value->name.' - '.$value->email.' - <a href="/edit-user-form/'.$value->_id.'"> Edit </a> - <a href="/delete-user-id/'.$value->_id.'"> Delete </a> - <a href="/add-car-form/'.$value->_id.'"> Add Car </a> <br>';
   			// print_r($value);
   			echo "<br><br>";
   		}

         echo '<a href="/add-user-form"> Add User </a> <br>';
   }

   function getUser($id)
   {
      return Users::where("_id",$id)->first();
   }

   function addUser()
   {
   		$insert = new Users;
   		$insert->name = "New User";
   		$insert->email = "newuser@gmail.com";
   		$insert->save();

   		if($insert)
   			echo "New Record Inserted";
   		else 
   			echo "Unable to insert a record";

   }

   function deleteUser()
   {
   		Users::where("email","newuser@gmail.com")->delete();
   }

   function getCollectionNames()
   {
   		// $collections = DB::connection('mongodb')->listCollections();
   		$collections = Users::getCollectionNames();
   		print_r($collections);
   }

   function addUserForm()
   {
   		// return 
   		return view('add-user-form');
   }

   function addUserProcess()
   {
   		// print_r(request());

   		// echo request()->name;

   		if(!Users::where("email",request()->email)->first()) {
   			$insert = new Users;
	   		$insert->name = request()->name;
	   		$insert->email = request()->email;
	   		$insert->save();

	   		echo "New Record Inserted";
   		}
   		else {
   			echo "Email id already taken";
   		}

   		echo "<a href='/add-user-form'> Go Back </a>";
   }

   function deleteUserId($id)
   {
   		//echo $id;

   		if(Users::where("_id",$id)->first()) {
   			Users::where("_id",$id)->delete();
   			echo "Record deleted successfully";
   		}
   		else {
   			echo "Record not found";
   		}
   }

   function addCar($id)
   {
   		$data['user'] = Users::where("_id",$id)->first();
   		return view('add-car-form',$data);
   }

   function addCarProcess()
   {
   		// if(!Cars::where("user_id",request()->user_id)->where("car_name",request()->car_name)->first()) {

         $user = Users::where("_id",request()->user_id)->first();

         print_r($user);

         $new_cars = array();

            if(isset($user->cars)) {
               if(is_array($user->cars)) { 

                  $new_cars = $user->cars;
                  $data['car_name'] =  request()->car_name;
                  array_push($new_cars, $data);
                   $update['cars'] =  $new_cars;
                  echo "coming 1";
               }
               else {
                   $data['car_name'] =  request()->car_name;
                  array_push($new_cars, $data);
                  $update['cars'] =  $new_cars;

                  echo "coming 2";

               }
            }
            else {
                $data['car_name'] =  request()->car_name;
                array_push($new_cars, $data);
                $update['cars'] =  $new_cars;

                echo "coming 3";
            }




   			
   			Users::where("_id",request()->user_id)->update($update);

   			// $insert = new Cars;
   			// $insert->user_id = request()->user_id;
   			// $insert->car_name = request()->car_name;
   			// $insert->save();

   			echo "New Car Added";

           return redirect('/add-car-form/'.request()->user_id);

   		// }
   }

   function editUserForm($id)
   {
      $data['user'] = Users::where("_id",$id)->first();
      return view('edit-user-form',$data);
   }

   function editUserProcess()
   {
      $update['name'] = request()->name;
      $update['email'] = request()->email;
      Users::where("_id",request()->id)->update($update);
      return redirect('/get-users');
   }
}
