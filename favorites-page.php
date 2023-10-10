<?php
    $title = $_GET['hiddenTitle'];
    $name = $_GET['hiddenName'];
    $genre = $_GET['hiddenGenre'];
    $year = $_GET['hiddenYear'];

    echo "Title: " . urldecode($title) . " Name: " . urldecode($name) . " Genre: " . urldecode($genre) . " Year: " . urldecode($year);
?>
<!DOCTYPE html>
<html>
<body>
</body>
</html>