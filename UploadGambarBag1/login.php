<?php
	require "functions.php";
	session_start();

	if (isset($_SESSION['login'])) {
		header("Location: index.php");
		exit();
	}

	if (isset($_POST['submit'])) {
		$login = login($_POST);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>
	<h3>Form Login</h3>

	<?php if (isset($login['error'])) { ?>
		<p style="background-color: red; color: white; border-radius: 5px; width: 180px;"><?php echo $login['pesan']; ?></p>
	<?php } ?>

	<form action="" method="post">
		<table>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td>
					<input type="text" name="username" autofocus autocomplete="off" required>
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td>
					<input type="password" name="password" required>
				</td>
			</tr>
		</table>
		<div>
			<input type="submit" name="submit" value="Submit">
			<a href="registerasi.php">Tambah petugas baru</a>
		</div>
	</form>
</body>
</html>