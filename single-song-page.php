<?php require_once('include/config.inc.php'); ?>
<?php
try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT *
            FROM songs JOIN artists
            ON songs.artist_id = artists.artist_id
            JOIN types
            ON artist_type_id = type_id
            JOIN genres
            ON songs.genre_id = genres.genre_id
            
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        $titleInput = $_GET['hiddenInput'];
        foreach($data as $row){
            if(urldecode($titleInput) == $row['title']){
                echo "Title: " . $row['title'] . " Name: " . $row['artist_name'] . " Genre: " . $row['genre_name'] . " other info: " . $row['type_name'] . "</br>";
            }
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


