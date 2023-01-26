<?php

include 'db_connection.php';
include 'display_titles.php';

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "";
echo "<head>";
echo "    <title> TFM : Buy Shares</title>";
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";
echo "<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>";

// This script is used to handle the cancel button on the form.
// When the user clicks on the cancel button, the script will loop through all the elements in the form and set their values to empty.
// This way, all the data entered by the user will be cleared and they can start fresh.
// The function is called when the cancel button is clicked via the onclick attribute in the HTML.
echo "<script>
  function cancelHandler()
  {
    myList = document.getElementsByTagName('form').elements;
    for (var i=0; i<myList.length; i++)
      myList[i].value = '';
  }</script>";
  
echo "</head>";

echo "<body>";

echo "    <h1> Trade For Me </h1>";

$loginId=$_POST["loginId"];
$investment=$_POST["investment"];
echo "<BR><BR><BR>";
displayCustomerMenu ($loginId);

echo "        <center><h3> Buy Shares </h3>";

// When submit is pressed total investment required will be calculated and 
// if that is more than total_investment specified by customer
//        confirmation will be asked by explaining the situation, for purchasing the shares etc.
// else
//        "successfully purchased the specified shares" message will be shown.

$param_count = count($_POST);
$index = 0;
$cost = 0;
foreach ($_POST as $param_name => $param_val) {
  
  // Here we check if the current index is the last element of the array, which is the investment value.
  // We break the loop if this is the case
  if ($index == ($param_count - 2))
  {
    //echo "Printing from break condition - index = ". $index . "<BR>\n";
    break;
  }
  // Here we check if the current index is even, in order to know if it corresponds to the share count or current price value
  if ($index % 2 == 0)
  {
    //echo "index = ". $index . "<BR>\n";
    $share_count = $_POST['share_count_' . ($index/2)];
    $current_price = $_POST['current_price_' . ($index/2)];

    //if ($share_count != 0)
    //{
    //  echo "share count: $share_count; current_price: $current_price <BR>\n";
    //}
    $cost +=  $share_count * $current_price ;
  }
  
  $index++;
}
echo "Total cost = " . $cost . " USD <BR><BR>\n";


// If the total cost of the shares selected is more than the available investment, display an error message
if ($cost > $investment)
  echo "<Font color=red>Available investment is more than the cost of selected shares.<BR> Change the number of shares to fit in to the available budget " . $investment . " USD </font><BR>\n";
else if ($cost == 0)
  echo "<Font color=red>Share count is not mentioned for any of the shares.<BR> Please go back and specify some non-zero number of shares to purchase</font>";
else
  echo "<Font color=green>Good news!<BR> System had sent the BUY request for selected shares.</font>";

echo "</center></body>";

echo "</html>";


?>
