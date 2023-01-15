<?php

include 'db_connection.php';
include 'display_titles.php';

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "";
echo "<head>";
echo "    <title> TFM : Get Reliable Twitteratis</title>";
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";
echo "    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>";
echo "</head>";

echo "<script>
  function cancelHandler()
  {
    myList = document.getElementsByTagName('form').elements;
    for (var i=0; i<myList.length; i++)
      myList[i].value = '';
  }

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

echo "    <h1> Trade For Me </h1>";

$loginId=$_GET["name"];
echo "<BR><BR><BR>";
displayAdminMenu ($loginId);

echo "    <form method='POST' action='Get_Reliable_Twitteratis_POST_Action.php' class='form_1'>";

echo "        <h3> Get Reliable Twitteratis </h3>";

$first_sector = getSectorList();

if ($first_sector != "")
{
  echo "<BR>";

  // **** More to be implemented
  // For each selection change of sector name, corresponding company names to be displayed
  // by fetching them from DB.
  //

  if (getCompanyList ($first_sector) != -1)
  {
    echo "<BR>";
    echo "        <label for=\"From\" class='required'>From &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                  <input type=\"date\" id=\"fromDate\" name=\"fromDate\" style=\"width:150px\" required><BR>";
    echo "        <label for=\"To\" class='required'>To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                  <input type=\"date\" id=\"toDate\" name=\"toDate\" style=\"width:150px\" required><BR>";

    echo "        <input type='hidden' id='name' name='loginId' value='" . $loginId . "'>";

    echo "        <button type='reset' onclick='cancelHandler()' id='reset_1'> Cancel </button>";
    echo "        <button type='submit' id='submit_1'> Submit </button><br/><br/>";

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
