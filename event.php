<?php
ob_start();
session_start();
include("cn.php");

if(isset($_SESSION["uname"])) {
    if (isset($_POST['submit'])) {
        // Check if file is a valid image file
        $filename = $_FILES['file']['name'];
        $filetype = $_FILES['file']['type'];
        $valid_image_types = array('image/png', 'image/gif', 'image/jpeg', 'image/jpg');
        if (!in_array($filetype, $valid_image_types)) {
            echo "<script type='text/javascript'>alert(\"Invalid image file format\")
                location.href='events.php';
            </script>";
            exit();
        }

        // Upload file
        $upload_dir = 'events/';
        $upload_path = $upload_dir . basename($filename);
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $upload_path)) {
            echo "<script type='text/javascript'>alert(\"Failed to upload image file\")
                location.href='events.php';
            </script>";
            exit();
        }
   
        // Validate and sanitize form input data
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $time = mysqli_real_escape_string($con, $_POST['time']);
        $location = mysqli_real_escape_string($con, $_POST['location']);
        $link = mysqli_real_escape_string($con, $_POST['link']);
        $description = mysqli_real_escape_string($con, $_POST['description']);

        $date_regex = '/^(0?[1-9]|[12][0-9]|3[01])-(0?[1-9]|1[012])-([12]\d{3})$/';
        $time_regex = '/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/';
        if (!preg_match($date_regex, $date) || !preg_match($time_regex, $time)) {
            echo "<script type='text/javascript'>alert(\"Invalid date or time format\")
                location.href='events.php';
            </script>";
            exit();
        }

        // Perform SQL insertion using prepared statements
        $stmt = $con->prepare("INSERT INTO `event`(`name`, `image`, `date`, `time`, `location`, `link`, `description`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $filename, $date, $time, $location, $link, $description);
        if ($stmt->execute()) {
            echo "<script type='text/javascript'>alert("Add Successfully")
location.href='events.php';
</script>";
} else {
echo "<script type='text/javascript'>alert("Failed to add event")
location.href='events.php';
</script>";
}
}
} else {
// Redirect user to login page if not logged in
header("location:login.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Event | Admin Panel</title>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Modernize Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
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
    <!-- Nav Css -->
    <link rel="stylesheet" href="css/style4.css">
    <!--// Nav Css -->
    <!-- Fontawesome Css -->
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <!--// Fontawesome Css -->
    <!--// Style-sheets -->

    <!--web-fonts-->
    <link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="editor/css/style.css" />
    <link rel="stylesheet" href="editor/redactor/redactor.css" />

    <style>
        /* Page title */
        .page-title {
            background-color: #0E4C92;
            text-align: center;
            padding: 20px;
            margin-bottom: 30px;
        }

        .page-title h2 {
            color: white;
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Form container */
        .form-container {
            background-color: #F5F5F5;
            padding: 30px;
            border-radius: 10px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        /* Form elements */
        label {
            font-size: 18px;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php include("header.php"); ?>

        <!-- Page Content Holder -->
        <div id="content">
            <div class="page-title">
                <h2>Add Event</h2>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-container">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Event Name:</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="file">Event Image:</label>
                                    <input type="file" name="file" id="file" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="date">Event Date:</label>
                                    <input type="text" name="date" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="location">Event Location:</label>
                                    <input type="text" name="location" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="link">Event Link:</label>
                                    <input type="text" name="link" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea name="description" rows="4" cols="50" class="form-control" id="redactor_content"></textarea>
                                </div>

                                <input type="submit" name="submit" class="btn btn-primary btn-block" value="Add Event">
</form>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- Required common Js -->
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<!-- //Js for bootstrap working -->

<!-- Redactor script -->
<script type="text/javascript" src="editor/lib/jquery-1.9.0.min.js"></script>
<script src="editor/redactor/redactor.min.js"></script>
<script>
    $(document).ready(function() {
        $('#redactor_content').redactor({
            imageUpload: 'editor/demo/scripts/image_upload.php',
            fileUpload: 'editor/demo/scripts/file_upload.php',
            imageGetJson: 'editor/demo/json/data.json'
        });
    });
</script>

</body>

</html>
