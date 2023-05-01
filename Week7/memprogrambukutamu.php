<!DOCTYPE html>
<html>
<head>
	<title>Buku Tamu</title>
</head>
<body>
	<h1>Buku Tamu</h1>

	<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "buku_tamu";
	// koneksikan ke database
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// cek koneksi
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// cek apakah form tambah data disubmit
	if(isset($_POST['submit'])) {
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$isi = $_POST['isi'];

		// query untuk menambahkan data
		$sql = "INSERT INTO buku_tamu (Nama, Email, Isi) VALUES ('$nama', '$email', '$isi')";

		if(mysqli_query($conn, $sql)) {
			echo "<p>Data berhasil ditambahkan.</p>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}

	// cek apakah form hapus data disubmit
	if(isset($_POST['hapus'])) {
		$id_bt = $_POST['id_bt'];

		// query untuk menghapus data
		$sql = "DELETE FROM buku_tamu WHERE ID_BT='$id_bt'";

		if (mysqli_query($conn, $sql)) {
			echo "<p>Data berhasil dihapus.</p>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}

	// cek apakah form ubah data disubmit
	if(isset($_POST['ubah'])) {
		$id_bt = $_POST['id_bt'];
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$isi = $_POST['isi'];

		// query untuk mengubah data
		$sql = "UPDATE buku_tamu SET Nama='$nama', Email='$email', Isi='$isi' WHERE ID_BT='$id_bt'";

		if (mysqli_query($conn, $sql)) {
			echo "<p>Data berhasil diubah.</p>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}

	// query untuk menampilkan data
	$sql = "SELECT * FROM buku_tamu ORDER BY ID_BT DESC";
	$result = mysqli_query($conn, $sql);
	?>

	<!-- form tambah data -->
	<form action="" method="POST">
		<label for="nama">Nama:</label><br>
		<input type="text" id="nama" name="nama"><br>

		<label for="email">Email:</label><br>
		<input type="email" id="email" name="email"><br>

		<label for="isi">Isi Pesan:</label><br>
		<textarea id="isi" name="isi"></textarea><br>

		<input type="submit" name="submit" value="Tambah Data">
	</form>

    <tr>

    <form method="POST" action="hapus_data.php">
    <label>ID Data yang akan dihapus:</label>
    <input type="text" name="id_bt">
    <input type="submit" value="Hapus Data">
    </form>

    <br>

    <form method="POST" action="ubah_data.php">
    <label>ID Data yang akan diubah:</label>
    <input type="text" name="id_bt">
    <br>
    <label>Nama:</label>
    <input type="text" name="nama">
    <br>
    <label>Email:</label>
    <input type="text" name="email">
    <br>
    <label>Isi:</label>
    <textarea name="isi"></textarea>
    <br>
    <input type="submit" value="Ubah Data">
    </form>


	<br>

	<!-- tabel data -->
	<table border="1">
		<tr>
			<th>ID</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Isi Pesan</th>
        </tr>	
        
        <?php
	if(mysqli_num_rows($result) > 0) {
		// output data dari setiap baris
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>" . $row["ID_BT"] . "</td>";
			echo "<td>" . $row["Nama"] . "</td>";
			echo "<td>" . $row["Email"] . "</td>";
			echo "<td>" . $row["Isi"] . "</td>";
			echo "</tr>";
		}
	} else {
		echo "<tr><td colspan='5'>Belum ada data.</td></tr>";
	}

	// tutup koneksi
	mysqli_close($conn);
	?>
    </table>

</body>
</html>
