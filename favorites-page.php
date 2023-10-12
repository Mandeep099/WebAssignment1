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

        foreach($_SESSION['test'] as $value){
            echo "My value is: " . $value . "</br>";
        }

    ?>
</body>
</html>