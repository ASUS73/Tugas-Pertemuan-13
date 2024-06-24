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
	<h1>Form edit data mahasiswa</h1>

	<form action="" method="post">
		<?php
			include "databases/db.php";
			require "functions.php";

			if(!isset($_GET['id'])) {
				header("Location: index.php");
				exit();
			}

			$id_mhs = $_GET['id'];
			$sql = "SELECT * FROM user WHERE id_mhs='$id_mhs'";
			$result = mysqli_query($connect, $sql);
			$row = mysqli_fetch_assoc($result);

			$id_mhs = $row['id_mhs'];
			$gambar_mhs = $row['gambar_mhs'];
			$nim_mhs = $row['nim_mhs'];
			$nama_mhs = $row['nama_mhs'];
			$email_mhs = $row['email_mhs'];
			$prodi = $row['prodi'];

			if (isset($_POST['submit'])) {
				if (editMHS($_POST) > 0) {
					echo "
						<script>
							alert('data berhasil edit!');
							document.location.href = 'index.php';
						</script>
					";
				} else {
					echo "data gagal edit!";
				}
			}
		?>
		<input type="hidden" name="id" value="<?php echo $id_mhs; ?>">
		<table>
			<tr>
				<td>Gambar</td>
				<td>:</td>
				<td>
					<input type="text" name="gambar" value="<?php echo $gambar_mhs; ?>">
				</td>
			</tr>
			<tr>
				<td>NIM</td>
				<td>:</td>
				<td>
					<input type="text" name="nim" value="<?php echo $nim_mhs; ?>">
				</td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>
					<input type="text" name="nama" value="<?php echo $nama_mhs; ?>">
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>:</td>
				<td>
					<input type="email" name="email" value="<?php echo $email_mhs; ?>">
				</td>
			</tr>
			<tr>
				<td>Program Studi</td>
				<td>:</td>
				<td>
					<input type="text" name="prodi" value="<?php echo $prodi; ?>">
				</td>
			</tr>
		</table>
		<br>
		<input type="submit" name="submit" value="Edit">
		<a href="index.php">Cancel</a>
	</form>
</body>
</html>