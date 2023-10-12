<?php require_once('include/config.inc.php'); ?>
<?php
//https://www.youtube.com/watch?v=m_lQBoCefXw         
    session_start();
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT * FROM songs JOIN genres USING(genre_id) JOIN artists USING(artist_id)
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;

        if(!isset($_GET['submit']) && $_GET['songTitle'] == "" && $_GET['artistName'] == "" && $_GET['genreName'] == "" && $_GET['year'] == ""){
            foreach($data as $row){
                echo "Title: " . $row['title'] . " Artist Name: " . $row['artist_name'] . " Genre: " . $row['genre_name'] . " Year: " . $row['year'] . "</br>";
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
            $stmt->bindvalue(1, '%' . $_GET['songTitle'] . '%');
            $stmt->bindvalue(2, '%' . $_GET['artistName'] . '%');
            $stmt->bindvalue(3, '%' . $_GET['genreName'] . '%');
            $stmt->bindvalue(4, '%' . $_GET['year'] . '%');
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo = null;
             
            foreach($data as $row){
                echo $row['title'] . " " . $row['artist_name'] . " " . $row['genre_name'] . " " . $row['year'] . "</br>";  

            }
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage());
    }
    function addToFav($title, $name, $genre, $year){
            //https://stackoverflow.com/questions/60728259/how-to-push-multiple-values-to-a-session-array
            //used the above to implement the code below
            //might be the final code
        if(!isset($_SESSION['test']) && !is_array($_SESSION['test'])){
            $_SESSION['test'] = array();
        }
        array_push($_SESSION['test'], "Title: " . $title . " Artist Name: " . $name . " Genre: " . $genre . " Year: " . $year);
    }
?>
<!DOCTYPE html>
<html>
<body>
    <form action = "single-song-page.php" method = "GET">
        <!--https://stackoverflow.com/questions/2418771/remove-encoding-using-php-->
        <input type = "hidden" id = "hiddenInput" name = "hiddenInput" value = <?php echo urlencode($row['title']) ?>>
        <input type = "submit" value = "View">
    </form>
    <form action = "favorites-page.php" method = "GET">
        <input type = "button"  id = "fav" name = "fav" value = "Add To Favorites"
            <?php
                if(!isset($_GET['fav'])){
                    addToFav($row['title'], $row['artist_name'], $row['genre_name'], $row['year']);
                }
            ?>
        >
    </form>
    <a href="favorites-page.php">Add to Favorites</a>
</body>
</html>