<?php

include 'db_connection.php';
include 'display_titles.php';

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "";
echo "<head>";
echo "    <title> TFM : Get Trade Suggestions</title>";
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

echo "<body>";

echo "    <h1> Trade For Me </h1>";

$loginId=$_GET["name"];
echo "<BR><BR><BR>";
displayCustomerMenu ($loginId);

echo "    <form method='POST' action='Get_Trade_Suggestions_POST_Action.php' class='form_1'>";

echo "        <h3> Get Trade Suggestions </h3>";

/*
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

    echo "        <label for=\"From\" class='required'>Investment &nbsp;:</label>
                <input type=\"number\" min=\"10\" max=\"10000\" step=\"1\" name=\"investment\" id=\"investment\" required=\"required\" style=\"width:150px\"> (USD) <BR>";

    echo "        <input type='hidden' id='name' name='loginId' value='" . $loginId . "'>";

    echo "        <button type='reset' onclick='cancelHandler()' id='reset_1'> Cancel </button>";
    echo "        <button type='submit' id='submit_1'> Submit </button><br/><br/>";
  }
}
*/

echo "<BR>";

echo "        <label for=\"From\" class='required'>Investment &nbsp;:</label>
            <input type=\"number\" min=\"10\" max=\"10000\" step=\"1\" name=\"investment\" id=\"investment\" required=\"required\" style=\"width:150px\"> (USD) <BR>";

echo "        <input type='hidden' id='name' name='loginId' value='" . $loginId . "'>";

echo "        <button type='reset' onclick='cancelHandler()' id='reset_1'> Cancel </button>";
echo "        <button type='submit' id='submit_1'> Submit </button><br/><br/>";


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
