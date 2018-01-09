@php
error_reporting(0);
@endphp
<form action='/add-car-process' method="post">

	Username : {{ $user->name }}
	<br>

	Email : {{ $user->email }}
	<br>
	@if(count($user->cars)>0)
	Available Cars {{ count($user->cars) }}<br>

	
 	@foreach ($user->cars as $key => $value) 
 		{{ $value['car_name'] }}
 		<br>
 	@endforeach
 	@endif

	<label> Enter Car Name </label>
	<input type="text" name="car_name">
	<input type="hidden" name="user_id" value="{{ $user->_id }}">
	<button type="submit"> Submit </button>
	<br>
	<a href="/get-users"> View All Users </a>

	<!-- <br>
	<a href ="/add-car"> Add Car </a> -->

	 {{ csrf_field() }}
</form>