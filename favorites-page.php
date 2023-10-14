<?php
    session_start();
    function removeAll(){
        if(isset($_POST['removeAll'])){
            unset($_SESSION['Favorites']);
        } 
    }
    //https://stackoverflow.com/questions/2231332/how-to-remove-a-variable-from-a-php-session-array
    //used the above to implement the removeOne function
    function removeOne(){
        if(isset($_POST['removeOne'])){
            $key = array_search($_GET['title'],$_SESSION['Favorites']);
            if($key !== false){
                unset($_SESSION['Favorites'][$key]);
                $_SESSION['Favorites'] = array_value($_SESSION['Favorites']);
            }
        }
    }   
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/style.css">
    <title>Favorites</title>
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
        <div class = "container">
            <?php
                if(!isset($_SESSION['Favorites'])){
                    echo " ";
                }
                else{
                    ?><div id = "box3"><?php
                    foreach($_SESSION['Favorites'] as $value){  
                    ?>  
                            <ul>
                                <li><?= $value?></li>
                            </ul>
                    <?php
                    }
                    ?></div><?php
                }
            ?>
        </div>
    </section>
    <form id = "centerID" method = "POST">
        <input type = "button" id = "removeOne" name = "removeOne" value = "Remove"<?php removeOne()?>>
        <input type = "button" id = "removeAll" name = "removeAll" value = "Remove All" <?php removeAll()?>>
    </form>
    <footer>
            <h4>Copyright &copy; 2023 Mandeep Bal</h4>
            <p>Github Repository: <a href = "https://github.com/Mandeep099/WebAssignment1">Repository</a>
            Github Contributors: <a href = "https://github.com/Mandeep099">Mandeep Bal</p>
    </footer>
</body>
</html>