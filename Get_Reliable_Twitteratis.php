
<?php

// This line includes the 'db_connection.php' file which is responsible for connecting to the database
include 'db_connection.php';

// This line includes the 'display_titles.php' file which is responsible for displaying the menu of the application
include 'display_titles.php';

// This line sets the document type to HTML
echo "<!DOCTYPE html>";

// This line sets the language of the document to English
echo "<html lang='en'>";

echo "";
echo "<head>";

// This line sets the title of the page
echo "    <title> TFM : Get Reliable Twitteratis</title>";

// These lines link the CSS stylesheets used in the application
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";

// This line links the jQuery library used in the application
echo "    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>";
echo "</head>";

// This script is responsible for handling the cancel button functionality
echo "<script>
  function cancelHandler()
  {
    myList = document.getElementsByTagName('form').elements;
    for (var i=0; i<myList.length; i++)
      myList[i].value = '';
  }

// This script is responsible for handling the change of sector and updating the company list
  function changeSector() {
    var sector = document.getElementById('sectorList').value;
    
    $.ajax({
      type: 'POST',
      url: 'Update_Companies.php',
      data: {function: 'update_company_value', value: sector},
      success: function(response) {
        document.getElementById('companies').innerHTML = response; 
      }
    });
  } 

</script>";

echo "<body>";

// This line displays the header of the application
echo "    <h1> Trade For Me </h1>";

// This line retrieves the loginId passed as a GET parameter
$loginId=$_GET["name"];
echo "<BR><BR><BR>";

// This function displays the menu of the application
displayAdminMenu ($loginId);

// This form is responsible for submitting the form data to the 'Get_Reliable_Twitteratis_POST_Action.php' file
echo "    <form method='POST' action='Get_Reliable_Twitteratis_POST_Action.php' class='form_1'>";

// This line displays the title of the page
echo "        <h3> Get Reliable Twitteratis </h3>";

// This line retrieves the first sector from the database
$first_sector = getSectorList();

if ($first_sector != "") {
  echo "<BR>";

  // check if first_sector is not empty
  // if it is not empty, proceed to the next step

  if (getCompanyList ($first_sector) != -1) {
    echo "<BR>";
    echo "        <label for=\"From\" class='required'>From &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                  <input type=\"date\" id=\"fromDate\" name=\"fromDate\" style=\"width:150px\" required><BR>";
    echo "        <label for=\"To\" class='required'>To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                  <input type=\"date\" id=\"toDate\" name=\"toDate\" style=\"width:150px\" required><BR>";

    // create label and input fields for 'From' and 'To' date
    // input fields have id and name attributes set

    echo "        <input type='hidden' id='name' name='loginId' value='" . $loginId . "'>";

    // create a hidden input field with id and name attributes set
    // the value of this input field is the loginId variable

    echo "        <button type='reset' onclick='cancelHandler()' id='reset_1'> Cancel </button>";
    echo "        <button type='submit' id='submit_1'> Submit </button><br/><br/>";

    // create buttons for 'Cancel' and 'Submit'
    // when 'Cancel' button is clicked, cancelHandler() function is called
    // when 'Submit' button is clicked, the form is submitted to the specified action URL
  }
}

echo "    </form>";

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

