<?php

require 'includes/app.php';

$errores = [];

// Autenticar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
	$password = mysqli_real_escape_string($db, $_POST['password']);

	if (!$email) {
		$errores[] = "El email es obligatorio o no es válido";
	}
	if (!$password) {
		$errores[] = "El password es obligatorio";
	}
	if (empty($errores)) {
		// Revisar si el usuario existe
		$query = " SELECT * FROM usuario WHERE email='${email}'";
		$resultado = mysqli_query($db, $query);

		if ($resultado->num_rows) {
			// Revisar si el password es correcto
			$usuario = mysqli_fetch_assoc($resultado);

			// Verificar si el password es correcto o no
			$auth = password_verify($password, $usuario['passwor']);
			// $auth = hash_equals($password,$usuario['password']);

			if ($auth) {
				// El usuario esta autenticado
				session_start();

				// Llenar el arreglo de la sesión
				// $_SESSION['usuario'] = $usuario['email'];
				// $_SESSION['login'] = true;
				$_SESSION['id'] = $usuario['id'];
				$_SESSION['nombre'] = $usuario['nombre'];
				$_SESSION['rol'] = $usuario['rol'];

				

				header('Location: /admin/dashboard.php');
			} else {
				$errores[] = "El password es incorrecto";
			}
		} else {
			$errores[] = "El usuario no existe";
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login After School</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="assets/images/icons/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="assets/vend/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vend/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/vend/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vend/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vend/select2.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vend/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">

	<script src="https://kit.fontawesome.com/ded965e364.js" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<meta name="robots" content="noindex, follow">
	<script nonce="25d1773e-6b9d-4c0a-b59e-3bbb64cbad7b">
		(function(w, d) {
			! function(bS, bT, bU, bV) {
				bS[bU] = bS[bU] || {};
				bS[bU].executed = [];
				bS.zaraz = {
					deferred: [],
					listeners: []
				};
				bS.zaraz.q = [];
				bS.zaraz._f = function(bW) {
					return async function() {
						var bX = Array.prototype.slice.call(arguments);
						bS.zaraz.q.push({
							m: bW,
							a: bX
						})
					}
				};
				for (const bY of ["track", "set", "debug"]) bS.zaraz[bY] = bS.zaraz._f(bY);
				bS.zaraz.init = () => {
					var bZ = bT.getElementsByTagName(bV)[0],
						b$ = bT.createElement(bV),
						ca = bT.getElementsByTagName("title")[0];
					ca && (bS[bU].t = bT.getElementsByTagName("title")[0].text);
					bS[bU].x = Math.random();
					bS[bU].w = bS.screen.width;
					bS[bU].h = bS.screen.height;
					bS[bU].j = bS.innerHeight;
					bS[bU].e = bS.innerWidth;
					bS[bU].l = bS.location.href;
					bS[bU].r = bT.referrer;
					bS[bU].k = bS.screen.colorDepth;
					bS[bU].n = bT.characterSet;
					bS[bU].o = (new Date).getTimezoneOffset();
					if (bS.dataLayer)
						for (const ce of Object.entries(Object.entries(dataLayer).reduce(((cf, cg) => ({
								...cf[1],
								...cg[1]
							})), {}))) zaraz.set(ce[0], ce[1], {
							scope: "page"
						});
					bS[bU].q = [];
					for (; bS.zaraz.q.length;) {
						const ch = bS.zaraz.q.shift();
						bS[bU].q.push(ch)
					}
					b$.defer = !0;
					for (const ci of [localStorage, sessionStorage]) Object.keys(ci || {}).filter((ck => ck.startsWith("_zaraz_"))).forEach((cj => {
						try {
							bS[bU]["z_" + cj.slice(7)] = JSON.parse(ci.getItem(cj))
						} catch {
							bS[bU]["z_" + cj.slice(7)] = ci.getItem(cj)
						}
					}));
					b$.referrerPolicy = "origin";
					b$.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(bS[bU])));
					bZ.parentNode.insertBefore(b$, bZ)
				};
				["complete", "interactive"].includes(bT.readyState) ? zaraz.init() : bS.addEventListener("DOMContentLoaded", zaraz.init)
			}(w, d, "zarazData", "script");
		})(window, document);
	</script>
</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="">
					<span class="login100-form-title p-b-48">
						<img src="assets/img/afterschool.png" alt="">
					</span>
					<?php foreach($errores as $error): ?>
						<div style="background-color: red; color:white; text-align:center; font-weight: bold; text-transform: uppercase; margin: 1rem 0; padding: 0.2rem;">
							<?php echo $error; ?>
						</div>
					<?php endforeach; ?>
					<div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
						<input class="input100" type="email" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="fa-solid fa-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Login
							</button>
						</div>
					</div>
					<br><br>
				</form>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>

	<script src="assets/vend/jquery-3.2.1.min.js"></script>
	<script src="assets/vend/animsition.min.js"></script>
	<script src="assets/vend/popper.js"></script>
	<script src="assets/vend/select2.min.js"></script>
	<script src="assets/vend/moment.min.js"></script>
	<script src="assets/vend/daterangepicker.js"></script>
	<script src="assets/vend/countdowntime.js"></script>
	<script src="assets/js/main.js"></script>

	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-23581568-13');
	</script>
	<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon='{"rayId":"826bc2155b7125b9","version":"2023.10.0","token":"cd0b4b3a733644fc843ef0b185f98241"}' crossorigin="anonymous"></script>
</body>
</html>