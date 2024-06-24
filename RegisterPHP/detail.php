<?php
	session_start();

	if (!isset($_SESSION['login'])) {
		header("Location: login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Detail MHS</title>
</head>
<body>
	<h1>Detail Mahasiswa</h1>

	<ul>
		<?php
			require "functions.php";
			$id_mhs = $_GET['id'];
			$mahasiswa = queryGet("SELECT * FROM user WHERE id_mhs='$id_mhs'");
		?>
	</ul>
</body>
</html>