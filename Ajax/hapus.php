<?php
	require "functions.php";

	if(!isset($_GET['id'])) {
		header("Location: index.php");
		exit();
	}

	$id_mhs = $_GET['id'];

	if (hapusMHS($id_mhs) > 0) {
		echo "
			<script>
				alert('data berhasil dihapus');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "data gagal dihapus";
	}
?>