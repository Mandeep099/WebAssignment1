<!DOCTYPE html>
<html>
<body>
    <h1>Basic Song Search</h1>

    <form action = "results-page.php" metod = "GET">
        <label for = "songTitle">Title</label>
        <input type = "text" id = "songTitle" name = "songTitle">
        </br>
        <label for = "artistName">Artist</label>
        <input type = "text" id = "artistName" name = "artistName">
        </br>
        <label for = "genreName">Genre</label>
        <input type = "text" id = "genretName" name = "genreName">
        </br>
        <label for = "year">Year</label>
        <input type = "text" id = "year" name = "year">
        </br>
        <input type = "submit" value = "Search">
    </form>
</body>
</html>