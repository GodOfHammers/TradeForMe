<?php

// include the db_connection.php file
include 'db_connection.php';

// include the display_titles.php file
include 'display_titles.php';

// create the DOCTYPE element
echo "<!DOCTYPE html>";

// create the html element with a language attribute
echo "<html lang='en'>";

// create a new line
echo "";

// create the head element
echo "<head>";

// create the title element
echo "    <title> TFM : User Create</title>";

// create the link element for the css file
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";

// create the link element for the google fonts
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";

// create the link element for font-awesome
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";

// create the meta element with charset and viewport attributes
echo "    <meta charset='UTF-8' name='viewport' content='width=device-width,initial-scale=1.0'>";

// close the head element
echo "</head>";

// create the body element
echo "<body>";

// store the loginId value from the POST request in a variable
$loginId=$_POST["loginId"];

// store the name value from the POST request in a variable
$name=$_POST["name"];

// store the fname value from the POST request in a variable
$fname=$_POST["fname"];

// store the email value from the POST request in a variable
$email=$_POST["email"];

// store the password value from the POST request in a variable
$password=$_POST["password"];

// create the heading element for the page
echo " <h1> Trade For Me </h1>";

// create line breaks
echo "<BR><BR><BR>";

// call the displayAdminMenu function and pass in the loginId variable
displayAdminMenu ($loginId);

// open a connection to the database
$conn = OpenCon();

// create the sql query to insert a new user into the user table
$sql = 'insert into user (user_type, user_id, user_name, user_email, password) values ( 'customer', '' . $name . '', '' . $fname . '', '' . $email . '', '' . $password . '')';

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

// use a try-catch block to handle any potential exceptions
try {
    // run the query
    $result = $conn->query($sql);
    // check if the query was successful
    if (!$result) 
    {   
        // if the query was not successful, display an error message
        echo "Sorry, this website is experiencing problems.";
        echo "Error: SQL command failed to execute, here is why: ....3 <br>";
        echo "Query: " . $sql . "<br>";
        echo "Errno: " . $conn->errno . "<br>";
        echo "Error: " . $conn->error . "<br>";
        return -1;
    }
    else
    {
        // if the query was successful, display a success message
        echo "<br><br><center>User " . $name . " is created successfully</center>";
    }

}

catch (MySQLDuplicateKeyException $e) {
// handle duplicate entry exception
$e->getMessage();
echo "<Center>user_id already exists\n<BR>" . $conn->error . "<BR></Center>";
}
catch (MySQLException $e) {
// handle other mysql exception (not duplicate key entry)
$e->getMessage();
echo "<Center>SQL exception\n<BR>" . $conn->error . "<BR></Center>";
}
catch (Exception $e) {
// handle other exceptions
$e->getMessage();
echo "<Center>Exception\n<BR>" . $conn->error . "<BR></Center>";
}

// close the connection to the database
CloseCon($conn);

// create the footer element
echo " <footer>";

// create the unordered list element
echo " <ul>";
// create the list item for the Facebook link with a font-awesome icon
echo " <li><a href='#'><i class='fa fa-facebook-f' aria-hidden='true' style='color:grey'> </i> </a> </li>";

// create the list item for the Twitter link with a font-awesome icon
echo " <li><a href='#'><i class='fa fa-twitter' aria hidden='true' style='color:grey'> </i> </a> </li>";

// create the list item for the Instagram link with a font-awesome icon
echo " <li><a href='#'><i class='fa fa-instagram' aria-hidden='true' style='color:grey'> </i> </a></li>";

// create the list item for the LinkedIn link with a font-awesome icon
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