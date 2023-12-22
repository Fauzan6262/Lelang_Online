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
	<body style="background: linear-gradient(to right, #F9886E 0%, #F98860 40%, #1c1c1c 150%), linear-gradient(to left, rgba(255,255,255,0.40)0%, rgba(0,0,0,0.25)200%);background-blend-mode:multiply;">
	<nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background-image: linear-gradient(to right, #1e3c72 0%, #2a5298 100%);">
			<a class="navbar-brand" href="index.php"><span style="font-weight: bold;">LELANG<span style="color: #FF410E;">CEPAT</span></span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<?php
					session_start();
					include '../dbconnect.php';
					if(!isset($_SESSION['status']))
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
						$status=$_SESSION['status'];
						$sql = "SELECT * FROM tb_masyarakat WHERE username='$username' AND password='$password'";
						$query = mysqli_query($conn,$sql);
						$count = mysqli_num_rows($query);
						$data = mysqli_fetch_array($query);
						$id_user=$data['id_user'];

                        echo
                        '
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Beranda</a>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#Profile">
                            Akun
                        </button>
                        ';
					}
				?>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="alert" style="overflow:auto;">
                <?php
                    $id_lelang=$_GET['id_lelang'];
                    $sqla = "SELECT * FROM tb_lelang WHERE id_lelang='$id_lelang'";
                    $querya = mysqli_query($conn,$sqla);
                    $counta = mysqli_num_rows($querya);
                    $dataa = mysqli_fetch_array($querya);

                    $id_barang=$_GET['id_barang'];
                    $sqlb = "SELECT * FROM tb_barang WHERE id_barang='$id_barang'";
                    $queryb = mysqli_query($conn,$sqlb);
                    $countb = mysqli_num_rows($queryb);
                    $datab = mysqli_fetch_array($queryb);
                ?>
                <div class="row">
                    <img src="<?php echo "../db_img/".$datab['foto']; ?>" class="img-fluid mx-auto d-block" alt="<?php echo "../db_img/".$datab['foto']; ?>" style="width: 585px;height: 100%;">
                </div>
				<div class="row mt-2 text-white">
					<div class="col-sm-3"></div>
					<div class="col-sm-6 text-center py-2 px-2 rounded" style="background-image: linear-gradient(to right, #1e3c72 0%, #2a5298 100%);"><?php echo $datab['deskripsi_barang'] ?></div>
					<div class="col-sm-3"></div>
                </div>
                <div class="row text-white">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-3 py-2 pl-4 mt-2" style="background-image: linear-gradient(to right, #1e3c72 0%, #2a5298 100%);">
                        <div class="row"><strong>Nama Barang : </strong></div>
                        <div class="row"><strong>Harga Awal : </strong></div>
                        <div class="row"><strong>Harga Akhir : </strong></div>
                        <div class="row"><strong>Penawar : </strong></div>
                        <div class="row"><strong>Harga Tawaran Anda : </strong></div>
                    </div>
                    <div class="col-sm-3 py-2 pr-4 mt-2" style="background-image: linear-gradient(to left, #1e3c72 0%, #2a5298 100%);">
                        <div class="row"><?php echo $datab['nama_barang'] ?></div>
                        <div class="row"><td><?php echo "Rp ".number_format($datab['harga_awal'], 0, '','.'); ?></td></div>
                        <div class="row"><?php echo "Rp ".number_format($dataa['harga_akhir'], 0, '','.'); ?></div>
                        <div class="row">
                            <?php
                                if($dataa['id_user']==1)
                                {
                                    echo "Tidak Ada";
                                }
                                else
                                {
                                    $id_user=$dataa['id_user'];
                                    $sqlc = "SELECT * FROM tb_masyarakat WHERE id_user='$id_user'";
                                    $queryc = mysqli_query($conn,$sqlc);
                                    $countc = mysqli_num_rows($queryc);
                                    $datac = mysqli_fetch_array($queryc);

                                    echo $datac['username'];
                                }
                            ?>
                        </div>
                        <div class="row">
                            <form action="update_harga.php" method="POST">
                                <div class="input-group">
                                    <input type="hidden" name="id_lelang" value="<?php echo $id_lelang; ?>">
                                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                    <input type="text" class="form-control" name="harga_tawaran" style="width: 250px;" placeholder="Harga Tawaran Anda">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="submit">Tawar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    </div>
                </div>
			</div>
		</div>
		<center>		
			<div class="alert text-light" style="background-image: linear-gradient(to right, #1e3c72 0%, #2a5298 100%);">
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
							<a class="badge badge-success" href="edit_data_umum.php?id_user=<?php echo $data['id_user']; ?>">
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
								echo "Pengguna";
                            ?>
						</center>
						<hr>
						<strong>Data Umum</strong>
                        <br>
						<?php
							echo "<strong>Nama Lengkap:</strong> ";
                            echo $data['nama_lengkap'];
                            echo "<br>";
                            echo "<strong>No. Telepon:</strong> ";
							echo $data['telp'];
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
	</body>
</html>