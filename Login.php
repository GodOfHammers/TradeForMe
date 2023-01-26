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

// get the login id and input password from the form
$loginId=$_POST["name"];
$InputPassword =$_POST["password"];

// open connection to the database
$conn = OpenCon();

// get the password for the entered login id from the database
$DbPassword = getPassword ($conn, $loginId);

// close the connection to the database
CloseCon($conn);

echo "    <h1> Trade For Me </h1> <br><br><br>" ;

// check if the entered login id exists in the database
if ($DbPassword == "" )
{
    // if login id does not exist, display login menu and error message
	displayLoginMenu();
    echo "<br><br><center>Unknown user : " . $loginId . " <br>Please try again.</center>";

	// echo "<br>Debug: SQL query used is: " . $sql;
}
elseif ($InputPassword != $DbPassword)
{
    // if login id exists but entered password does not match, display login menu and error message
	displayLoginMenu();
    echo "<br><br><center>Password did not match for user : " . $loginId . " <br>Please try again.</center>";
}
else // User exists and passwords matched
{
    // if login id and password are correct, check if the user is admin or customer
	if ($loginId == 'admin')
	{
		// if admin, display admin menu
		displayAdminMenu($loginId);
	}
	else //if ($user_type == "customer")
	{
		// if customer, display customer menu
		displayCustomerMenu($loginId);
	}
}

// create a form to pass the login id to the next page
echo "    <form method='POST' action='Login.php' class='form_1'>" ;

// check if the input login id or password is incorrect
if ($DbPassword == "" or $InputPassword != $DbPassword)
{
    // if login id or password is incorrect, do nothing
	#displayLoginScreen();
}
// check if the login id is either admin or customer
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
	// if login id is not admin or customer, do nothing
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