<?php
session_start();

if (isset($_SESSION["mail"])) {
  $mail =  $_SESSION["mail"];
  $id =  $_SESSION["id"];
} else {
  header("Location:index.php");
}
require ('resources/db/mysqli.php');

if(isset($_POST["addevent"])){

  $title = $dbc -> real_escape_string($_POST['title']);
  $desc = $dbc -> real_escape_string($_POST['desc']);
  $date = $dbc-> real_escape_string($_POST['datetime']);
  $idkeywords = $_POST['keywords'];




if(isset($title) && isset($desc) && isset($date) ){
  $stmt = $dbc->prepare("INSERT INTO events (title, description, date_and_time, user_id) VALUES (?, ?, ?,?)");
  $stmt->bind_param("sssi", $title, $desc, $date, $id);
  $stmt->execute();
  $stmt->close();

  if(count($idkeywords) > 0){
    $sql = "SELECT id FROM events ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($dbc, $sql);
    $row = mysqli_fetch_assoc($result);
    $eventid = $row["id"];
  
    for($i=0; $i < count($idkeywords) ; $i++ ){
      $stmt = $dbc->prepare("INSERT INTO events_and_keywords (keyword_id, event_id) VALUES (?, ?)");
      $stmt->bind_param("ii", $idkeywords[$i], $eventid);
      $stmt->execute();
      $stmt->close();
  
    }

  }

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
  <title>Events</title>
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
        <a class="nav-link active" aria-current="page" href="events.php">Events</a>
      </li>

      <li class="nav-item">
        <a style="color:white" class="nav-link" href="media.php">Media Records</a>
      </li>

      <li class="nav-item">
        <a style="color:white" class="nav-link " href="publishers.php">Publishers</a>
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



  <form class="input-group border border-primary rounded outer-div " method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

   

      <div class="m-4 col ">
        <input required type="text" class="form-control" name="title" placeholder="title"  >
      </div>




      <div class=" m-4 col">
        <input required type="datetime-local" name="datetime" class="form-control" placeholder="date and time" >
      </div>

      <div class=" col-4 m-4 " >
        <select required class="form-control" placeholder="keywords" name="keywords[]" id="keywords" multiple>

        <?php
        $sql = "SELECT * FROM keywords";
        $result = mysqli_query($dbc, $sql);

        if (mysqli_num_rows($result) > 0) {
          $i=1;
          while($row = mysqli_fetch_assoc($result)) {
            echo "<option value=" .  $row["id"]  .">".$row["keyword"] ."</option>";
          }
        }
        ?>
        </select>
      </div>

      <div class=" m-4 col">
        <input required type="submit" class=" btn btn-primary" value="Add" name="addevent">
      </div>

      <div style="width: 95%;" class=" col-12 m-4 " >
        <input type="text" class="form-control" name="desc" placeholder="description" >
      </div>

    

</form >


<table class="table table-primary table-striped event-table">
    <thead>
      <th>#</th>
      <th>title</th>
      <th>description</th>
      <th>date and time</th>
    </thead>
    <tbody>

<?php 
$sql = "SELECT id, title, description, date_and_time FROM events";
$result = mysqli_query($dbc, $sql);

if (mysqli_num_rows($result) > 0) {
  $i=1;
  while($row = mysqli_fetch_assoc($result)) {

    echo "<tr data-link=event.php?id=". $row['id'] .">";
    echo "<td>" . $i. "</td>";
    echo "<td>" . $row['title']. "</td>";
    echo "<td>" . $row['description']. "</td>";
    echo "<td>" . $row['date_and_time']. "</td>";
    echo "</tr>";
    

    $i++;
  }
}



$dbc->close();

?>

    </tbody>
  </table>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>


$(document).on("click", "tr", function (event) {

      window.location = this.dataset.link;


});
</script>


  <script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
  </script>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>