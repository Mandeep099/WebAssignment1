<!DOCTYPE html>
<link rel = "stylesheet" href = "css/style.css"> 
<html>
<body>
    <div class = "searchForm">
        <form action = "results-page.php" metod = "GET">
            <fieldset class = serachFieldset>
                <legend>Song Search</legend>
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
            </fieldset>
        </form>
    </div>
</body>
</html>