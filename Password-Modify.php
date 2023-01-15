<?php

include 'display_titles.php';

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "";
echo "<head>";
echo "    <meta charset='UTF-8' name='viewport' content='width=devive-width,initial-scale=1.0'>";
echo "    <title> TFM : Password Modify</title>";
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
if ($loginId === 'admin')
{
    displayAdminMenu ($loginId);
}
else
{
    displayCustomerMenu ($loginId);
}


echo "    <form method='POST' action='Password-Modify_db_entry.php' class='form_1'>";
echo "        <h3> Modify Password </h3>";
echo "        <label for='cpassword' class='required'> Current Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>";
echo "        <input type='password' id='cpassword' name='cpassword' placeholder='Current password' style='margin-left:3px;' required><br/>";

echo "        <label for='npassword' class='required'> Enter New Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>";
echo "        <input type='password' id='npassword' name='npassword' placeholder='New password' style='margin-left:3px;' required><br/>";

echo "        <label for='rnpassword' class='required'> Re-enter New Password: </label>";
echo "        <input type='password' id='rnpassword' name='rnpassword' placeholder='New password' style='margin-left:3px;' required><br/>";

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
