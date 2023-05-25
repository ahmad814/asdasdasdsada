<?php

ob_start();
session_start();
include("cn.php");
    

     

$uname=$_SESSION["uname"];
if(isset($_SESSION["uname"]))
{



if(isset($_POST['submit']))
{

    date_default_timezone_set('Asia/Kolkata');
$curdate= date('d-m-Y H:i');
 $filename = $_FILES['file']['name'];
 
  // Upload file
  move_uploaded_file($_FILES['file']['tmp_name'],'events/'.$filename);
   
    $dec= $_POST['description'];
      
 $sql = "INSERT INTO `event`(`name`, `image`, `date`, `time`, `location`, `link`, `description`) VALUES ('".$_POST['name']."','$filename','".$_POST['date']."','".$_POST['time']."','".$_POST['location']."','".$_POST['link']."','$dec') ";
$result = $con->query($sql);
 if($result){ echo  "<script type='text/javascript'>alert(\"Add Successfully\")
 location.href='events.php';
  </script>";}
  else
      { echo  "<script type='text/javascript'>alert(\"not added\")
 location.href='events.php';
  </script>";}      



}

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
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

    <script type="text/javascript" src="editor/lib/jquery-1.9.0.min.js"></script>

    <!-- Redactor is here -->
    <link rel="stylesheet" href="editor/redactor/redactor.css" />
    <script src="editor/redactor/redactor.min.js"></script>

    <script type="text/javascript">
    $(document).ready(
        function()
        {
            $('#redactor_content').redactor({
                imageUpload: 'editor/demo/scripts/image_upload.php',
                fileUpload: 'editor/demo/scripts/file_upload.php',
                imageGetJson: 'editor/demo/json/data.json'
            });
        }
    );
    </script>

    <!--//web-fonts-->
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
       <?php include("header.php"); ?>
            <!--// top-bar -->

            <!-- main-heading -->
            
            <!--// main-heading -->

            <!-- Error Page Content -->
            <div class="blank-page-content">

                <!-- Error Page Info -->
                <div class="outer-w3-agile mt-3">
                  <div id="page">
                    <h4>Add Event</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        
                       
                        
                        
                    <label class="col-sm-2 col-form-label"> Event Name</label> <input type="text" name="name"class="form-control" required>   <br>
                   
                    <label class="col-sm-12 col-form-label">Event Image</label>
                    <input type="file" name="file" id="file"  class="form-control" required><br>
                    
    
                    <label class="col-sm-2 col-form-label"> Event Date</label> <input type="text" name="date" class="form-control" required>   <br>
                    

                      <input type="hidden" name="time" class="form-control" value="4pm">
                     <br>
     <label class="col-sm-2 col-form-label"> Event Location</label> <input type="text" name="location" class="form-control" >


                     <br>
                     <label class="col-sm-2 col-form-label"> Event Link</label> <input type="text" name="link" class="form-control" ><br>
     <label class="col-sm-2 col-form-label">Description</label> 
     <textarea name="description" rows="4" cols="50" class="form-control" id="redactor_content" >
</textarea>

    </div>
    <input type="submit" name="submit" class="btn btn-primary"></form>
                </div>
                <!--// Error Page Info -->

            </div>

            <!--// Error Page Content -->

            <!-- Copyright -->
            
            <!--// Copyright -->
        </div>
    </div>


    <!-- Required common Js -->
    
    <!-- //Js for bootstrap working -->

</body>

</html>
<?php
}
else
{
  header("location:index.php");
}
?>
