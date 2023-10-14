<?php require_once('include/config.inc.php'); ?>
<?php
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

        echo "<ul class = 'centerText'>";
        foreach($data as $row){
            echo "<li>";
            echo $row['genre_name'] . "</br>";
            echo "</li>";
        }
        echo "</ul>";

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

        echo "<ul class = 'centerText'>";
        foreach($data as $row){
            echo "<li>";
            echo $row['artist_name'] . "</br>";
            echo "</li>";
        }
        echo "</ul>";
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

        echo "<ul class = 'centerText'>";
        foreach($data as $row){
            echo "<li>";
            echo $row['title'] . " <em>" . $row['artist_name'] . "</em></br>";
            echo "</li>";
        }
        echo "</ul>";
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
            SELECT  *
            FROM songs JOIN artists USING(artist_id)
            GROUP BY artist_id
            HAVING COUNT(artist_id) <= 1
            LIMIT 10
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        echo "<ul class = 'centerText'>";
        foreach($data as $row){
            echo "<li>";
            echo  $row['title'] . " " . $row['artist_name'] . "</br>";
            echo "</li>";
        }
        echo "</ul>";
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

        echo "<ul class = 'centerText'>";
        foreach($data as $row){
            echo "<li>";
            echo $row['title'] . "</br>";
            echo "</li>";
        }
        echo "</ul>";
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

        echo "<ul class = 'centerText'>";
        foreach($data as $row){
            echo "<li>";
            echo $row['title'] . "</br>";
            echo "</li>";
        }
        echo "</ul>";
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
        echo "<ul class = 'centerText'>";
        foreach($data as $row){
            echo "<li>";
            echo $row['title'] . "</br>";
            echo "</li>";
        }
        echo "</ul>";
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

        echo "<ul class = 'centerText'>";
        foreach($data as $row){
            echo "<li>";
            echo $row['title'] . "</br>";
            echo "</li>";
        }
        echo "</ul>";
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/style.css">
    <title>Home</title>>
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
        <div class = "gridContainer">
            <div class = "gridItem"><h3 class = "centerText">Top 10 Genres</h3><?= topGenre() ?></div>
            <div class = "gridItem"><h3 class = "centerText">Top 10 Artists</h3><?= topArtist() ?></div>
            <div class = "gridItem"><h3 class = "centerText">Top 10 Songs</h3><?= mostPopularSongs() ?></div>
            <div class = "gridItem"><h3 class = "centerText">Top 10 One Hits</h3><?= oneHitWonder() ?></div>
            <div class = "gridItem"><h3 class = "centerText">Long Acoustic</h3><?= longestAcoustic() ?></div>
            <div class = "gridItem"><h3 class = "centerText">Club Music</h3><?= atTheClub() ?></div>
            <div class = "gridItem"><h3 class = "centerText">Exercise Music</h3><?= runningSongs() ?></div>
            <div class = "gridItem"><h3 class = "centerText">Study Music</h3><?= studySongs() ?></div>
        </div>
    <footer>
        <h4>Copyright &copy; 2023 Mandeep Bal</h4>
        <p>Github Repository: <a href = "https://github.com/Mandeep099/WebAssignment1">Repository</a>
        Github Contributors: <a href = "https://github.com/Mandeep099">Mandeep Bal</p>
    </footer>
</body>
</html>
