<?php

include 'db_connection.php';
include 'display_titles.php';

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "";
echo "<head>";
echo "    <title> TFM : Password Modify</title>";
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";
echo "    <meta charset='UTF-8' name='viewport' content='width=device-width,initial-scale=1.0'>";
echo "</head>";

echo "<body>";

$loginId=$_POST["loginId"];
$cpassword=$_POST["cpassword"];
$npassword=$_POST["npassword"];
$rnpassword=$_POST["rnpassword"];

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


$conn = OpenCon();

//check if the current password is matching the DB current password
$DbPassword = getPassword ($conn, $loginId);
CloseCon($conn);
if ($cpassword != $DbPassword)
{
    echo "<CENTER><BR>Current password is not matching <BR></CENTER>";
    return -1;
}
//check if the new password is same as re-entered new password
if ($npassword != $rnpassword)
{
    echo "<CENTER><BR>New passwords are not matching <BR></CENTER>";
    return -1;
}

//If above two conditions are matching, validate the password basic qualities (no space, atleast 1 special character, ...)

//If above three conditions are matching, update the existing DB password value with the new password given on screen.

$conn = OpenCon();
$sql = 'update user set password=\'' . $rnpassword . '\' where user_id=\'' . $loginId . '\';';

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
        echo "<br><br><center>User password is updated successfully</center>";
    }
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
