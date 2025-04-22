<?php
include('shared/auth.php');
$title = 'Saving New Show...';
include('shared/header.php');

// process photo if any
if (!empty($_FILES['photo'])){
    $photoName = $_FILES['photo']['name'];
    echo $photoName;

    // in php file size is in bytes(1024 bytes = 1kb)
    $size = $_FILES['photo']['size'];
    echo $size . '<br />';

    //temp location on cache
    $tmp = $_FILES['photo']['tmp_name'];
    echo $tmp . '<br />';

    //file type 
   // $type = $_FILES['photo']['type'];// never use this not safe only for checking extension of file
   $type = mime_content_type($tmp_name);
    echo $type . '<br />';

    // save file to img/files
    move_uploaded_file($tmp_name, 'img/uploads/' . $photoName);
}
/*
// capture form inputs into vars
$name = $_POST['name'];
echo $name;
$releaseYear = $_POST['releaseYear'];
$genre = $_POST['genre'];
$service = $_POST['service'];
$ok = true;

// input validation before save
if (empty($name)) {
    echo 'Name is required<br />';
    $ok = false;
}

if (empty($releaseYear)) {
    echo 'Release Year is required<br />';
    $ok = false;
}
else {
    if (is_numeric($releaseYear)) {
        if ($releaseYear < 1970) {
            echo 'Release Year must be later than 1969';
            $ok = false;
        }
    }
    else {
        echo 'Release Year must be a number > 1969';
        $ok = false;
    }
}

if (empty($genre)) {
    echo 'Genre is required<br />';
    $ok = false;
}

if (empty($service)) {
    echo 'Service is required<br />';
    $ok = false;
}

if ($ok == true) {
    // connect to db using the PDO (PHP Data Objects Library)
    include('shared/db.php');

    // set up SQL INSERT command
    // NEVER inject variables directly into SQL; vulnerable to SQL Injection Attacks
    //$sql = "INSERT INTO shows (name, releaseYear, genre, service) VALUES ($name, $releaseYear, $genre, $service)";

    $sql = "INSERT INTO shows (name, releaseYear, genre, service) VALUES (:name, :releaseYear, :genre, :service)";

    // link db connection w/SQL command we want to run
    $cmd = $db->prepare($sql);

    // map each input to a column in the shows table
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
    $cmd->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
    $cmd->bindParam(':genre', $genre, PDO::PARAM_STR, 20);
    $cmd->bindParam(':service', $service, PDO::PARAM_STR, 100);

    // execute the INSERT (which saves to the db)
    $cmd->execute();

    // disconnect
    $db = null;

    // show msg to user
    echo 'Show Saved';
}
*/
?>
</main>
</body>
</html>