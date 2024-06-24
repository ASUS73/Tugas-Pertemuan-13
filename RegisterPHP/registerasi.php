<?php
	require "functions.php";

	if (isset($_POST['submit'])) {
		if(registerasi($_POST) > 0) {
			echo "
				<script>
					alert('user baru berhasil ditambahkan, silahkan login!');
					document.location.href = 'login.php';
				</script>
			";
		} else {
			echo "user gagal ditambahkan";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>registerasi</title>
</head>
<body>
	<h3>Form registerasi</h3>

	<form action="" method="post">
		<table>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td>
					<input type="text" name="username" autofocus autocomplete="off">
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td>
					<input type="password" name="password">
				</td>
			</tr>
			<tr>
				<td>Konfirmasi Password</td>
				<td>:</td>
				<td>
					<input type="password" name="konfirmasi_password">
				</td>
			</tr>
		</table>
		<div>
			<input type="submit" name="submit" value="Submit">
			<a href="login.php">Masuk untuk mengakses sistem</a>
		</div>
	</form>
</body>
</html>