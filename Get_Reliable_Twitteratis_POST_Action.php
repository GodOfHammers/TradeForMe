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

$loginId=$_GET["loginId"];

echo "<BR><BR><BR>";
displayAdminMenu ($loginId);

echo "        <center><h3> Get Reliable Twitteratis </h3></center>";

$sector=$_POST["sector"];
$from_date = $_POST['fromDate'];
$to_date = $_POST['toDate'];

// Check if any option is selected
if(isset($_POST["Companies"]))
{
  $selected_companies = $_POST['Companies'];
  foreach ($selected_companies as $company_short_name)
  {
    $command_exec = escapeshellcmd("python ./GRT_And_Fill_DB.py " . $sector . " ". $company_short_name . " " . $from_date . " " . $to_date); 
    $str_output = shell_exec($command_exec); 
    echo "" . $str_output . ""; 
  }
}
else
{
  echo "<center> Please select one or more company names</center><BR>";
}

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