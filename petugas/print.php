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
        <center><h2>Laporan</h2></center>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-dark table-striped">
                <?php
                    include '../dbconnect.php';
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
        <script>
			window.print();
		</script>
	</body>
</html>