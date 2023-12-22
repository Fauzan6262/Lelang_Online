<!DOCTYPE html>
<html lang="en">
	<head>
		<title>
			LelangCepat
		</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />
		<link rel="stylesheet" href="../assets/css/bootstrap.css"> 
		<script src="../assets/js/jquery.js"></script> 
		<script src="../assets/js/popper.js"></script> 
		<script src="../assets/js/bootstrap.js"></script>
		<style>
			/* Make the image fully responsive */
			.carousel-inner img {
				width: 100%;
				height: 100%;
			}
		</style>
	</head>
	<body style="background-color: #888888;">
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
			<a class="navbar-brand" href="index.php"><span style="font-weight: bold;">LELANG<span style="color: #FF410E;">CEPAT</span></span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<?php
					session_start();
					include '../dbconnect.php';
					if(!isset($_SESSION['id_level']))
					{
						echo"
						<script>
							alert('Tindakan ilegal...menuju ke Login');
							location.href='../index.php';
						</script>";
					}
					else
					{
						$username=$_SESSION['username'];
						$password=$_SESSION['password'];
						$level=$_SESSION['id_level'];
						$sql = "SELECT * FROM tb_petugas WHERE username='$username' AND password='$password'";
						$query = mysqli_query($conn,$sql);
						$count = mysqli_num_rows($query);
						$data = mysqli_fetch_array($query);
						
						if($level==1)
						{
							echo
							'
							<ul class="navbar-nav mr-auto">
								<li class="nav-item">
									<a class="nav-link" href="index.php">Beranda</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="data_barang.php">Data Barang</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="data_petugas.php">Data Petugas</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">Laporan</a>
								</li>
							</ul>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#Profile">
								Akun
							</button>
							';
						}
						else if($level==2)
						{
							echo
							'
							<ul class="navbar-nav mr-auto">
								<li class="nav-item">
									<a class="nav-link" href="index.php">Beranda</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="data_barang.php">Data Barang</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">Laporan</a>
								</li>
							</ul>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#Profile">
								Akun
							</button>
							';
						}
						else
						{
							echo"
							<script>
								alert('Tindakan ilegal...menuju ke Login');
								location.href='../index.php';
							</script>";
						}
					}
				?>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="alert alert-dark" style="overflow:auto;">
                <h2>Laporan</h2>
				<hr>
				<a href="../cetak_laporan.php" target="_blank">
					<button type="submit" class="btn btn-outline-primary float-right" style="margin-bottom: 10px;">Print</button>
				</a>
				<div class="table-responsive">
					<table class="table table-bordered table-dark table-striped">
                        <?php
							$querya="SELECT COUNT(*) AS barang_belum FROM tb_barang WHERE id_barang NOT IN(SELECT id_barang FROM tb_lelang)";
                            $resulta=mysqli_query($conn,$querya);
                            $dataa=mysqli_fetch_array($resulta);

                            $queryb="SELECT COUNT(*) AS barang_dilelang FROM tb_lelang WHERE status!='terlelang'";
                            $resultb=mysqli_query($conn,$queryb);
                            $datab=mysqli_fetch_array($resultb);

							$queryc="SELECT COUNT(*) AS barang_terlelang FROM tb_lelang WHERE status='terlelang'";
                            $resultc=mysqli_query($conn,$queryc);
							$datac=mysqli_fetch_array($resultc);
							
							$queryd="SELECT COUNT(*) AS total_barang FROM tb_barang";
                            $resultd=mysqli_query($conn,$queryd);
                            $datad=mysqli_fetch_array($resultd);
                        ?>
						<tbody>
							<tr class="text-center">
								<td colspan="2"><span class="h5">Laporan Barang Lelang</span></td>
							</tr>
							<tr class="text-center">
								<td>Jumlah Barang yang Belum Dilelang (Belum Dimasukan ke Data Lelang)</td>
                                <td><?php echo $dataa['barang_belum']; ?></td>
							</tr>
							<tr class="text-center">
								<td>Jumlah Barang yang Dilelang</td>
                                <td><?php echo $datab['barang_dilelang']; ?></td>
							</tr>
                            <tr class="text-center">
								<td>Jumlah Barang yang Terlelang</td>
                                <td><?php echo $datac['barang_terlelang']; ?></td>
							</tr>
                            <tr class="text-center">
								<td>Total Barang Lelang</td>
                                <td><?php echo $datad['total_barang']; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<center>		
			<div class="alert alert-dark">
				<strong>Copyright @</strong>Mochammad Fauzan Satriawan. 2021-2022
			</div>
		</center>
				
		<!-- The Modal -->
		<div class="modal fade" id="Profile">
			<div class="modal-dialog">
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">
							Akun&nbsp;
							<a class="badge badge-success" href="edit_data_umum.php?id_petugas=<?php echo $data['id_petugas']; ?>">
								Edit
							</a>
						</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body">
						<center>
							<strong><?php echo $username; ?></strong>
							<br>
                            <?php 
                                if($level==1)
                                {
                                    echo "Administrator";
                                }
                                else if($level==2)
                                {
                                    echo "Petugas";
                                }
                                else
                                {
                                    echo "User";
                                }
                            ?>
						</center>
						<hr>
						<strong>Data Umum</strong>
                        <br>
						<?php
							echo "<strong>Nama Lengkap:</strong> ";
							echo $data['nama_petugas'];
						?>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<a href="../logout.php">
							<button type="button" class="btn btn-danger" onclick="return confirm('Yakin anda ingin Keluar?')">
								Keluar
							</button>
						</a>
					</div>
        
				</div>
			</div>
		</div>
		<!-- The Modal -->
		<div class="modal fade" id="TambahData">
			<div class="modal-dialog">
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Tambah Data Lelang</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body">
						<form action="simpan_data_lelang.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="id_barang">ID Barang:</label>
								<input type="text" class="form-control" name="id_barang" id="id_barang" placeholder="ID Barang" value="<?php if(empty($_GET['barang'])){ echo ""; }else{ echo $_GET['barang']; } ?>" required>
							</div>
							<div class="form-group">
								<label for="tgl_lelang">Tanggal:</label>
								<input type="date" class="form-control" name="tgl_lelang" id="tgl_lelang" value="<?php echo date('Y-m-d'); ?>" required>
							</div>
							<div class="form-group">
								<label for="harga_akhir">Harga Akhir:</label>
								<input type="text" class="form-control" name="harga_akhir" id="harga_akhir" placeholder="Harga Akhir" value="<?php if(empty($_GET['harga'])){ echo ""; }else{ echo $_GET['harga']; } ?>" required>
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="ID User" required>
							</div>
							<div class="form-group">
								<label for="id_petugas">ID Petugas:</label>
								<input type="text" class="form-control" name="id_petugas" id="id_petugas" placeholder="ID Petugas" value="<?php echo $data['id_petugas']; ?>" required>
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="status" id="status" placeholder="Status" required>
							</div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
						</form>
					</div>
        
					<!-- Modal footer -->
					<div class="modal-footer">
					</div>
        
				</div>
			</div>
		</div>
	</body>
</html>