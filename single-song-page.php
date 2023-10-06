<?php require_once('config.inc.php'); ?>
<!DOCTYPE html>
<html>
<body>
<h1>Database Tester (PDO)</h1>
<?php
    try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select * from songs";
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        // loop through the data
        // while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //     echo $row['ArtistID'] . " - " . $row['LastName'] . "<br/>";
        // }

        foreach($data as $row){
            //can still use artistID here if you want to
            echo $row['title'] . "<br/>";
        }

        /*

        echo '<h2>-------- Second Loop --------</h2>';
        //this wont do anything since the previous loop has already run through it all
        //this was when the previous example was result as data
        // foreach ($result as $row) {
        //     echo $row['ArtistID'] . " - " . $row['LastName'] . "<br/>";
        // }
        foreach ($data as $row) {
            echo '<option value="' . $row['ArtistID'] . '">';
            echo $row['LastName'];
            echo "</option>";
            //echo $row['ArtistID'] . " - " . $row['LastName'] . "<br/>";
        }*/
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
?>
</body>
</html>

