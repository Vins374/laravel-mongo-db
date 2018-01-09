<form action='add-user-process' method="post">
	<label> Name </label>
	<input type="text" name="name">
	<br>
	<label> Email </label>
	<input type="text" name="email">
	<br>
	<button type="submit"> Submit </button>
	<br>
	<a href="/get-users"> View All Users </a>

	<!-- <br>
	<a href="/add-car"> Add Car </a> -->

	 {{ csrf_field() }}
</form>