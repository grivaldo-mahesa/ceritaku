<?php
mysql_connect("localhost","root","") or die("could not connect");
mysql_select_db("www_project") or die("could not find db!");
$output ='';

//collect
if (isset($_POST['search'])){
    $searchq = $_POST['search'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
    $query = mysql_query("SELECT * FROM personal_info WHERE FirstName LIKE '%$searchq%' OR SurName LIKE '%$searchq%'") or die("could not search");
    $count = mysql_num_rows($query);
    if($count == 0){
        $output = 'There was no search results!';
    }else{
        while($row = mysql_fetch_array($query)){
            $fname = $row['FirstName'];
            $lname = $row['SurName'];
            $id = $row['id'];

            $output .= '<div>'.$fname.''.$lname.'</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
</head>
<body>
    <form method="post" action="search.php"></form>
        <input type="text" name="search" placeholder="Search for student">
        <input type="submit" value="Submit">
</body>
</html>

<?php print("$output");?>