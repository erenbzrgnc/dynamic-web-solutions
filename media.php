<?php
session_start();

if (isset($_SESSION["mail"])) {
    $mail =  $_SESSION["mail"];
    $id =  $_SESSION["id"];
} else {
    header("Location:index.php");
}
require('resources/db/mysqli.php');

if (isset($_POST["addmedia"])) {

    $title = $dbc->real_escape_string($_POST['title']);
    $desc = $dbc->real_escape_string($_POST['desc']);
    $date = $dbc->real_escape_string($_POST['datetime']);
    $orglink = $dbc->real_escape_string($_POST['original-link']);
    $orgname = $dbc->real_escape_string($_POST['original-name']);
    $mediatype = $dbc->real_escape_string($_POST['media-type']);
    $event = $dbc->real_escape_string($_POST['event']);
    $idkeywords = $_POST['keywords'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg',  'gif', 'webm', '.mkv', 'flv','mpeg','mp4','mp3', 'mpeg-4'];

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, There is a file with same name. Please change the name and try again.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($ext, $allowed)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF, WEBM, MKV, FLV, MPEG, MP4, MP3, MPEG-4 files are allowed.";
        $uploadOk = 0;
    }


    if (isset($title) && isset($desc) && isset($date) && isset($orglink) && isset($orgname) && isset($mediatype) && isset($event)) {


        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                $stmt = $dbc->prepare("INSERT INTO media_records (title, description, date_and_time,original_post,original_publisher, media_type, file_path, user_id,event_id) VALUES (?,?, ?,?,?, ?, ?,?,?)");
                $stmt->bind_param("sssssssii", $title, $desc, $date, $orglink, $orgname, $mediatype, $target_file, $id, $event);
                $stmt->execute();
                $stmt->close();
                if (count($idkeywords) > 0) {
                    $sql = "SELECT id FROM media_records ORDER BY id DESC LIMIT 1";
                    $result = mysqli_query($dbc, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $mediaid = $row["id"];
        
                    for ($i = 0; $i < count($idkeywords); $i++) {
                        $stmt = $dbc->prepare("INSERT INTO events_and_keywords (keyword_id, media_id) VALUES (?, ?)");
                        $stmt->bind_param("ii", $idkeywords[$i], $mediaid);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }




        }


    } else {
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
                <a style="color: white;" class="nav-link" aria-current="page" href="events.php">Events</a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="media.php">Media Records</a>
            </li>

            <li class="nav-item">
                <a style="color:white" class="nav-link" href="publishers.php">Publishers</a>
            </li>

            <li class="nav-item">
                <a style="color:white" href="keywords.php" class="nav-link ">Keywords</a>
            </li>

            <li class="nav-item">
                <a style="color:white" href="search.php" class="nav-link ">Search</a>
            </li>



        </ul>
        <a href="logout.php" style="color:white; float:right; margin-right:1%">log out</a>
    </nav>



    <form class="input-group border border-primary rounded outer-div " enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">



        <div class="m-4 col ">
            <input required type="text" class="form-control" name="title" placeholder="title">
        </div>




        <div class=" m-4 col">
            <input required type="datetime-local" name="datetime" class="form-control" placeholder="date and time">
        </div>

        <div class=" col-4 m-4 ">
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

        <div class=" m-4 col">
            <input required type="submit" class=" btn btn-primary" value="Add" name="addmedia">
        </div>

        <div style="width: 95%;" class=" col-12 m-4 ">
            <input required type="text" class="form-control" name="desc" placeholder="description">
        </div>

        <div class=" col-4 m-4 ">
            <input required type="text" class="form-control" name="original-link" placeholder="original post link">
        </div>

        <div class=" col-4 m-4 ">
            <input required type="text" class="form-control" name="original-name" placeholder="name of the orginal publisher">
        </div>

        <div class=" col-4 m-4 ">
            <input required type="text" class="form-control" name="media-type" placeholder="media type">
        </div>

        <div class=" col-4 m-4 ">
            <select required class="form-control" placeholder="event" name="event" id="event">

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


        <div class=" col-4 m-4 ">
            <input required type="file" class="form-control" name="fileToUpload" id="fileToUpload">
        </div>




    </form>


    <table class="table table-primary table-striped event-table">
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
            $sql = "SELECT *  FROM media_records";
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