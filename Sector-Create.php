<?php

include 'display_titles.php';

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "";
echo "<head>";
echo "    <meta charset='UTF-8' name='viewport' content='width=devive-width,initial-scale=1.0'>";
echo "    <title> TFM : Sector Create</title>";
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";
echo "</head>";

// Add the reset button function
echo "<script>
  function cancelHandler()
  {
    myList = document.getElementsByTagName('form').elements;
    for (var i=0; i<myList.length; i++)
      myList[i].value = '';
  }
</script>";

echo "<body>";

echo "    <h1> Trade For Me </h1>";

// Get the login ID
$loginId=$_GET["name"];

// Add the navigation bar
echo "<BR><BR><BR>";
displayAdminMenu ($loginId);

// Create the form for sector creation
echo "    <form method='POST' action='Sector-Create_db_entry.php' class='form_1'>";
echo "        <h3> Sector Create </h3>";

echo "        <label for='fname' class='required'> Sector Name: </label>";
echo "        <input type='text' id='name' name='name' placeholder='Enter sector name' style='margin-left:2px;' required><br/>";

// Add the login ID as a hidden field
echo "        <input type='hidden' id='name' name='loginId' value='" . $loginId . "'>";

//Button to reset the form
echo " <button type='reset' onclick='cancelHandler()' id='reset_1'> Cancel </button>";

//Button to submit the form and create a new sector
echo " <button type='submit' id='submit_1'> Submit </button><br/><br/>";

echo " </form>";

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