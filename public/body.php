
    <main id="mainid">
    </main>
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
    
    $countq="";
    $countq .= "SELECT count(*) FROM " . $mysql_table;
    if (strlen($host_id)>0) {
        $countq .= " WHERE host_id='". $host_id . "' AND";
    } else {
        $countq .=" WHERE ";
    }
    if (strlen($user_id)>0) {
        $countq .= " user_id='". $user_id . "' AND";
    }
    if (strlen($searchterm)>0) {

        $countq .= $all_tables[$mysql_table];
    } else {
        $countq .= " 1=1;";
    }
    $csth = $dbh->prepare($countq);
    if(!$csth->execute()) {
	    die('Error');
    }
    while($row = $csth->fetch(PDO::FETCH_ASSOC)) {
        foreach($row as $key=>$value) {
            echo 'Search results for '. $mysql_table . '. Hit count: '. $value . '<br>';
        }
    }

    $tableheader = false;
    $sth = $dbh->prepare($query);
    if(!$sth->execute()) {
	    die('Error');
    }
    echo "<table class='table w-auto table-bordered'>";
    while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
	    if($tableheader == false) {
		    echo '<tr>';
		    foreach($row as $key=>$value) {
			    echo "<th>{$key}</th>";
		    }
		    echo '</tr>';
		    $tableheader = true;
	    }
	    echo "<tr>";
	    foreach($row as $value) {
            echo "<td>{$value}</td>";
	    }
	    echo "</tr>";
    }

    echo "</table>";
}
?>


</body>
</html>