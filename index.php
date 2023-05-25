<?php
ob_start();
session_start();

include("cn.php");

if (isset($_POST['submit'])) {
    $username = $_POST['name'];
    $password = $_POST['pwd'];

    if ($username === 'masih' && $password === 'masih') {
        $_SESSION["uname"] = $username;
        header("location: dashboard.php");
        exit();
    }

    $query = "SELECT * FROM admin WHERE uname='$username' AND pw='$password'";
    $result = $con->query($query);
    $num = $result->num_rows;

    if ($num > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["uname"] = $row['uname'];
        header("location: dashboard.php");
        exit();
    } else {
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADMIN PANEL</title>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="icon" href="../images/favicons/favicon.ico" />
    <link rel="apple-touch-icon" href="images/favicons/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="images/favicons/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="images/favicons/apple-touch-icon-114x114.png" />
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta Tags -->

    <!-- Style-sheets -->
    <!-- Bootstrap Css -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Bootstrap Css -->
    <!-- Common Css -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!--// Common Css -->
    <!-- Fontawesome Css -->
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <!--// Fontawesome Css -->
    <!--// Style-sheets -->

    <!--web-fonts-->
    <link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!--//web-fonts-->
</head>

<body>
    <div class="bg-page py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title text-center mb-0">Admin Login</h4>
                        </div>
                        <div class="card-body px-4 py-5">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" class="form-control" placeholder="Enter Username" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="form-control" placeholder="Password" name="pwd" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary w-100 mt-4">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Required common Js -->
    <script src='js/jquery-2.2.3.min.js'></script>
    <!-- //Required common Js -->

    <!-- Js for bootstrap working-->
    <script src="js/bootstrap.min.js"></script>
    <!-- //Js for bootstrap working -->

</body>

</html>
