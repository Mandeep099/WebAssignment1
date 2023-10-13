<?php require_once('include/config.inc.php'); ?>
<?php
//currently displays all songs in the databasse
// SELECT *
// FROM artists LEFT OUTER JOIN types
// WHERE artist_type_id == type_id;   
// JOIN songs USING(artist_id)
// JOIN genres USING(genre_id)

//everything works but the title
// SELECT *
// FROM songs JOIN genres USING(genre_id)
// JOIN artists JOIN types
// WHERE artist_type_id = type_id 

//working one
// SELECT *
// FROM songs JOIN genres USING(genre_id)
// JOIN artists LEFT OUTER JOIN types
// WHERE artist_type_id == type_id 
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


