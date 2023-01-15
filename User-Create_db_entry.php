<?php

include 'db_connection.php';
include 'display_titles.php';

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "";
echo "<head>";
echo "    <title> TFM : User Create</title>";
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";
echo "    <meta charset='UTF-8' name='viewport' content='width=device-width,initial-scale=1.0'>";
echo "</head>";

echo "<body>";

$loginId=$_POST["loginId"];
$name=$_POST["name"];
$fname=$_POST["fname"];
$email=$_POST["email"];
$password=$_POST["password"];

echo "    <h1> Trade For Me </h1>";
echo "<BR><BR><BR>";
displayAdminMenu ($loginId);

$conn = OpenCon();

//$sql = 'create table user (user_id smallint auto_increment primary key, user_name varchar(20) unique not null, user_fname varchar(30) not null, user_email varchar(30) not null, password varchar(20) not null);';

$sql = 'insert into user (user_type, user_id, user_name, user_email, password) values ( \'customer\', \'' . $name . '\', \'' . $fname . '\', \'' . $email . '\', \'' . $password . '\')';

//echo "Debug : Query: " . $sql . "<br>";

// run the query 
//$result = $conn->query($sql);
//if (!$result) 
//{
// Handle error
//      echo "Sorry, this website is experiencing problems.";
//      echo "Error: SQL command failed to execute, here is why: ....3 <br>";
//      echo "Query: " . $sql . "<br>";
//      echo "Errno: " . $conn->errno . "<br>";
//      echo "Error: " . $conn->error . "<br>";
//      
//      return -1;
//}
//else
//{
//    echo "<br><br><center>User " . $name . " is created successfully</center>";
//}

try {
    $result = $conn->query($sql);
    if (!$result) 
    {   
        echo "Sorry, this website is experiencing problems.";
        echo "Error: SQL command failed to execute, here is why: ....3 <br>";
        echo "Query: " . $sql . "<br>";
        echo "Errno: " . $conn->errno . "<br>";
        echo "Error: " . $conn->error . "<br>";
        return -1;
    }
    else
    {
        echo "<br><br><center>User " . $name . " is created successfully</center>";
    }
}
catch (MySQLDuplicateKeyException $e) {
    // duplicate entry exception
    $e->getMessage();
    echo "<Center>user_id already exists\n<BR>" . $conn->error . "<BR></Center>";
}
catch (MySQLException $e) {
    // other mysql exception (not duplicate key entry)
    $e->getMessage();
    echo "<Center>SQL exception\n<BR>" . $conn->error . "<BR></Center>";
}
catch (Exception $e) {
    // not a MySQL exception
    $e->getMessage();
    echo "<Center>Exception\n<BR>" . $conn->error . "<BR></Center>";
}

CloseCon($conn);

echo "    <footer>";
echo "        <ul>";
echo "            <li><a href='#'><i class='fa fa-facebook-f' aria-hidden='true' style='color:grey'> </i> </a> </li>";
echo "            <li><a href='#'><i class='fa fa-twitter' aria hidden='true' style='color:grey'> </i> </a> </li>";
echo "            <li><a href='#'><i class='fa fa-instagram' aria-hidden='true' style='color:grey'> </i> </a></li>";
echo "            <li><a href='#'><i class='fa fa-linkedin' aria-hidden='true' style='color:grey'> </i> </a></li>";
echo "        </ul>";
echo "    </footer>";

echo "</body>";

echo "</html>";


?>
