<?php

include 'db_connection.php';
include 'display_titles.php';

echo "<!DOCTYPE html>" ;
echo "<html lang='en'>" ;

echo "<head>" ;
echo "    <title> HIMS Login </title>" ;
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>" ;
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";
echo "    <meta charset='UTF-8' name='viewport' content='width=device-width,initial-scale=1.0'>";
echo "</head>" ;

echo "<body>" ;

$loginId=$_POST["name"];
$InputPassword =$_POST["password"];

$conn = OpenCon();
$DbPassword = getPassword ($conn, $loginId);
CloseCon($conn);

echo "    <h1> Trade For Me </h1> <br><br><br>" ;

if ($DbPassword == "" )
{
	displayLoginMenu();
        echo "<br><br><center>Unknown user : " . $loginId . " <br>Please try again.</center>";

	// echo "<br>Debug: SQL query used is: " . $sql;
}
elseif ($InputPassword != $DbPassword)
{
	displayLoginMenu();
        echo "<br><br><center>Password did not match for user : " . $loginId . " <br>Please try again.</center>";
}
else // User exists and passwords matched
{

	if ($loginId == 'admin')
	{
		displayAdminMenu($loginId);
	}
	else //if ($user_type == "customer")
	{
		displayCustomerMenu($loginId);
	}
}

echo "    <form method='POST' action='Login.php' class='form_1'>" ;

if ($DbPassword == "" or $InputPassword != $DbPassword)
{
	#displayLoginScreen();
}
elseif ($loginId == "admin" || $loginId == "customer" )
{
	echo "<center>" ;
	echo "<h3> Welcome,  $loginId </h3>" ;
	echo "</center>" ; 

	echo "<input type='hidden' value=$loginId name='name' />" ;
	echo "</form>" ;
}
else
{
	#displayLoginScreen();
}

echo "    <footer>" ;
echo "        <ul>" ;
echo "            <li><a href='#'><i class='fa fa-facebook-f' aria-hidden='true' style='color:grey'> </i> </a> </li>";
echo "            <li><a href='#'><i class='fa fa-twitter' aria hidden='true' style='color:grey'> </i> </a> </li>";
echo "            <li><a href='#'><i class='fa fa-instagram' aria-hidden='true' style='color:grey'> </i> </a></li>";
echo "            <li><a href='#'><i class='fa fa-linkedin' aria-hidden='true' style='color:grey'> </i> </a></li>";
echo "        </ul>" ;
echo "    </footer>" ;
echo "</body>" ;
echo "</html>" ;



?>