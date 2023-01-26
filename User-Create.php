<?php

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

// create the meta element with charset and viewport attributes
echo "    <meta charset='UTF-8' name='viewport' content='width=devive-width,initial-scale=1.0'>";

// create the title element
echo "    <title> TFM : User Create</title>";

// create the link element for the css file
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";

// create the link element for the google fonts
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";

// create the link element for font-awesome
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";

// close the head element
echo "</head>";

// create the script element
echo "<script>
  // function to reset the form fields when the cancel button is clicked
  function cancelHandler()
  {
    // get all the form elements
    myList = document.getElementsByTagName('form').elements;
    // loop through the form elements
    for (var i=0; i<myList.length; i++)
      // set the value of each element to an empty string
      myList[i].value = '';
  }
</script>";

// create the body element
echo "<body>";

// create the h1 element
echo "    <h1> Trade For Me </h1>";

// get the value of the name parameter from the GET request
$loginId=$_GET["name"];

// create line break elements
echo "<BR><BR><BR>";

// call the displayAdminMenu function and pass in the loginId variable
displayAdminMenu ($loginId);

// create the form element with a method of POST and action of User-Create_db_entry.php
echo "    <form method='POST' action='User-Create_db_entry.php' class='form_1'>";

// create the h3 element
echo "        <h3> User Create </h3>";

// create the label element for the user id field
echo "        <label for='name' class='required'> User Id &nbsp;&nbsp;&nbsp;: </label>";

// create the input element for the user id field
echo "        <input type='text' id='name' name='name' placeholder='Enter user id' required><br/>";

// create the label element for the full name field
echo "        <label for='fname' class='required'> Full Name: </label>";

// create the input element for the full name field
echo "        <input type='text' id='name' name='fname' placeholder='Enter full name' style='margin-left:2px;' required><br/>";

// create the label element for the email field
echo " <label for='email' class='required'> Email Id  : </label>";

// create the input element for the email field
echo " <input type='email' id='name' name='email' placeholder='Enter email Id' style='margin-left:8px;' required><br>";

// create the label element for the password field
echo " <label for='password' class='required'> Password: </label>";

// create the input element for the password field
echo " <input type='password' id='password' name='password' placeholder='Enter password' style='margin-left:3px;' required><br/>";

// create a hidden input element to store the loginId value
echo " <input type='hidden' id='name' name='loginId' value='" . $loginId . "'>";

// create the cancel button element
echo " <button type='reset' onclick='cancelHandler()' id='reset_1'> Cancel </button>";

// create the submit button element
echo " <button type='submit' id='submit_1'> Submit </button><br/><br/>";

// close the form element
echo " </form>";

// create the footer element
echo " <footer>";

// create an unordered list element
echo " <ul>";

// create list item elements with links to social media icons
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