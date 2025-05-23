<?php
include('shared/auth.php');
$title = 'Saving Show Updates...';
include('shared/header.php');

// capture form inputs into vars
$showId = $_POST['showId'];  // id value from hidden input on form
$name = $_POST['name'];
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

    // set up SQL UPDATE command
    $sql = "UPDATE shows SET name = :name, releaseYear = :releaseYear, 
        genre = :genre, service = :service WHERE showId = :showId";

    // link db connection w/SQL command we want to run
    $cmd = $db->prepare($sql);

    // map each input to a column in the shows table
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
    $cmd->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
    $cmd->bindParam(':genre', $genre, PDO::PARAM_STR, 20);
    $cmd->bindParam(':service', $service, PDO::PARAM_STR, 100);
    $cmd->bindParam(':showId', $showId, PDO::PARAM_INT);

    // execute the update (which saves to the db)
    $cmd->execute();

    // disconnect
    $db = null;

    // show msg to user
    echo 'Show Updated';
}
?>
</main>
</body>
</html>