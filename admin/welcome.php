<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="../assets/css/style_login.css">

    <style>
        a {
            text-decoration: none;
            color: #FFF;
        }
    </style>

	<title>Authentification</title>
</head>
<body>
	<div class="container">
		<div class="login-email">

            <?php
                $uname = "admini";
                $pwd = "admini";

                session_start();

                if (isset($_SESSION['uname']))
                { 
            ?>
                    <p class="login-text" style="font-size: 2rem; font-weight: 800;">Bienvenue <?= $_SESSION['uname'] ?></p>
                    <div class="input-group">
                        <button name="submit" class="btn"><a href='crud.php'>Acceder à la Session ADMIN</a></button>
                    </div>
                    <div class="input-group">
                        <button name="submit" class="btn"><a href="logout.php">Se Deconnecter</a></button>
                    </div>
            <?php
                }
                else {
                    if ($_POST['uname'] == $uname && $_POST['pwd'] == $pwd) {
                
                        $_SESSION['uname'] = $uname;
                
                        echo "<script>location.href='welcome.php'</script>";
                    }
                    else {
                        echo "<script>alert('Mot De Passe Ou Pseudo Incorrect !')</script>";
                
                        echo "<script>location.href='login.php'></script>";
                    }
                }
            ?>
		</div>
	</div>
</body>
</html>