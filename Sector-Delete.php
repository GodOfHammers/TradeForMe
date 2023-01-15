<?php

include 'db_connection.php';
include 'display_titles.php';

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "";
echo "<head>";
echo "    <title> TFM : Sector Delete</title>";
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
displayAdminMenu ($loginId);

echo "    <form method='POST' action='Sector-Delete_confirm.php' class='form_1'>";

echo "        <h3> Sector Delete </h3>";

if (getSectorList()!= -1)
{
  echo "        <input type='hidden' id='name' name='loginId' value= '" . $loginId . "'>";

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
}
echo "</body>";

echo "</html>";


?>
