<?php require_once('include/config.inc.php'); ?>
<?php
//currently displays all songs in the databasse
function topGenre(){
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT genre_name
            FROM genres JOIN songs USING(genre_id)
            GROUP BY genre_id
            ORDER BY count(song_id) DESC
            LIMIT 10
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        foreach($data as $row){
            echo $row['genre_name'] . "</br>";
        }

    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
}

function topArtist(){
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT artist_name
            FROM artists JOIN songs USING(artist_id)
            GROUP BY artist_id
            ORDER BY count(song_id) DESC
            LIMIT 10
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        foreach($data as $row){
            echo $row['artist_name'] . "</br>";
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
}

function mostPopularSongs(){
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT title, artist_name
            FROM songs JOIN artists USING(artist_id)
            GROUP BY artist_id
            ORDER BY (popularity) DESC
            LIMIT 10

        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        foreach($data as $row){
            echo $row['title'] . " " . $row['artist_name'] . "</br>";
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
}

function oneHitWonder(){
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT artist_id
            FROM songs JOIN artists USING(artist_id)
            GROUP BY title
            HAVING
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        foreach($data as $row){
            //echo  $row['title'] . " " . $row['artist_name'] . "</br>";
            echo $row['artist_id'] . "</br>";
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
}

function longestAcoustic(){
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT title
            FROM songs
            WHERE acousticness >= 40
            ORDER BY (duration) DESC
            LIMIT 10
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        foreach($data as $row){
            echo $row['title'] . "</br>";
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
}

function atTheClub(){
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT title
            FROM songs
            WHERE danceability >= 80
            ORDER BY (danceability*1.6 + energy*1.4) DESC
            LIMIT 10
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        foreach($data as $row){
            echo $row['title'] . "</br>";
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
}

function runningSongs(){
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT title
            FROM songs
            WHERE bpm BETWEEN 120 
            AND 125
            ORDER BY (energy*1.3 + valence*1.6) DESC
            LIMIT 10
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        foreach($data as $row){
            echo $row['title'] . "</br>";
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
}

function studySongs(){
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT title
            FROM songs
            WHERE bpm BETWEEN 100
            AND 115
            AND speechiness BETWEEN 1
            AND 20
            ORDER BY ((acousticness*0.8) + (100-speechiness) + (100-valence)) DESC
            LIMIT 10
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        foreach($data as $row){
            echo $row['title'] . "</br>";
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
}

    echo "top genre </br>";
    topGenre();
    echo "Top arts</br>";
    topArtist();
    echo "Popualr songs</br>";
    mostPopularSongs();
    echo "One hits </br>";
    oneHitWonder();
    echo "accoustic </br>";
    longestAcoustic();
    echo "club </br>";
    atTheClub();
    echo " running</br>";
    runningSongs();
    echo "study</br>";
    studySongs();


?>
<!DOCTYPE html>
<html>
<body>
</body>
</html>
