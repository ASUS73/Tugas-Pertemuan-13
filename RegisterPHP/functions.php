<?php
	function query($sql) {
		include "databases/db.php";
		$result = mysqli_query($connect, $sql);
		$i=1;

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$id_mhs = $row['id_mhs'];
				$gambar_mhs = $row['gambar_mhs'];
				$nim_mhs = $row['nim_mhs'];
				$nama_mhs = $row['nama_mhs'];
				$email_mhs = $row['email_mhs'];
				$prodi = $row['prodi'];

				echo "
					<tr>
						<td>".$i++."</td>
						<td><img src='assets/image/".$gambar_mhs."' width='100'></td>
						<td>".$nama_mhs."</td>
						<td>
							<a href='detail.php?id=".$id_mhs."'>Lihat detail</a>
						</td>
					</tr>
				";
			}
		}
	}

	function queryGet($sql) {
		include "databases/db.php";

		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_assoc($result);

		$id_mhs = $row['id_mhs'];
		$gambar_mhs = $row['gambar_mhs'];
		$nim_mhs = $row['nim_mhs'];
		$nama_mhs = $row['nama_mhs'];
		$email_mhs = $row['email_mhs'];
		$prodi = $row['prodi'];

		echo "
			<li><img src='assets/image/".$gambar_mhs."' width='100'></li>
			<li>".$nim_mhs."</li>
			<li>".$nama_mhs."</li>
			<li>".$email_mhs."</li>
			<li>".$prodi."</li>
			<li>
				<a href='edit.php?id=".$id_mhs."'>edit</a> | <a href='hapus.php?id=".$id_mhs."'>hapus</a>
			</li>
			<br>
			<a href='index.php'>kembali ke daftar mahasiswa</a>
		";
	}

	function tambahMHS($data) {
		include "databases/db.php";

		$nama = htmlspecialchars($data['nama']);
		$nim = htmlspecialchars($data['nim']);
		$email = htmlspecialchars($data['email']);
		$prodi = htmlspecialchars($data['prodi']);
		$gambar = htmlspecialchars($data['gambar']);

		$sql = "INSERT INTO user VALUES ('','$gambar', '$nim', '$nama', '$email', '$prodi')";

		$result = mysqli_query($connect, $sql);

		echo mysqli_error($connect);
		return mysqli_affected_rows($connect);
	}

	function hapusMHS($id) {
		include "databases/db.php";

		$sql = "DELETE FROM user WHERE id_mhs=$id";
		$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

		return mysqli_affected_rows($connect);
	}

	function editMHS($data) {
		include "databases/db.php";

		$id = $data['id'];
		$nama = htmlspecialchars($data['nama']);
		$nim = htmlspecialchars($data['nim']);
		$email = htmlspecialchars($data['email']);
		$prodi = htmlspecialchars($data['prodi']);
		$gambar = htmlspecialchars($data['gambar']);

		$sql = "UPDATE user SET gambar_mhs='$gambar', nim_mhs='$nim', nama_mhs='$nama', email_mhs='$email', prodi='$prodi' WHERE id_mhs='$id'";

		$result = mysqli_query($connect, $sql);

		echo mysqli_error($connect);
		return mysqli_affected_rows($connect);
	}

	function cariMHS($keyword) {
		include "databases/db.php";

		$sql = "SELECT * FROM user WHERE nama_mhs LIKE '%$keyword%' OR nim_mhs LIKE '%$keyword%'";
		$result = mysqli_query($connect, $sql);
		$i=1;

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$id_mhs = $row['id_mhs'];
				$gambar_mhs = $row['gambar_mhs'];
				$nim_mhs = $row['nim_mhs'];
				$nama_mhs = $row['nama_mhs'];
				$email_mhs = $row['email_mhs'];
				$prodi = $row['prodi'];

				echo "
					<tr>
						<td>".$i++."</td>
						<td><img src='assets/image/".$gambar_mhs."' width='100'></td>
						<td>".$nama_mhs."</td>
						<td>
							<a href='detail.php?id=".$id_mhs."'>Lihat detail</a>
						</td>
					</tr>
				";
			}
		}
	}

	function login($data) {
		include "databases/db.php";

		$username = htmlspecialchars($data['username']);
		$password = htmlspecialchars($data['password']);

		$sql = "SELECT * FROM petugas WHERE username='$username'";
		$result = mysqli_query($connect, $sql);
		$petugas = mysqli_fetch_array($result);

		if ($petugas) {
			if (password_verify($password, $petugas['password'])) {
				$_SESSION['login'] = true;
				header("Location: index.php");
				exit();
			}
		}
		
		return [
			"error" => true,
			"pesan" => "username/sandi anda salah!"
		];
	}

	function registerasi($data) {
		include "databases/db.php";

		$username = htmlspecialchars($data['username']);
		$password = htmlspecialchars($data['password']);
		$konfirmasi_password = htmlspecialchars($data['konfirmasi_password']);

		$sql = "SELECT * FROM petugas WHERE username = '$username'";

		if (empty($username) || empty($password) || empty($konfirmasi_password)) {
			echo "
				<script>
					alert('username/password tidak boleh kosong!');
					document.location.href = 'registerasi.php';
				</script>
			";

			return false;
		}

		if (query($sql)) {
			echo "
				<script>
					alert('username sudah ada!');
					document.location.href = 'registerasi.php';
				</script>
			";

			return false;
		}

		if ($password !== $konfirmasi_password) {
			echo "
				<script>
					alert('password tidak sama!');
					document.location.href = 'registerasi.php';
				</script>
			";

			return false;
		}

		if (strlen($password) < 5) {
			echo "
				<script>
					alert('password tidak boleh kurang dari 5 digit!');
					document.location.href = 'registerasi.php';
				</script>
			";

			return false;
		}

		$password_baru = password_hash($password, PASSWORD_DEFAULT);

		$sql_tambah = "INSERT INTO petugas VALUES (null, '$username','$password_baru')";
		$result = mysqli_query($connect, $sql_tambah);

		return mysqli_affected_rows($connect);
	}
?>