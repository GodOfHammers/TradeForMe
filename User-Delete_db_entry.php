<?php

include 'db_connection.php';
include 'display_titles.php';

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "";
echo "<head>";
echo "    <title> TFM : User Delete</title>";
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";
echo "    <meta charset='UTF-8' name='viewport' content='width=device-width,initial-scale=1.0'>";
echo "</head>";

echo "<body>";

$loginId=$_POST["loginId"];
$name=$_POST["name"];

echo "    <h1> Trade For Me </h1>";
echo "<BR><BR><BR>";
if ($loginId === 'admin')
{
    displayAdminMenu ($loginId);
}
else
{
    displayCustomerMenu ($loginId);
}

//connect to the database
$conn = OpenCon();

//create and execute the delete query
$sql = 'delete from user where user_id=\'' . $name . '\';';
if (!$result = $conn->query($sql)) 
{
    //if query fails, display an error message
    echo "Sorry, this website is experiencing problems.";
    echo "Error: Query failed to execute, here is why: <br>";
    echo "Query: " . $sql . "<br>";
    echo "Errno: " . $conn->errno . "<br>";
    echo "Error: " . $conn->error . "<br>";
}
else 
{
    //if query is successful, display a success message
    echo "<br><br><center>User '" . $name . "' is deleted successfully</center>";
}

//close the connection
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
