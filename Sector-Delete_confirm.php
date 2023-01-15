<?php

include 'db_connection.php';
include 'display_titles.php';

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "";
echo "<head>";
echo "    <title> TFM : Sector Delete - Confirmation</title>";
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";
echo "    <meta charset='UTF-8' name='viewport' content='width=device-width,initial-scale=1.0'>";
echo "</head>";

echo "<script>
  function cancelHandler()
  {
    window.history.back();
  }
</script>";

echo "<body>";

$loginId=$_POST["loginId"];
$name=$_POST["sector"];

echo "    <h1> Trade For Me </h1>";
echo "<BR><BR><BR>";
displayAdminMenu ($loginId);

$conn = OpenCon();

$sql = "SELECT COUNT(*)FROM information_schema.tables WHERE table_schema =  DATABASE() AND table_name=\"company\";";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row['COUNT(*)'] == 1)
{
    $sql = "SELECT COUNT(*)FROM company WHERE sector = '" . $name . "'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['COUNT(*)'] == 1)
    {
        echo "There are company names associated with this sector<BR><BR>";
    }
}

echo "    <form method='POST' action='Sector-Delete_db_entry.php' class='form_1'>";
echo "        <h3> Sector Delete - Confirmation </h3>";

echo "        <label for='name' > Sector Name:</label>";
echo "        <input type='text' id='name' name='name' value='" . $name . "' readonly><br>";

echo "        <input type='hidden' id='loginId' name='loginId' value='" . $loginId . "'>";
echo "        <button type='reset' onclick='cancelHandler()' id='reset_1'> Cancel </button>";
echo "        <button type='submit' id='submit_1'> Confirm To Delete</button><br/><br/>";
echo "    </form>";

CloseCon($conn);

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
