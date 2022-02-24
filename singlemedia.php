<?php
session_start();

if (isset($_SESSION["mail"])) {
  $mail =  $_SESSION["mail"];
  $id =  $_SESSION["id"];
} else {
  header("Location:index.php");
}
require ('resources/db/mysqli.php');

$eventid = $_GET["id"];






?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Event</title>
  <link rel="stylesheet" href="resources/css/events.css">
  <link rel="apple-touch-icon" sizes="180x180" href="/resources/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/resources/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/resources/favicon/favicon-16x16.png">
  <link rel="manifest" href="/resources/favicon/site.webmanifest">
  <link rel="mask-icon" href="/resources/favicon/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="/resources/favicon/favicon.ico">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="/resources/favicon/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">
</head>

<body>


  <nav class="navbar navbar-dark bg-primary">
    <ul class="nav nav-tabs">

      <li class="nav-item">
        <a style="color:white" class="nav-link" aria-current="page" href="events.php">Events</a>
      </li>

      <li class="nav-item">
        <a  class="nav-link active" href="media.php">Media Records</a>
      </li>

      <li class="nav-item">
        <a style="color:white" class="nav-link" href="publishers.php">Publishers</a>
      </li>

      <li class="nav-item">
        <a style="color:white" href="keywords.php" class="nav-link ">Keywords</a>
      </li>


      <li class="nav-item">
        <a  style="color:white" href="search.php" class="nav-link ">Search</a>
      </li>




    </ul>
    <a href="logout.php" style="color:white; float:right; margin-right:1%">log out</a>
  </nav>

<?php

$sql = "SELECT * FROM media_records WHERE id = $eventid";
$result = mysqli_query($dbc, $sql);
$row = mysqli_fetch_assoc($result);

$title = $row["title"];
$desc = $row["description"];
$dnt = $row["date_and_time"];
$orgpost = $row["original_post"];
$orgpublisher = $row["original_publisher"];
$mtype = $row["media_type"];
$media = $row["file_path"];
$dbc->close();

?>

  <div class="input-group border border-primary rounded outer-div " >

   

      <div style="text-align: center; " class="m-4 col-5 ">
        <p style="color: blue; vertical-align:middle">TITLE</p>
        <p><?php echo $title; ?></p>
      </div>




      <div style="text-align: center;" class=" m-4 col-5">
      <p style="color: blue;">DESCRIPTION</p>
      <p><?php echo $desc; ?></p>
      </div>


      <div style="text-align: center;" class=" m-4 col-5">
      <p style="color: blue;">DATE</p>
        <p><?php echo $dnt; ?></p>
      </div>



      <div style="text-align: center; " class="m-4 col-5 ">
        <p style="color: blue; vertical-align:middle">LINK TO ORIGINAL POST</p>
        <a style="color: red;" href="<?php echo $orgpost; ?>" target="_blank"><?php echo $orgpost; ?></a>

      </div>




      <div style="text-align: center; " class=" m-4 col-4">
      <p style="color: blue;">NAME OF ORGINAL PUBLISHER</p>
      <p><?php echo $orgpublisher; ?></p>
      </div>


      <div style="text-align: center;" class=" m-4 col-3">
      <p style="color: blue;">MEDIA TYPE</p>
        <p><?php echo $mtype; ?></p>
      </div>

      <div style="text-align: center;" class=" m-4 col-3">
      <p style="color: blue;">MEDIA</p>

      <a style="color: red;" href="<?php echo $media; ?>" target="_blank">View</a>
       
      </div>


  




    

    </div >






  <script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
  </script>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>