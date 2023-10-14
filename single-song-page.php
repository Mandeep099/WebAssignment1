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


    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
?>
<!DOCTYPE html>
<link rel = "stylesheet" href = "css/style.css">
<html>
<body>
    <div class = "container">
        <?php
            $titleInput = $_GET['hiddenInput'];
            foreach($data as $row){
                if(urldecode($titleInput) == $row['title']){
                    //echo "Title: " . $row['title'] . " Name: " . $row['artist_name'] . " Genre: " . $row['genre_name'] . " other info: " . $row['type_name'] . "</br>";
            ?>
        <div class = "rectangle">Title</div>
        <div class = "boxLeft">
            <ul>
                <li>Artist Name: <?= $row['title'] ?></li>
                <li>Genre Name: <?= $row['genre_name'] ?></li>
                <li>Artist Type: <?= $row['type_name'] ?></li>
                <li>Song Release Year: <?= $row['year'] ?></li>
            </ul>
        </div>
        <div class = "boxRight">
            <ul>
                <li>BPM: <?= $row['bpm'] ?></li>
                <li>Energy: <progress value = <?= $row['energy'] ?> max = "100"></progress></li>
                <li>Danceability: <progress value = <?= $row['danceability'] ?> max = "100"></progress></li>
                <li>Liveness: <progress value = <?= $row['liveness'] ?> max = "100"></progress></li>
                <li>Valence: <progress value = <?= $row['valence'] ?> max = "100"></progress></li>
                <li>Acousticness: <progress value = <?= $row['acousticness'] ?> max = "100"></progress></li>
                <li>Speechiness: <progress value = <?= $row['speechiness'] ?> max = "100"></progress></li>
                <li>popularity: <progress value = <?= $row['popularity'] ?> max = "100"></progress></li>
                <li>Duration: <?= round($row['duration']/60, 2)?></li>
            </ul>
        </div>
        <?php
                }
            }
        ?>


    </div>
</body>
</html>


