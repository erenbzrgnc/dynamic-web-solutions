<?php
session_start();

if (isset($_SESSION["mail"])) {
    $mail =  $_SESSION["mail"];
    $id =  $_SESSION["id"];
} else {
    header("Location:index.php");
}
require('resources/db/mysqli.php');

$userid = $_GET["id"];

if(isset( $_GET["eventid"])){
    $event_id = $_GET["eventid"];
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
    <title>Media Records</title>
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





    <table  style="margin-top:4%"  class="table table-primary table-striped event-table">
        <thead>
            <th>#</th>
            <th>title</th>
            <th>description</th>
            <th>date and time</th>
            <th>link to original post</th>
            <th>original publisher</th>
            <th>media type</th>
            <th>event</th>
        </thead>
        <tbody>

            <?php
            if(isset($event_id)){
                $sql = "SELECT *  FROM media_records WHERE user_id=" . $userid . " AND event_id=" . $event_id ;

            }else{
                $sql = "SELECT *  FROM media_records WHERE user_id=" . $userid ;

            }
            
            $result = mysqli_query($dbc, $sql);

            if (mysqli_num_rows($result) > 0) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {

                    $sql5 = "SELECT * FROM  events WHERE id=" . $row['event_id'];
                    $result5 = mysqli_query($dbc, $sql5);
                    $row5 = mysqli_fetch_assoc($result5);
                    $eventitle =$row5['title'];

                    echo "<tr data-link=singlemedia.php?id=" . $row['id'] . ">";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['date_and_time'] . "</td>";
                    echo "<td>" . $row['original_post'] . "</td>";
                    echo "<td>" . $row['original_publisher'] . "</td>";
                    echo "<td>" . $row['media_type'] . "</td>";
                    echo "<td>" . $eventitle . "</td>";

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