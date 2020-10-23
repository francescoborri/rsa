<?php
session_start();
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$public_key = isset($_SESSION['public_key']) ? $_SESSION['public_key'] : NULL;
$private_key = isset($_SESSION['private_key']) ? $_SESSION['private_key'] : '';
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="css/default.css">
	<title>Algoritmo RSA</title>
</head>

<body>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="jumbotron jumbotron-fluid w-100 mb-3">
				<div class="row justify-content-around">
					<div class="col-auto d-flex align-items-center">
						<h1 class="display-4 text-center">Algoritmo RSA</h1>
					</div>
					<div class="col-auto mx-md-0 mx-3">
						<ul class="list-group shadow">
							<li class="list-group-item">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Messaggio</span>
									</div>
									<input type="text" class="form-control" value="<?= $message ?>" disabled>
								</div>
							</li>
							<li class="list-group-item">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Chiavi pubbliche</span>
									</div>
									<input type="text" class="form-control" value="<?= isset($public_key) ? $public_key[0] : '' ?>" disabled>
									<input type="text" class="form-control" value="<?= isset($public_key) ? $public_key[1] : '' ?>" disabled>
								</div>
							</li>
							<li class="list-group-item">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Chiave privata</span>
									</div>
									<input type="text" class="form-control" value="<?= $private_key ?>" disabled>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center mb-3">
			<div class="col">
				<div class="input-group shadow">
					<div class="input-group-prepend">
						<button type="submit" class="btn btn-primary" form="rsa-actions" name="action" value="generate">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shuffle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M0 3.5A.5.5 0 0 1 .5 3H1c2.202 0 3.827 1.24 4.874 2.418.49.552.865 1.102 1.126 1.532.26-.43.636-.98 1.126-1.532C9.173 4.24 10.798 3 13 3v1c-1.798 0-3.173 1.01-4.126 2.082A9.624 9.624 0 0 0 7.556 8a9.624 9.624 0 0 0 1.317 1.918C9.828 10.99 11.204 12 13 12v1c-2.202 0-3.827-1.24-4.874-2.418A10.595 10.595 0 0 1 7 9.05c-.26.43-.636.98-1.126 1.532C4.827 11.76 3.202 13 1 13H.5a.5.5 0 0 1 0-1H1c1.798 0 3.173-1.01 4.126-2.082A9.624 9.624 0 0 0 6.444 8a9.624 9.624 0 0 0-1.317-1.918C4.172 5.01 2.796 4 1 4H.5a.5.5 0 0 1-.5-.5z" />
								<path d="M13 5.466V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192zm0 9v-3.932a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192z" />
							</svg>
						</button>
					</div>
					<input type="text" class="form-control" value="Genera chiavi" disabled>
				</div>
			</div>
		</div>
		<div class="row justify-content-center mb-3">
			<div class="col">
				<div class="input-group shadow">
					<div class="input-group-prepend">
						<button type="submit" class="btn btn-primary" form="rsa-actions" name="action" value="crypt">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
							</svg>
						</button>
					</div>
					<input type="text" class="form-control" form="rsa-actions" name="tocrypt" placeholder="Cripta">
				</div>
			</div>
		</div>
		<div class="row justify-content-center mb-3">
			<div class="col">
				<div class="input-group shadow">
					<div class="input-group-prepend">
						<button type="submit" class="btn btn-primary" form="rsa-actions" name="action" value="decrypt">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-unlock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M9.655 8H2.333c-.264 0-.398.068-.471.121a.73.73 0 0 0-.224.296 1.626 1.626 0 0 0-.138.59V14c0 .342.076.531.14.635.064.106.151.18.256.237a1.122 1.122 0 0 0 .436.127l.013.001h7.322c.264 0 .398-.068.471-.121a.73.73 0 0 0 .224-.296 1.627 1.627 0 0 0 .138-.59V9c0-.342-.076-.531-.14-.635a.658.658 0 0 0-.255-.237A1.122 1.122 0 0 0 9.655 8zm.012-1H2.333C.5 7 .5 9 .5 9v5c0 2 1.833 2 1.833 2h7.334c1.833 0 1.833-2 1.833-2V9c0-2-1.833-2-1.833-2zM8.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
							</svg>
						</button>
					</div>
					<input type="text" class="form-control" form="rsa-actions" name="todecrypt" placeholder="Decripta">
				</div>
			</div>
		</div>
	</div>
	<form action="rsa.php" id="rsa-actions" method="POST" class="d-none"></form>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>