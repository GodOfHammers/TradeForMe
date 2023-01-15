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
echo "<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>";

echo "<script>
  function cancelHandler()
  {
    myList = document.getElementsByTagName('form').elements;
    for (var i=0; i<myList.length; i++)
      myList[i].value = '';
  }
  
  function calculate_total_cost() {
    var cost = 0;
    var inputs = document.getElementsByTagName('input');
    var count = inputs.elements.length / 2;
    
    alert(count + 'Hello');

    for (let i=0; i<count; i++)
      cost += document.getElementById('share_count_'+i).value * document.getElementById('current_price_'+i).value;

    document.getElementById('cost').innerHTML = ' ' + cost + ' ';
  }
  </script>";
echo "</head>";

echo "<body>";

echo "    <h1> Trade For Me </h1>";

$loginId=$_POST["loginId"];
$sector=$_POST["sector"];
$investment=$_POST["investment"];

echo "<BR><BR><BR>";
displayCustomerMenu ($loginId);

$conn = OpenCon();

echo "        <center><h3> Get Trade Suggestions </h3></center>";

// Sort the correlation_table by correlation_factor in descending order
//
$sql = "select sector_name,company_short_name,max(cf) from correlation where cf > 0.5*100 group by company_short_name;";
if (!$result = $conn->query($sql)) 
{
    // Handle error
    echo "<br><br>Sorry, this website is experiencing problems.";
    echo "Error: Query failed to return the correlation_table in sorted order, here is why: <br>";
    echo "Query: " . $sql . "<br>";
    echo "Errno: " . $conn->errno . "<br>";
    echo "Error: " . $conn->error . "<br>";
    CloseCon($conn);
    return -1;
}

$count = 0;

echo "<Center><Form method='POST' action='Buy_Shares.php' class='form_1'>";

echo "<TABLE>\n";
echo "<TH>Sector Name </TH>\n";
echo "<TH>Company Name </TH>\n";
echo "<TH>Number of shares </TH>\n";
echo "<TH>Current market price </TH>\n";
echo "<TH>Highest Correlation factor </TH>\n";
echo "<TR>";

while($row = $result->fetch_assoc())
{
  $command_exec = escapeshellcmd('python ./get_company_details.py ' . $row["company_short_name"] . ' ' . $row["sector_name"]); 
  $str_output = shell_exec($command_exec); 
  parse_str($str_output, $myArray);
  $full_name = $myArray["fname"];
  $current_price = floatval($myArray["price"]);
  
  //echo "Debug-" . $count . ": Current Price=" . $current_price . ", investment =" . $investment .  "<BR>\n";
  
  if (($current_price == 0) || ($current_price > $investment))
    continue;
  
  $sector_name = $row["sector_name"];
  $correlation_factor = $row["max(cf)"];
  
  echo "<TD>" . $sector_name . "</TD>\n";
  echo "<TD>" . $full_name . "</TD>\n";
  
  echo "<TD>\n";
  echo "     <INPUT type=number min=0 max=1000 step=1 name=share_count_" . $count . "  id=share_count_" . $count . " value=0 required=required style=width:100px onchange='calculate_total_cost()'>\n";
  echo "</TD>\n";
  
  echo "<TD>\n";
  echo "     <INPUT type=number name=current_price_" . $count . " id=current_price_" . $count . " value=" . $current_price . " readonly style=width:100px>\n";
  echo "</TD>\n";
  
  echo "<TD>" . $correlation_factor . "</TD>\n";
  echo "<TR>\n";

  $count ++;
}

echo "</TABLE>\n";
echo "<p id='cost'></p><BR>\n";

echo "<input type='hidden' id='name' name='loginId' value='" . $loginId . "'>";
echo "<input type='hidden' id='investment' name='investment' value='" . $investment . "'>";

echo "<CENTER>";
echo "        <button type='reset' onclick='cancelHandler()' id='reset_1'> Cancel </button>\n";
echo "        <button type='submit' id='submit_1'> Submit </button><br/><br/>";
echo "</CENTER>";
echo "</Form>";

// copy top most entry for each company from correlation_table to unique_records 
// whose correlation_factor > 0.5
// whose current_market_price <= investment available with customer
//
// If customer selects some company names on the screen, from the above selected 
// records, choose only the ones matching with customer selection.
//

$current_csn = "";
  
if(isset($_POST["Companies"]))
{
  $selected_companies = $_POST['Companies'];
  $companies_selected_onscreen = TRUE;
}
else
{
  $companies_selected_onscreen = FALSE;
}

while($row = $result->fetch_assoc())
{
  if ($row["cf"] <= 0.5)
    continue;

  $current_price = get_current_price($row["company_short_name"]);
  //More to implement by reading from stock exchange DB (Use Python code to extract the data from stockmonitor.com)

  if ($current_price > $investment)
    continue;

  if ($current_csn != $row["company_short_name"])
  {
    if ($companies_selected_onscreen == TRUE)
    {
      foreach ($selected_companies as $csn)
      {   
        if ($row["company_short_name"] == $csn)
        {
          $unique_records[$count] = $row;
          $current_csn = $row["company_short_name"];
          $count ++;
          break;
        }
      }
    }
    else // On screen, company names are not selected
    {
      $unique_records[$count] = $row;
      $current_csn = $row["company_short_name"];
      $count ++;
    }
  }
}



// When submit is pressed total investment required will be calculated and 
// if that is more than total_investment specified by customer
//        confirmation will be asked by explaining the situation, for purchasing the shares etc.
// else
//        "successfully purchased the specified shares" message will be shown.

echo "    <footer>";
echo "        <ul>";
echo "            <li><a href='#'><i class='fa fa-facebook-f' aria-hidden='true' style='color:gray'> </i> </a> </li>";
echo "            <li><a href='#'><i class='fa fa-twitter' aria hidden='true' style='color:gray'> </i> </a> </li>";
echo "            <li><a href='#'><i class='fa fa-instagram' aria-hidden='true' style='color:gray'> </i> </a></li>";
echo "            <li><a href='#'><i class='fa fa-linkedin' aria-hidden='true' style='color:gray'> </i> </a></li>";
echo "        </ul>";
echo "    </footer>";

echo "</body>";

echo "</html>";


?>
