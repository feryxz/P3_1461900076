<!DOCTYPE html>
<html>
<style>
	input[type=text],
	select {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}

	button {
		width: 100%;
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}

	button:hover {
		background-color: #45a049;
	}

	div {
		border-radius: 5px;
		background-color: #f2f2f2;
		padding: 20px;
	}
</style>

<body>

	<h3>Tambah Data</h3>

	<div>
		<form action="{{ route('buku.store') }}" method="POST">
			@csrf
			<label for="judul">Judul</label>
			<input type="text" id="judul" name="judul" placeholder="Judul..">

			<label for="tahun">Tahun Terbit</label>
			<input type="text" id="tahun" name="tahun" placeholder="Tahun Terbit..">

			<!-- <label for="jurusan">Jurusan</label>
			<input type="text" id="jurusan" name="jurusan" placeholder="Jurusan.."> -->

			<button type="submit" value="Submit">Simpan</button>
		</form>
	</div>

</body>

</html>