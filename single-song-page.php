
<?php require_once('config.inc.php'); ?>
<?php
//tables: songs, artists, genres and types
//title, genre_name, artist_name
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT * FROM songs JOIN genres USING(genre_id) JOIN artists USING(artist_id)
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        foreach($data as $row){
            echo "Title: " . $row['title'] . " Name: " . $row['artist_name'] . " Genre: " . $row['genre_name'] . " other info: " . $row['bpm'] . "</br>";
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
?>
<!DOCTYPE html>
<html>
<body>
</body>
</html>


