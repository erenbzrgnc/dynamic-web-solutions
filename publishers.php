<?php
session_start();

if (isset($_SESSION["mail"])) {
    $mail =  $_SESSION["mail"];
    $id =  $_SESSION["id"];
} else {
    header("Location:index.php");
}
require('resources/db/mysqli.php');
$arr0 = array();
$sql0 = "SELECT * FROM user";
$result0 = mysqli_query($dbc, $sql0);
while($row0 = mysqli_fetch_assoc($result0)){
    array_push($arr0, $row0);
}



if (isset($_POST["filter"])) {



    $idevents = $_POST['events'];

    
    $sql5 = "SELECT * FROM  events WHERE id=" . $idevents;
    $result5 = mysqli_query($dbc, $sql5);
    $row5 = mysqli_fetch_assoc($result5);
    $eventitle =$row5['title'];

    if (isset($idevents)) {

        $sql = "SELECT * FROM media_records WHERE event_id =" . $idevents;

        $result = mysqli_query($dbc, $sql);

        $arr = array();

        while ($row = mysqli_fetch_assoc($result)) {
            
            if ($row["user_id"] != null) {
                $sql = "SELECT * FROM user WHERE id=" . $row["user_id"];

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
                <a class="nav-link active" href="publishers.php">Publishers</a>
            </li>

            <li class="nav-item">
                <a style="color:white" href="keywords.php" class="nav-link ">Keywords</a>
            </li>

            <li class="nav-item">
                <a style="color:white" href="search.php" class="nav-link">Search</a>
            </li>

        </ul>
        <a href="logout.php" style="color:white; float:right; margin-right:1%">log out</a>
    </nav>



    <form class="input-group border border-primary rounded outer-div " method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">



        <div style="text-align: center; " class=" col m-4 ">
            <select required class="form-control" placeholder="events" name="events" id="events">

                <?php
                $sql = "SELECT * FROM events";
                $result = mysqli_query($dbc, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value=" .  $row["id"]  . ">" . $row["title"] . "</option>";
                    }
                }
                ?>
            </select>
        </div>






        <div style="text-align: center; " class=" m-4 col">

            <input style="margin-right:10px" required type="submit" class=" btn btn-primary" value="filter" name="filter">


        </div>




    </form>
    <p><button style="width: 10%; margin-left:2.5%" class="btn btn-primary" onclick="sortTable()">Sort</button></p>
    <table class="table table-primary table-striped event-table" id="myTable">
        <thead>
            <th>#</th>
            <th>name</th>
            <th>surname</th>
            <th>event</th>
            <th>posted news</th>



        </thead>
        <tbody>

            <?php

            if (isset($arr) ) {



                for ($k = 0; $k < count($arr); $k++) {

                    $arr4 = array();
                    $sql4 = "SELECT * FROM media_records WHERE event_id=" .$idevents ." AND " . "user_id=" . $arr[$k]['id'] ;
                    $result4 = mysqli_query($dbc, $sql4);
                    while($row4 = mysqli_fetch_assoc($result4)){
                        array_push($arr4, $row4);
                    }
                    $postedNews = count($arr4);


                    $p = $k + 1;

                    echo "<tr data-link=media_publisher.php?id=" . $arr[$k]['id'] . "&eventid=" .$idevents . ">";


                    echo "<td>" . $p . "</td>";
                    echo "<td>" . $arr[$k]['name'] . "</td>";
                    echo "<td>" . $arr[$k]['surname'] . "</td>";
                    echo "<td>" .  $eventitle  . "</td>";
                    echo "<td>" . $postedNews . "</td>";

                    echo "</tr>";
                }
            } else {
                for ($k = 0; $k < count($arr0); $k++) {

                    $arr4 = array();
                    $sql4 = "SELECT * FROM media_records WHERE user_id=" . $arr0[$k]['id'] ;
                    $result4 = mysqli_query($dbc, $sql4);
                    while($row4 = mysqli_fetch_assoc($result4)){
                        array_push($arr4, $row4);
                    }
                    $postedNews = count($arr4);

                    $p = $k + 1;

                    echo "<tr data-link=media_publisher.php?id=" . $arr0[$k]['id'] .">";
                    echo "<td>" . $p . "</td>";
                    echo "<td>" . $arr0[$k]['name'] . "</td>";
                    echo "<td>" . $arr0[$k]['surname'] . "</td>";
                    echo "<td>" . "all" . "</td>";
                    echo "<td>" . $postedNews . "</td>";
                    echo "</tr>";
                }
            }
            $dbc->close();
            ?>

        </tbody>
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script> 

function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;

    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;

      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[4];
      y = rows[i + 1].getElementsByTagName("TD")[4];
      // Check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
        // If so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }

  rows2 = table.rows;

  for (i = 1; i < (rows2.length); i++) {
      console.log(i);
    rows[i].getElementsByTagName("TD")[0].innerHTML="";
    rows[i].getElementsByTagName("TD")[0].innerHTML=i;

  }


}





    </script>

    <script>
        $(document).on("click", "tr", function(event) {

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