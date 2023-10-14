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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/style.css">
    <title>Single Song</title>
</head>
<html>
<body>
    <header>
        <h2>COMP 3512 Assign 1</h2>
        <h3>Mandeep Bal</h3>
        <nav>
            <a href = "home-page.php">Home</a>
            <a href = "search-page.php">Search</a>
            <a href = "results-page.php">Browse</a>
            <a href = "about-us-page.html">About us</a>
        </nav>
    </header>
    <section>
        <div class = "container">
            <?php
                $titleInput = $_GET['hiddenInput'];
                foreach($data as $row){
                    if(urldecode($titleInput) == $row['title']){
                        //echo "Title: " . $row['title'] . " Name: " . $row['artist_name'] . " Genre: " . $row['genre_name'] . " other info: " . $row['type_name'] . "</br>";
                ?>
            <div class = "rectangle">Title: <?= $row['title'] ?></div>
            <div class = "boxLeft">
                <ul>
                    <li class = "fontChange">Artist Name: <div id = "fontChange2"><?= $row['artist_name'] ?></div></li>
                    <li class = "fontChange">Genre Name: <div id = "fontChange2"><?= $row['genre_name'] ?></div></li>
                    <li class = "fontChange">Artist Type: <div id = "fontChange2"><?= $row['type_name'] ?></div></li>
                    <li class = "fontChange">Song Release Year: <div id = "fontChange2"><?= $row['year'] ?></div></li>
                </ul>
            </div>
            <div class = "boxRight">
                <ul>
                    <li class = "fontChange">BPM: <?= $row['bpm'] ?></li>
                    <li class = "fontChange">Energy: <progress value = <?= $row['energy'] ?> max = "100"></progress></li>
                    <li class = "fontChange">Danceability: <progress value = <?= $row['danceability'] ?> max = "100"></progress></li>
                    <li class = "fontChange">Liveness: <progress value = <?= $row['liveness'] ?> max = "100"></progress></li>
                    <li class = "fontChange">Valence: <progress value = <?= $row['valence'] ?> max = "100"></progress></li>
                    <li class = "fontChange">Acousticness: <progress value = <?= $row['acousticness'] ?> max = "100"></progress></li>
                    <li class = "fontChange">Speechiness: <progress value = <?= $row['speechiness'] ?> max = "100"></progress></li>
                    <li class = "fontChange">popularity: <progress value = <?= $row['popularity'] ?> max = "100"></progress></li>
                    <li class = "fontChange">Duration: <?= round($row['duration']/60, 2)?></li>
                </ul>
            </div>
            <?php
                    }
                }
            ?>
        </div>
    </section>
    <footer>
            <h4>Copyright &copy; 2023 Mandeep Bal</h4>
            <p>Github Repository: <a href = "https://github.com/Mandeep099/WebAssignment1">Repository</a>
            Github Contributors: <a href = "https://github.com/Mandeep099">Mandeep Bal</p>
    </footer>
</body>
</html>


