<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/bootstrap.css">
    <link rel="stylesheet" href="styles/home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="/scripts/vendor/jQuery.js"></script>
    <script src="scripts/index.js" defer></script>
    <title>L117L3_BR0 | Demo</title>
</head>
<body>
<?php
$username=$_SESSION['userlogin'];
$query=$dbh->prepare("SELECT  FullName FROM userdata WHERE (UserName=:username || UserEmail=:username)");
$query->execute(array(':username'=> $username));
while($row=$query->fetch(PDO::FETCH_ASSOC)){
    $username=$row['FullName'];
}
?>
<nav class="navbar">
  
  <span class="navbar-text">Login ID: <?php echo $username;?></span>
  <a href="logout.php" class="btn btn-large btn-info">Logout</a>
</nav>
    <header>
        <form method="post">
          <h1 class="text-center">Demo page</h1>
                <div class="form-group text-center">
                        <div>
                            <label for="tableval">Table name</label>
                            <select class="form-control" name="tableval">
                              <option value="bookmarks">bookmarks</option>
                              <option value="cookies">cookies</option>
                              <option value="downloads">downloads</option>
                              <option value="forms">forms</option>
                              <option value="history">history</option>
                              <option value="search">search</option>
                            </select>
                        </div>
                        <div>
                            <label for="hostval">Host ID</label>
                            <input type="text" class="form-control" name="hostval">
                        </div>
                        <div>
                            <label for="userval">User ID</label>
                            <input type="text" class="form-control" name="userval">
                        </div>
                        <div>
                            <label for="searchval">Keyword</label>
                            <input type="text" class="form-control" name="searchval">
                        </div>
                        <div>
                            <button id="clearbut" type="button" class="btn btn-danger" onclick="window.location.href = 'home.php';">Clear</button>
                        </div>
                        <div>
                            <button id="searchbut" type="submit" class="btn btn-success">Search</button> 
                        </div>                                         
                </div>
        </form>
    </header>