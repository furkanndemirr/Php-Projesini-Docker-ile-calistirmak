<!DOCTYPE html>
<html lang="en">
<head>
<title>Show databases in MySQL server</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Show databases in MySQL serverbenburdayımşimdiyokum</h1>
<?php

getenv('MYSQL_DBHOST') ? $db_host=getenv('MYSQL_DBHOST') : $db_host="localhost";
getenv('MYSQL_DBPORT') ? $db_port=getenv('MYSQL_DBPORT') : $db_port="3306";
getenv('MYSQL_DBUSER') ? $db_user=getenv('MYSQL_DBUSER') : $db_user="root";
getenv('MYSQL_DBPASS') ? $db_pass=getenv('MYSQL_DBPASS') : $db_pass="";
getenv('MYSQL_DBNAME') ? $db_name=getenv('MYSQL_DBNAME') : $db_name="dbtest";

if (strlen( $db_name ) === 0)
  $conn = new mysqli("$db_host:$db_port", $db_user, $db_pass);
else 
  $conn = new mysqli("$db_host:$db_port", $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) 
	die("Connection failed: " . $conn->connect_error);
 
if (!($result=mysqli_query($conn,'SELECT * FROM testtbl')))
    printf("Error: %s\n", mysqli_error($conn));

echo "<h3>Databases</h3>";

while($row = mysqli_fetch_row( $result ))
    echo $row[0]."<br />";

$result -> free_result();

?>
<div class="div">

    <form action="?task=insert" method="post"">
        <br><br><br>
        <td>Name :
            <input type="text" name="uname">
        </td>
            <input type="submit" value="Submit" style="margin-right: 15px">
        </td>
    </form>
</div>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST" and  $_REQUEST['task']=="insert")
{
    $ID = $_REQUEST['id'];
    $uname=$_REQUEST['uname'];
    $sql = "INSERT INTO testtbl (name)
    VALUES ('$uname')";
    mysqli_query($conn,$sql);
}
?>

    <table>
        <?php
        echo "<br>";
        $sql=" SELECT * from testtbl" ;
        foreach ($conn->query($sql) as $satir) {
            ?>
            <tr>
                <th><?=$satir['name']?></th>
                <th><a id="deletebutton" href="sil.php?id=<?php echo $satir['id'];?>">DELETE</a></th>
                <th><a id="deletebutton" href="update.php?id=<?php echo $satir['id'];?>">UPDATE</a></th>
            </tr>

            <?php
        }
        ?>
    </table>
<?php
$conn->close();
?>
</div>
</body>
</html>