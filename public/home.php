<?php
session_start();
include('../config/config.php');
// Validating Session
if(strlen($_SESSION['userlogin'])==0)
{
header('location:index.php');
}
else{
?>

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
    <title>L177L3_BR0 Demo</title>
</head>
<body>
    <header>
        <form action="output.php" method="post">
          <h1 class="text-center">Demo page</h1>
                <div class="form-group text-center">
                        <div>
                            <label for="tableval">Tabulas nosaukums</label>
                            <!-- <select class="form-control" id="tableval"> -->
                            <select class="form-control" name="tableval">
                              <option style="display:none"></option>
                              <option value="bookmarks">bookmarks</option>
                              <option value="cookies">cookies</option>
                              <option value="downloads">downloads</option>
                              <option value="forms">forms</option>
                              <option value="history">history</option>
                              <option value="search">search</option>
                            </select>
                        </div>
                        <div>
                            <label for="hostval">Resursdatora nosaukums</label>
                            <!-- <input type="text" class="form-control" id="hostval"> -->
                            <input type="text" class="form-control" name="hostval">
                        </div>
                        <div>
                            <label for="userval">Lietotāja vārds</label>
                            <!-- <input type="text" class="form-control" id="userval"> -->
                            <input type="text" class="form-control" name="userval">
                        </div>
                        <div>
                            <label for="searchval">Atslēgas vārds</label>
                            <!-- <input type="text" class="form-control" id="searchval"> -->
                            <input type="text" class="form-control" name="searchval">
                        </div>
                        <div>
                            <button id="clearbut" type="button" class="btn btn-danger">Dzēst</button>
                        </div>
                        <div>
                            <button id="searchbut" type="submit" class="btn btn-success">Meklēt</button> 
                        </div>                                         
                </div>
        </form>
    </header>
    <main id="mainid">
<?php
echo $_POST['tableval'];
echo $_POST['hostval'];
echo $_POST['userval'];
echo $_POST['searchval'];
?>
    </main>
    <!-- <footer class="text-center"><a href="https://github.com/mixnr1">mixnr1</a>(C)2019</footer> -->
</body>
</html>

<?php } ?>
