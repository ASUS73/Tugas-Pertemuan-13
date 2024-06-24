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
	<title>Tambah mhs</title>
</head>
<body>
	<h1>Form tambah data mahasiswa</h1>

	<form action="" method="post">
		<?php
			require "functions.php";

			if (isset($_POST['submit'])) {
				if (tambahMHS($_POST) > 0) {
					echo "
						<script>
							alert('data berhasil ditambahkan!');
							document.location.href = 'index.php';
						</script>
					";
				} else {
					echo "data gagal ditambahkan!";
				}
			}
		?>
		<table>
			<tr>
				<td>Gambar</td>
				<td>:</td>
				<td>
					<input type="text" name="gambar">
				</td>
			</tr>
			<tr>
				<td>NIM</td>
				<td>:</td>
				<td>
					<input type="text" name="nim">
				</td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>
					<input type="text" name="nama">
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>:</td>
				<td>
					<input type="email" name="email">
				</td>
			</tr>
			<tr>
				<td>Program Studi</td>
				<td>:</td>
				<td>
					<input type="text" name="prodi">
				</td>
			</tr>
		</table>
		<br>
		<input type="submit" name="submit" value="Submit">
		<a href="index.php">Cancel</a>
	</form>
</body>
</html>