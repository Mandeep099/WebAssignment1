<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<body>
    <?php
        function removeAll(){
            unset($_SESSION['Favorites']);
        }
        echo "<form>";
        foreach($_SESSION["Favorites"] as $i => $r){
            //echo $i . "</br>";
            echo $r . "</br>"; 
        }
        echo "</form>";
    ?>
</body>
</html>