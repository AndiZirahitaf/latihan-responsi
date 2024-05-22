<?php
session_start();
require 'koneksi.php';
if (isset($_COOKIE['id_admin']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id_admin'];
	$key = $_COOKIE['key'];

	$result = mysqli_query($conn, "SELECT username FROM admin WHERE id_admin = $id");
	$row = mysqli_fetch_assoc($result);


    if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}

if( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}

if( isset($_POST["login"]) ) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	echo $username;
	echo $password;

	$result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

	// cek username
	if( mysqli_num_rows($result) === 1 ) {
		echo "username ada";
		// cek password
		$row = mysqli_fetch_assoc($result);
		echo $row["password"];
		if( password_verify($password, $row["password"]) ) {
			$_SESSION["login"] = true;

			// cek remember me
			if( isset($_POST["remember"]) ) {
				// buat cookie
				setcookie('id_admin', $row['id_admin'], time()+60);
				setcookie('key', hash('sha256', $row['username']), time()+60);

				// setcookie('login', 'true', time()+60);
			}
			header("Location: index.php");
			exit;
		}
	}

	$error = true;

}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    .wrapper {
        background-color: skyblue;
        padding: 0 20px 0 20px;
    }

    .side-image {
        background-image: url("https://images.unsplash.com/photo-1549675584-91f19337af3d?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
        background-size: cover;
        background-position: center;
        position: relative;
        background-repeat: no-repeat;
    }

    .row {
        width: 900px;
        height: 500px;
        background-color: skyblue;

    }

    .card {
        /* width: 400px; */
        height: 500px;
        background-color: white;
        /* margin-top: 100px; */
        padding: 50px;
    }
    </style>
</head>

<body style="background-color: skyblue" ;>

    <div class="wrapper">
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="row">
                <div class="col-md-6 side-image">
                </div>
                <div class="col-md-6 right">
                    <div class="card">
                        <div class="card-body">
                            <h2>Login</h2>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="login">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>