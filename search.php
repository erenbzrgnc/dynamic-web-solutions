<?php
session_start();

if (isset($_SESSION["mail"])) {
    $mail =  $_SESSION["mail"];
    $id =  $_SESSION["id"];
} else {
    header("Location:index.php");
}



require('resources/db/mysqli.php');

if (isset($_POST["event"])) {

    $idkeywords = $_POST['keywords'];

    if (isset($idkeywords)) {

        $sql = "SELECT event_id FROM events_and_keywords WHERE";


        for ($i = 0; $i < count($idkeywords); $i++) {

            if ($i != count($idkeywords) - 1) {
                $sql = $sql . " keyword_id=" . $idkeywords[$i] . " OR ";
            } else {
                $sql = $sql . " keyword_id=" . $idkeywords[$i];
            }
        }

        $result = mysqli_query($dbc, $sql);

        $arr = array();

        while ($row = mysqli_fetch_assoc($result)) {

            if($row["event_id"] != null){
                $sql = "SELECT * FROM events WHERE id=" . $row["event_id"];

                $result2 = mysqli_query($dbc, $sql);
                $row2 = mysqli_fetch_assoc($result2);
    
                if (!in_array($row2, $arr)) {
                    array_push($arr, $row2);
                }

            }

        }

       
    }
}


if (isset($_POST["media"])) {

    $idkeywords = $_POST['keywords'];

    if (isset($idkeywords)) {

        $sql = "SELECT media_id FROM events_and_keywords WHERE";


        for ($i = 0; $i < count($idkeywords); $i++) {

            if ($i != count($idkeywords) - 1) {
                $sql = $sql . " keyword_id=" . $idkeywords[$i] . " OR ";
            } else {
                $sql = $sql . " keyword_id=" . $idkeywords[$i];
            }
        }

        $result = mysqli_query($dbc, $sql);

        $arr = array();



            while ($row = mysqli_fetch_assoc($result)) {

                if($row["media_id"] != null){
                    $sql = "SELECT * FROM media_records WHERE id=" . $row["media_id"];
    
                    $result2 = mysqli_query($dbc, $sql);
                    $row2 = mysqli_fetch_assoc($result2);
        
                    if (!in_array($row2, $arr)) {
                        array_push($arr, $row2);
                    }



                }

            }



        



       
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
    <title>Search</title>
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
                <a style="color:white" href="keywords.php" class="nav-link ">Keywords</a>
            </li>

            <li class="nav-item">
                <a href="search.php" class="nav-link active">Search</a>
            </li>

        </ul>
        <a href="logout.php" style="color:white; float:right; margin-right:1%">log out</a>
    </nav>



    <form class="input-group border border-primary rounded outer-div " method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">



        <div class=" col m-4 ">
            <select required class="form-control" placeholder="keywords" name="keywords[]" id="keywords" multiple>

                <?php
                $sql = "SELECT * FROM keywords";
                $result = mysqli_query($dbc, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value=" .  $row["id"]  . ">" . $row["keyword"] . "</option>";
                    }
                }
                ?>
            </select>
        </div>






        <div style="text-align: center; padding-top:2.2%" class=" m-4 col">

            <input style="margin-right:10px" required type="submit" class=" btn btn-primary" value="event" name="event">

            <input required type="submit" class=" btn btn-primary" value="media record" name="media">
        </div>




    </form>

    <table class="table table-primary table-striped event-table">
    <thead>
      <th>#</th>
      <th>title</th>
      <th>description</th>
      <th>date and time</th>


      <?php
      
      if(isset($arr) && count($arr) > 0){
        if(count($arr[0]) > 5){
        echo " <th>link to original post</th>
        <th>name of the original publisher</th>
        <th>media type</th>";
        
        }


      }
      
      
      ?>
    </thead>
    <tbody>

<?php 
if(isset($arr) && count($arr) > 0){

 

    for($k=0; $k<count($arr); $k++){
        $p=$k+1;
        if(count($arr[0]) > 5){
            echo "<tr data-link=singlemedia.php?id=". $arr[$k]['id'] .">";
        }else{
            echo "<tr data-link=event.php?id=". $arr[$k]['id'] .">";
        }

    echo "<td>" . $p . "</td>";
    echo "<td>" . $arr[$k]['title']. "</td>";
    echo "<td>" . $arr[$k]['description']. "</td>";
    echo "<td>" . $arr[$k]['date_and_time']. "</td>";
    if(count($arr[0]) > 5){
        echo "<td>" . $arr[$k]['original_post']. "</td>";
        echo "<td>" . $arr[$k]['original_publisher']. "</td>";
        echo "<td>" . $arr[$k]['media_type']. "</td>";
    }
    echo "</tr>";


    
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
