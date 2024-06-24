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
	<title>Daftar MHS</title>
</head>
<body>
	<h1>Daftar Mahasiswa</h1>
	<a href="tambah.php">Tambah mahasiswa</a>
	<a href="logout.php">Logout</a>
	<br><br>

	<form action="" method="post">
		<input type="text" name="keyword" size="40" placeholder="masukan keyword pencarian..." autocomplete="off" autofocus>
		<input type="submit" name="cari" value="Cari!">
	</form>
	<br>

	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>#</th>
			<th>Gambar</th>
			<th>Nama</th>
			<th>Aksi</th>
		</tr>
		<?php
			require "functions.php";

			$sql = "SELECT * FROM user";
			$mhs = $sql;

			if (isset($_POST['cari'])) {
				$mhs = cariMHS($_POST['keyword']);
				
			} else {
				$mahasiswa = query("SELECT * FROM user");
			}
		?>

	</table>
</body>
</html>