<?php require_once('config.inc.php'); ?>
<?php
    $title = $_GET['songTitle'];
    $name = $_GET['artistName'];
    $genre = $_GET['genreName'];
    $year = $_GET['year'];
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT * FROM songs JOIN genres USING(genre_id) JOIN artists USING(artist_id)
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        if(!isset($_GET['submit']) && $title == "" && $name == "" && $genre == "" && $year == ""){
            foreach($data as $row){
                echo "Title: " . $row['title'] . " Name: " . $row['artist_name'] . " Genre: " . $row['genre_name'] . " other info: " . $row['bpm'] . "</br>";
            }
        }
        else{
            $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "
                SELECT * FROM songs JOIN genres USING(genre_id) JOIN artists USING(artist_id)
                WHERE title LIKE ? AND  artist_name LIKE ? AND genre_name LIKE ? AND year LIKE ?
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindvalue(1, '%' . $title . '%');
            $stmt->bindvalue(2, '%' . $name . '%');
            $stmt->bindvalue(3, '%' . $genre . '%');
            $stmt->bindvalue(4, '%' . $year . '%');
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo = null;

            foreach($data as $row){
                echo $row['title'] . " " . $row['artist_name'] . " " . $row['genre_name'] . " " . $row['year'] . "</br>";
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