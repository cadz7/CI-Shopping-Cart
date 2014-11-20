<h2>Users</h2>
<table class="table table-hover">
<style>
	input { display: block;}
	a {
		color: white;
	}
	a:hover {
		color: white;
	}
	tr:hover {
		background: rgb(74, 118, 168) !important;
	}
</style>
<?php  
		echo "<tr><th>User ID</th><th>First Name</th><th>Last Name</th><th>User Name</th>";
		echo "<th>Password</th><th>Email</th><th>Delete</th></tr>";
		
		foreach ($users as $user) {
			echo "<tr>";
			echo "<td>" . $user['id'] . "</td>";
 			echo "<td>" . $user['first'] . "</td>";
 			echo "<td>" . $user['last'] . "</td>";
 			echo "<td>" . $user['login'] . "</td>";
 			echo "<td>" . $user['password'] . "</td>";
 			echo "<td>" . $user['email'] . "</td>";

 			$id = $user['id'];
 			$login = $user['login'];
 			if ($login != 'admin'){
 				echo "<td>" . anchor("admin/deleteUser/$id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
 			}
 			else{
 				echo "<td>Admin</td>";
 			}
				
			echo "</tr>";
		}
?>

</table>