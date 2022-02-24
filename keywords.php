<?php
session_start();

if (isset($_SESSION["mail"])) {
  $mail =  $_SESSION["mail"];
  $id =  $_SESSION["id"];
} else {
  header("Location:index.php");
}
require ('resources/db/mysqli.php');

if(isset($_POST["addkeyword"])){

  $keyword = $dbc-> real_escape_string($_POST['keyword']);


if(isset($keyword) ){

$stmt = $dbc->prepare("INSERT INTO keywords (keyword) VALUES (? )");
$stmt->bind_param("s", $keyword);
$stmt->execute();
$stmt->close();
}else{

  echo "Please fill all";
}


}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Keywords</title>
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
        <a style="color:white" class="nav-link" href="media.php">Media Records</a>
      </li>

      <li class="nav-item">
        <a style="color:white" class="nav-link" href="publishers.php">Publishers</a>
      </li>

      <li class="nav-item">
        <a  class="nav-link active" href="keywords.php">Keywords</a>
      </li>


      <li class="nav-item">
        <a  style="color:white" href="search.php" class="nav-link ">Search</a>
      </li>



    </ul>
    <a href="logout.php" style="color:white; float:right; margin-right:1%">log out</a>
  </nav>



  <form  style="width:60%; margin:5% 20% 5% 20%" class="input-group border border-primary rounded  " method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

      <div  class=" col-8 m-4 " >
        <input type="text" class="form-control " name="keyword" placeholder="keyword" >
      </div>

      <div class=" m-4 col">
        <input type="submit" class=" btn btn-primary" value="Add" name="addkeyword">
      </div>



    

</form >


<table class="table table-primary table-striped event-table">
    <thead>
      <th>#</th>
      <th>keyword</th>
    </thead>
    <tbody>

<?php 
$sql = "SELECT keyword FROM keywords";
$result = mysqli_query($dbc, $sql);

if (mysqli_num_rows($result) > 0) {
  $i=1;
  while($row = mysqli_fetch_assoc($result)) {

    echo "<tr>";
    echo "<td>" . $i. "</td>";
    echo "<td>" . $row['keyword']. "</td>";


    echo "</tr>";


    $i++;
  }
}

$dbc->close();


?>
    </tbody>
  </table>






  <script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>