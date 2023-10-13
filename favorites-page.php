<?php
    session_start();
    function removeAll(){
        if(isset($_POST['removeAll'])){
            unset($_SESSION['Favorites']);
        } 
    }

    function removeOne(){
        if(isset($_POST['removeOne'])){
            $key = array_search($_GET['title'],$_SESSION['Favorites']);
            if($key !== false){
                unset($_SESSION['Favorites'][$key]);
                $_SESSION['Favorites'] = array_value($_SESSION['Favorites']);
            }
        }
    }
    //only keeping the first two favorite items
    if(!isset($_SESSION['Favorites'])){
        echo " ";
    }
    else{
        foreach($_SESSION['Favorites'] as $value){
            echo "My value is: " . $value . "</br>";
        }
    }

    
?>
<!DOCTYPE html>
<html>
<body>
    <form method = "POST">
        <input type = "button" id = "removeOne" name = "removeOne" value = "Remove"<?php removeOne()?>>
        <input type = "button" id = "removeAll" name = "removeAll" value = "Remove All" <?php removeAll()?>>
    </form>
</body>
</html>