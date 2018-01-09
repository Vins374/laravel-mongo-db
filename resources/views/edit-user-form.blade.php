<form action='/edit-user-process' method="post">
	<label> Name </label>
	<input type="text" name="name" value="{{ $user->name }}">
	<br>
	<label> Email </label>
	<input type="text" name="email" value="{{ $user->email }}">
	<br>
	<input type="hidden" name="id" value="{{ $user->_id }}">
	<button type="submit"> Submit </button>
	<br>
	<a href="/get-users"> View All Users </a>

	<!-- <br>
	<a href="/add-car"> Add Car </a> -->

	 {{ csrf_field() }}
</form>