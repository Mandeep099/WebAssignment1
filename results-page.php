<?php require_once('include/config.inc.php'); ?>
<?php       
    session_start();
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
            SELECT * 
            FROM songs JOIN genres USING(genre_id) 
            JOIN artists USING(artist_id)
        ";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage());
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/style.css">
    <title>Browse</title>
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
    <section class = "center">
        <div id = "box1">
            <p>Title</p>
        </div>
        <div id = "box1">
            <p>Artist Name</p>
        </div>
        <div id = "box1">
            <p>Genre</p>
        </div>
        <div id = "box1">
            <p>Year</p>
        </div>
    </section>
            <?php
            //very very inefficent
                if($_GET['songTitle'] ==  "" && $_GET['artistName'] == "" && $_GET['genreName'] == "" && $_GET['year'] == ""){
                    ?><section class = "center"><div id = 'box2'><?php
                    foreach($data as $row){?>
                        <ul>
                        <li><?= $row['title'] ?></li>
                        </ul>
                        <?php
                    } 
                    ?></div><div id = 'box2'><?php
                    foreach($data as $row){?>
                        <ul>
                        <li><?= $row['artist_name'] ?></li>
                        </ul>
                        <?php
                    } 
                    ?></div><div id = 'box2'><?php
                    foreach($data as $row){?>
                        <ul>
                        <li><?= $row['genre_name'] ?></li>
                        </ul>
                        <?php
                    }
                    ?></div><div id = 'box2'><?php
                    foreach($data as $row){?>
                        <ul>
                        <li><?= $row['year'] ?></li>
                        </ul>
                        
                        <?php
                    }?></section><?php
            ?>

            <?php
                }
                else{
                    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "
                            SELECT * FROM songs JOIN genres USING(genre_id) 
                            JOIN artists USING(artist_id)
                            WHERE title LIKE ? 
                            AND  artist_name LIKE ? 
                            AND genre_name LIKE ? 
                            AND year LIKE ?
                        ";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindvalue(1, '%' . $_GET['songTitle']) . '%';
                    $stmt->bindvalue(2, '%' . $_GET['artistName']) . '%';
                    $stmt->bindvalue(3, '%' . $_GET['genreName']) . '%';
                    $stmt->bindvalue(4, '%' . $_GET['year']) . '%';
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $pdo = null;

                    ?><section class = "center"><div id = 'box2'><?php
                    foreach($data as $row){?>
                        <ul>
                        <li><?= $row['title'] ?></li>
                        </ul>
                        <?php
                    } 
                    ?></div><div id = 'box2'><?php
                    foreach($data as $row){?>
                        <ul>
                        <li><?= $row['artist_name'] ?></li>
                        </ul>
                        <?php
                    } 
                    ?></div><div id = 'box2'><?php
                    foreach($data as $row){?>
                        <ul>
                        <li><?= $row['genre_name'] ?></li>
                        </ul>
                        <?php
                    }
                    ?></div><div id = 'box2'><?php
                    foreach($data as $row){?>
                        <ul>
                        <li><?= $row['year'] ?></li>
                        </ul>
                        
                        <?php
                    }?></section><?php
                }
                //https://stackoverflow.com/questions/60728259/how-to-push-multiple-values-to-a-session-array
                //used the above to help implement the code below
                if(!isset($_SESSION['Favorites'])){
                    $_SESSION['Favorites'] = array();
                }
                if(is_array($_SESSION['Favorites'])){
                    array_push($_SESSION['Favorites'], "Title: " . $row['title'] . " Artist Name: " . $row['artist_name'] . " Genre: " . $row['genre_name'] . " Year: " . $row['year']);
                }
            ?>
   
        <form id = "centerID" action = "single-song-page.php" method = "GET">
            <!--https://stackoverflow.com/questions/2418771/remove-encoding-using-php-->
            <!-- used the above to help implement the code below -->
            <input type = "hidden" id = "hiddenInput" name = "hiddenInput" value = <?php echo urlencode($row['title']) ?>>
            <input type = "submit" value = "View">
        </form>
        
        <form id = "centerID" action = "favorites-page.php" method = "GET">
            <input type = "submit"  id = "fav" name = "fav" value = "Add To Favorites">
        </form>

    <footer class = "fixedFooter">
            <h4>Copyright &copy; 2023 Mandeep Bal</h4>
            <p>Github Repository: <a href = "https://github.com/Mandeep099/WebAssignment1">Repository</a>
            Github Contributors: <a href = "https://github.com/Mandeep099">Mandeep Bal</p>
    </footer>
</body>
</html>