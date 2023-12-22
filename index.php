<!DOCTYPE html>
<html lang="en">
    <head>
		<title>
			LelangCepat
		</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="assets/css/bootstrap.css"> 
		<script src="assets/js/jquery.js"></script> 
		<script src="assets/js/popper.js"></script> 
		<script src="assets/js/bootstrap.js"></script>
		<style>
			//* Make the image fully responsive */
			.carousel-inner img {
				width: 100%;
				height: 100%;
			}
		</style>
    </head>
    <body style="background: linear-gradient(to right, #F9886E 0%, #F98860  40%, #1c1c1c 150%), linear-gradient(to left, rgba(255,255,255,0.40)0%, rgba(0,0,0,0.25)200%);background-blend-mode:multiply;">
        <div class="container-fluid">
            <div class="row" style="margin: auto;">
                <div class="col-sm-4" style="margin: auto;">
                    <img src="img/Web Logo Trans4.png" class="img-fluid mx-auto d-none d-sm-block" alt="Web Logo2">
                </div>
                <div class="col-sm-6" style="margin: auto;">
                    <center><strong style="font-size: 180%;" class="text-light">LELANG<span style="color: #FF410E;">CEPAT</span></strong><p>
                    <span class="text-light">Selamat Datang di, LELANGCEPAT disini kamu bisa melelang Barang<br>
                    Silahkan Login, belum punya akun? silahkan</span>
                    <a href="#" data-toggle="modal" data-target="#Register">
                        Register
                    </a></center>
                    <div class="container-fluid text-light" style="margin-top: 10px;">
                        <form action="login.php" method="POST" style="margin-top: 10px;">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="username" class="form-control" name="username" id="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password:</label>
								<div class="input-group mb-3">
								<input type="password" class="form-control" name="password" id="pwd" placeholder="Password" required>
									<div class="input-group-append">
										<button class="btn btn-outline-info" type="button" onclick="showPass()" ondblclick="hidePass()">Show</button>
									</div>
								</div>
                            </div>
                            <button type="submit" class="btn btn-outline-light">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
		<div class="modal fade" id="Register">
			<div class="modal-dialog">
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Register</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body">
						<form action="register.php" method="POST">
							<div class="form-group">
								<label for="username">Username:</label>
								<input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
							</div>
							<div class="form-group">
								<label for="pwd">Password:</label>
								<input type="password" class="form-control" name="password" id="pwd" placeholder="Password" required>
							</div>
                            <button type="submit" class="btn btn-outline-dark">Daftar</button>
						</form>
					</div>
        
					<!-- Modal footer -->
					<div class="modal-footer">
					</div>
        
				</div>
			</div>
		</div>
		<script>
			function showPass() {
				document.getElementById("pwd").type='text';
			}
			function hidePass() {
				document.getElementById("pwd").type='password';
			}
		</script>
    </body>
</html>