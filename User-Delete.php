<?php

// Include the display_titles.php file for the displayAdminMenu function
include 'display_titles.php';

// Start the HTML document with the doctype declaration
echo "<!DOCTYPE html>";

// Start the HTML document and set the language to English
echo "<html lang='en'>";

// Leave an empty line
echo "";

// Start the head section of the HTML document
echo "<head>";

// Set the title of the page to "TFM: User Delete"
echo "    <title> TFM : User Delete</title>";

// Link to the CSS stylesheet for the page
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";

// Link to a font from Google Fonts
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";

// Link to a font from Bootstrap CDN
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";

// Close the head section of the HTML document
echo "</head>";

// Add a JavaScript function to handle the cancel button
echo "<script>
  function cancelHandler()
  {
    myList = document.getElementsByTagName('form').elements;
    for (var i=0; i<myList.length; i++)
      myList[i].value = '';
  }
</script>";

// Start the body section of the HTML document
echo "<body>";

// Add the header of the page
echo "    <h1> Trade For Me </h1>";

// Get the loginId from the GET request
$loginId=$_GET["name"];

// Add some blank lines for spacing
echo "<BR><BR><BR>";

// Call the displayAdminMenu function and pass in the loginId
displayAdminMenu ($loginId);

// Start a form for deleting a user
echo "    <form method='POST' action='User-Delete_confirm.php' class='form_1'>";

// Add a heading for the form
echo "        <h3> User Delete </h3>";

// Add a label and input field for the user id
echo "        <label for='name' class='required'> User Id &nbsp;&nbsp;: </label>";
echo "        <input type='text' id='name' name='name' placeholder='Enter user id' required><br/>";

// Add a hidden input field for the loginId
echo "        <input type='hidden' id='name' name='loginId' value='" . $loginId . "'>";

// Add a cancel button that resets the form
echo "        <button type='reset' onclick='cancelHandler()' id='reset_1'> Cancel </button>";

// Add a submit button for the form
echo "        <button type='submit' id='submit_1'> Submit </button><br/><br/>";

// Close the form
echo "    </form>";

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
