<!DOCTYPE html>
<head>
    <link rel = "stylesheet" href = "css/style.css"> 
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
    <footer>
            <h4>Copyright &copy; 2023 Mandeep Bal</h4>
            <p>Github Repository: <a href = "https://github.com/Mandeep099/WebAssignment1">Repository</a>
            Github Contributors: <a href = "https://github.com/Mandeep099">Mandeep Bal</p>
    </footer>
</body>
</html>