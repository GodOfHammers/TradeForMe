<?php

//Include display_titles.php file
include 'display_titles.php';

//Print the doctype, html start tag and head tag
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "";
echo "<head>";

//Set meta tags, title, link to css file and link to google fonts
echo "    <meta charset='UTF-8' name='viewport' content='width=devive-width,initial-scale=1.0'>";
echo "    <title> TFM : Password Modify</title>";
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";
echo "</head>";

echo "<script>
  function cancelHandler()
  {
    myList = document.getElementsByTagName('form').elements;
    for (var i=0; i<myList.length; i++)
      myList[i].value = '';
  }
</script>";

//Print opening body tag
echo "<body>";

//Print the title in an h1 tag
echo "    <h1> Trade For Me </h1>";

//Store the name from the GET request into a local variable
$loginId=$_GET["name"];

//Print breaks
echo "<BR><BR><BR>";

//Check if the name is equal to "admin"
if ($loginId === 'admin')
{
    //If the name is equal to "admin" call the displayAdminMenu function
    displayAdminMenu ($loginId);
}
//Otherwise
else
{
    //Call the displayCustomerMenu function
    displayCustomerMenu ($loginId);
}

//Print a form with a method of POST, an action of Password-Modify_db_entry.php, and a class of form_1
echo "    <form method='POST' action='Password-Modify_db_entry.php' class='form_1'>";
echo "        <h3> Modify Password </h3>";
echo "        <label for='cpassword' class='required'> Current Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>";
echo "        <input type='password' id='cpassword' name='cpassword' placeholder='Current password' style='margin-left:3px;' required><br/>";

// Print a label and input for the new password field
echo "        <label for='npassword' class='required'> Enter New Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>";
echo "        <input type='password' id='npassword' name='npassword' placeholder='New password' style='margin-left:3px;' required><br/>";

// Print a label for the re-enter new password field
echo "    <label for='rnpassword' class='required'> Re-enter New Password: </label>";

// Print an input for the re-enter new password field
echo "    <input type='password' id='rnpassword' name='rnpassword' placeholder='New password' style='margin-left:3px;' required><br/>";

// Print a hidden input for the loginId field
echo "    <input type='hidden' id='name' name='loginId' value='" . $loginId . "'>";

// Print a reset button with a cancelHandler function
echo "    <button type='reset' onclick='cancelHandler()' id='reset_1'> Cancel </button>";

// Print a submit button
echo "    <button type='submit' id='submit_1'> Submit </button><br/><br/>";
echo "</form>";

//Footer section with social media links
echo " <footer>";
echo " <ul>";
echo " <li><a href='#'><i class='fa fa-facebook-f' aria-hidden='true' style='color:grey'> </i> </a> </li>";
echo " <li><a href='#'><i class='fa fa-twitter' aria hidden='true' style='color:grey'> </i> </a> </li>";
echo " <li><a href='#'><i class='fa fa-instagram' aria-hidden='true' style='color:grey'> </i> </a></li>";
echo " <li><a href='#'><i class='fa fa-linkedin' aria-hidden='true' style='color:grey'> </i> </a></li>";
echo " </ul>";
echo " </footer>";

//Closing body and html tags
echo "</body>";
echo "</html>";

?>
