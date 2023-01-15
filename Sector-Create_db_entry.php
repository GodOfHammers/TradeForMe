<?php

include 'db_connection.php';
include 'display_titles.php';

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "";
echo "<head>";
echo "    <title> TFM : Sector Create</title>";
echo "    <link rel='stylesheet' href='tfm.css' type='text/css'>";
echo "    <link href='https://fonts.googleapis.com/css?family=Fjalla One' rel='stylesheet'>";
echo "    <link rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>";
echo "    <meta charset='UTF-8' name='viewport' content='width=device-width,initial-scale=1.0'>";
echo "</head>";

echo "<body>";

$loginId=$_POST["loginId"];
$name=$_POST["name"];

echo "    <h1> Trade For Me </h1>";
echo "<BR><BR><BR>";
displayAdminMenu ($loginId);

$conn = OpenCon();

// Create the sectors table if it doesn't exist
$sql = "SELECT COUNT(*)FROM information_schema.tables WHERE table_schema =  DATABASE() AND table_name=\"sector\";";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

if ($row['COUNT(*)'] == 0)
{
    $sql = 'create table sector (sector_id smallint auto_increment primary key, sector_name varchar(40) unique not null);';
    $result = $conn->query($sql);
    if (!$result) 
    {   
        echo "Sorry, this website is experiencing problems.";
        echo "Error: SQL command failed to execute, here is why:  <br>";
        echo "Query: " . $sql . "<br>";
        echo "Errno: " . $conn->errno . "<br>";
        echo "Error: " . $conn->error . "<br>";
        CloseCon($conn);
        return -1;
    }
}  

// Add a new sector in to the sector table
$sql = 'insert into sector (sector_name) values ( \'' . $name . '\');';
try {
    $result = $conn->query($sql);
    if (!$result) 
    {   
        echo "Sorry, this website is experiencing problems.";
        echo "Error: SQL command failed to create sector, here is why:  <br>";
        echo "Query: " . $sql . "<br>";
        echo "Errno: " . $conn->errno . "<br>";
        echo "Error: " . $conn->error . "<br>";
        CloseCon($conn);
        return -1;
    }
    
    echo "<br><br><center>Sector '" . $name . "' is created successfully</center>";

    // Create the Company table if it doesn't exist
    $sql = "SELECT COUNT(*)FROM information_schema.tables WHERE table_schema =  DATABASE() AND table_name=\"company\";";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    if ($row['COUNT(*)'] == 0)
    {
        $sql = 'create table company (company_id smallint auto_increment primary key, short_name varchar(10) not null, full_name varchar(40) unique not null, sector varchar(40) not null, current_price float);';
        $result = $conn->query($sql);
        if (!$result) 
        {   
            echo "Sorry, this website is experiencing problems.";
            echo "Error: SQL command failed to create a 'Company' table, here is why:  <br>";
            echo "Query: " . $sql . "<br>";
            echo "Errno: " . $conn->errno . "<br>";
            echo "Error: " . $conn->error . "<br>";
            CloseCon($conn);
            return -1;
        }
    }  

    // Sector record is successfully created in DB now. 
    // Fetch the company names corresponding to the sector from stock exchange DB.
    //

    $command_exec = escapeshellcmd('python ./fetch_and_add_companies.py ' . $name); 
    $str_output = shell_exec($command_exec); 
    echo "<CENTER>" . $str_output . "</CENTER><BR>"; 
}
catch (MySQLDuplicateKeyException $e) {
    // duplicate entry exception
    $e->getMessage();
    echo "<Center>user_id already exists\n<BR>" . $conn->error . "<BR></Center>";
}
catch (MySQLException $e) {
    // other mysql exception (not duplicate key entry)
    $e->getMessage();
    echo "<Center>SQL exception\n<BR>" . $conn->error . "<BR></Center>";
}
catch (Exception $e) {
    // not a MySQL exception
    $e->getMessage();
    echo "<Center>Exception\n<BR>" . $conn->error . "<BR></Center>";
}

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
