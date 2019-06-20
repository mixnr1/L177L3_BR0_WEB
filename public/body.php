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
        <form method="post">
        <!-- <form action="output.php" method="post"> -->
          <h1 class="text-center">Demo page</h1>
                <div class="form-group text-center">
                        <div>
                            <label for="tableval">Tabulas nosaukums</label>
                            <!-- <select class="form-control" id="tableval"> -->
                            <select class="form-control" name="tableval">
                              <!-- <option style="display:none"></option> -->
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
    </main>
    <!-- <footer class="text-center"><a href="https://github.com/mixnr1">mixnr1</a>(C)2019</footer> -->

    <!-- include('output.php'); -->
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysql_table = $_POST['tableval'];
    $host_id = $_POST['hostval'];
    $user_id = $_POST['userval'];
    $searchterm = $_POST['searchval'];
    $some = $searchterm;
    $all_tables = ["bookmarks" => " (url LIKE '%".$some."%' OR title LIKE '%".$some."%'); ",
                    "cookies" => " (host_key LIKE '%".$some."%' OR name LIKE '%".$some."%' OR value LIKE '%".$some."%'); ",
                    "downloads" => " (link LIKE '%".$some."%' OR current_path LIKE '%".$some."%'); ",
                    "forms" => " (name LIKE '%".$some."%' OR value LIKE '%".$some."%'); ",
                    "history" => " (protocol LIKE '%".$some."%' OR domain LIKE '%".$some."%' OR link LIKE '%".$some."%'); ",
                    "search" => " (search LIKE '%".$some."%'); "];
    $query="";
    $query .= "SELECT * FROM " . $mysql_table;
    if (strlen($host_id)>0) {
        $query .= " WHERE host_id='". $host_id . "' AND";
    } else {
        $query .=" WHERE ";
    }
    if (strlen($user_id)>0) {
        $query .= " user_id='". $user_id . "' AND";
    }
    if (strlen($searchterm)>0) {

        $query .= $all_tables[$mysql_table];
    } else {
        $query .= " 1=1;";
    }

    require_once("../config/config.php");
    $tableheader = false;
    $sth = $dbh->prepare($query);
    if(!$sth->execute()) {
	    die('Error');
    }
    echo "<table>";
    while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
	    if($tableheader == false) {
		    echo '<tr>';
		    foreach($row as $key=>$value) {
			    echo "<th style='color:red'>{$key}</th>";
		    }
		    echo '</tr>';
		    $tableheader = true;
	    }
	    echo "<tr>";
	    foreach($row as $value) {
		    echo "<td style='width:150px;border:1px solid black;'>{$value}</td>";
	    }
	    echo "</tr>";
    }

    echo "</table>";
}
?>


</body>
</html>