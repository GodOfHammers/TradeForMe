<?php

// include the db_connection.php file which contains the OpenCon and CloseCon functions
include 'db_connection.php';

// include the display_titles.php file which contains the displayAdminMenu function
include 'display_titles.php';

// create a DOCTYPE html element
echo "<!DOCTYPE html>";

// create an html element with the 'en' language attribute
echo "<html lang='en'>";

// create an empty line
echo "";

// create a head element
echo "<head>";

// create a title element with the title "TFM : Sector Delete"
echo "    <title> TFM : Sector Delete</title>";

// link the tfm.css stylesheet
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";

// link the 'Fjalla One' font from Google Fonts
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";

// link the font-awesome stylesheet
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";

// set the character set to UTF-8 and set the viewport to the device width with an initial scale of 1.0
echo "    <meta charset='UTF-8' name='viewport' content='width=device-width,initial-scale=1.0'>";

// close the head element
echo "</head>";

// create a body element
echo "<body>";

// store the loginId and name values from the POST request in variables
$loginId=$_POST["loginId"];
$name=$_POST["name"];

// create an h1 element with the text "Trade For Me"
echo "    <h1> Trade For Me </h1>";

// create line breaks
echo "<BR><BR><BR>";

// call the displayAdminMenu function and pass in the loginId variable
displayAdminMenu ($loginId);

// open a database connection using the OpenCon function
$conn = OpenCon();

// create the SQL query to delete a row from the sector table where the sector_name matches the input name
$sql = 'delete from sector where sector_name=\'' . $name . '\';';

// run the query and store the result in a variable
if (!$result = $conn->query($sql)) 
{
    // if the query fails, display an error message
    echo "Sorry, this website is experiencing problems.";
    echo "Error: Query failed to execute, here is why: <br>";
    echo "Query: " . $sql . "<br>";
    echo "Errno: " . $conn->errno . "<br>";
    echo "Error: " . $conn->error . "<br>";
}
else 
{
    // if the query is successful, display a success message
    echo "<br><br><center>Sector '" . $name . "' is deleted successfully</center>";
}

// close the database connection using the CloseCon function
CloseCon($conn);

// create a footer element
echo " <footer>";

// create an unordered list element
echo " <ul>";

// create list items with links to social media icons using font-awesome
echo " <li><a href='#'><i class='fa fa-facebook-f' aria-hidden='true' style='color:grey'> </i> </a> </li>";
echo " <li><a href='#'><i class='fa fa-twitter' aria hidden='true' style='color:grey'> </i> </a> </li>";
echo " <li><a href='#'><i class='fa fa-instagram' aria-hidden='true' style='color:grey'> </i> </a></li>";
echo " <li><a href='#'><i class='fa fa-linkedin' aria-hidden='true' style='color:grey'> </i> </a></li>";

// close the unordered list element
echo " </ul>";

// close the footer element
echo " </footer>";

// close the body element
echo "</body>";

// close the html element
echo "</html>";

?>

