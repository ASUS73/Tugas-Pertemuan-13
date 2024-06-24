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
			<li><img src='assets/image/".$gambar_mhs."' width='250'></li>
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

	function upload() {
		$nama_file = $_FILES['gambar']['name'];
		$tipe_file = $_FILES['gambar']['type'];
		$ukuran_file = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tmp_file = $_FILES['gambar']['tmp_name'];

		if ($error == 4) {
			// echo "
			// 	<script>
			// 		alert('pilih gambar dahulu!');
			// 		document.location.href = 'tambah.php';
			// 	</script>
			// ";

			return 'admin.png';
		}

		$daftar_gambar = ['jpg','jpeg','png'];
		$ektensi_file = explode('.', $nama_file);
		$ektensi_file = strtolower(end($ektensi_file));

		if (!in_array($ektensi_file, $daftar_gambar)) {
			echo "
				<script>
					alert('yang anda pilih bukan gambar!');
					document.location.href = 'tambah.php';
				</script>
			";

			return false;
		}

		if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
			echo "
				<script>
					alert('yang anda pilih bukan gambar!');
					document.location.href = 'tambah.php';
				</script>
			";

			return false;
		}

		if ($ukuran_file > 5000000) {
			echo "
				<script>
					alert('ukuran gambar terlalu besar!');
					document.location.href = 'tambah.php';
				</script>
			";

			return false;
		}

		$nama_file_baru = uniqid();
		$nama_file_baru .= '.';
		$nama_file_baru .= $ektensi_file;
		move_uploaded_file($tmp_file, 'assets/image/'.$nama_file_baru);

		return $nama_file_baru;
	}

	function tambahMHS($data) {
		include "databases/db.php";

		$nama = htmlspecialchars($data['nama']);
		$nim = htmlspecialchars($data['nim']);
		$email = htmlspecialchars($data['email']);
		$prodi = htmlspecialchars($data['prodi']);
		// $gambar = htmlspecialchars($data['gambar']);

		$gambar = upload();

		if (!$gambar) {
			return false;
		}

		$sql = "INSERT INTO user VALUES ('','$gambar', '$nim', '$nama', '$email', '$prodi')";

		$result = mysqli_query($connect, $sql);

		echo mysqli_error($connect);
		return mysqli_affected_rows($connect);
	}

	function hapusMHS($id) {
		include "databases/db.php";

		$sql_mhs = "SELECT * FROM user WHERE id_mhs=$id";
		$result_mhs = mysqli_query($connect, $sql_mhs);
		$row = mysqli_fetch_assoc($result_mhs);

		if ($row['gambar_mhs'] != 'admin.png') {
			unlink('assets/image/'.$row['gambar_mhs']);
		}



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
		$gambar_lama = htmlspecialchars($data['gambar_lama']);

		$gambar = upload();

		if (!$gambar) {
			return false;
		}

		if ($gambar == 'admin.png') {
			$gambar = $gambar_lama;
		}

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

		echo "
			<table border='1' cellpadding='10' cellspacing='0'>
			<tr>
				<th>#</th>
				<th>Gambar</th>
				<th>Nama</th>
				<th>Aksi</th>
			</tr>
		";
		
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

		echo "</table>";
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