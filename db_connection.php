<?php

// Function to open a connection to the database
function OpenCon()
{
  $servername = "localhost";
  $username = "root";
  $password = "BlueDragon!2";

  $db = "tfm";

// Create connection : Call Type-1
  $conn = new mysqli($servername, $username, $password,$db) or die("Connect failed: %s\n". $conn -> error);

//echo "Connected successfully";

  return $conn;
}

// Function to close the connection to the database
function CloseCon($conn)
{
  $conn -> close();
}

//---------------------------------------------------
// Get the password for given user name
// Returns "" if given user name not found in DB
// Returns password if given user name is found in DB
//---------------------------------------------------
function getPassword($conn, $name) 
{ 
  $sql = 'select * from user where user_id = \'' . $name . '\'';

  // run the query 
  if (!$result = $conn->query($sql)) 
  {
    // Handle error
    echo "Sorry, this website is experiencing problems.";
    echo "Error: Query failed to execute, here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $conn->errno . "\n";
    echo "Error: " . $conn->error . "\n";
    exit;
  }

  // If SQL query returns zero rows, return blank
  if ($result->num_rows === 0) 
  {
    return "";
  }

  if($row = $result->fetch_assoc())
  {
    $password = $row['password'];
    //echo "Debug: Password retrieved from DB for user : " . $name . " is : " . $password ;
    return $password;
  }
  else
  {
    return "";
  }
}

// Function to get a list of sectors from the database
function getSectorList ()
{
  // Open a connection to the database
  $conn = OpenCon();

  // Check if the sector table exists
  $sql = "SELECT COUNT(*)FROM information_schema.tables WHERE table_schema =  DATABASE() AND table_name=\"sector\";";
  $result = $conn->query($sql);

  $row = $result->fetch_assoc();
  if ($row['COUNT(*)'] == 0)
  {
    echo "<BR><center>There are no sectors in DB</center>";
    CloseCon($conn);
    return "";
  }  

  // Select all sectors from the sector table
  $sql = "select * from sector;";
  if (!$result = $conn->query($sql)) 
  {
    // Handle error
    echo "<br><br>Sorry, this website is experiencing problems.";
    echo "Error: Query failed to search for list of Sectors, here is why: <br>";
    echo "Query: " . $sql . "<br>";
    echo "Errno: " . $conn->errno . "<br>";
    echo "Error: " . $conn->error . "<br>";
    CloseCon($conn);
    return "";
  }
  
  $sectorCount = 0;

  // Loop through the results and create a dropdown list of sectors
  while($row = $result->fetch_assoc())
  {
    if ($sectorCount == 0)
    {
      echo "        <label for='name' class='required'> Sector Names: </label>";
      echo "<select name='sector' id='sectorList' onchange='changeSector()'>\n";
      $first_sector = $row['sector_name'];
    }
    echo "<option value='" . $row['sector_name'] . "'> " . $row['sector_name'] . "</option>\n";

    $sectorCount++;
  }

  CloseCon($conn);

  if ($sectorCount > 0)
  {
    echo "</select>"; 
    echo "<p id='demo'></p>";
    return $first_sector;
  }
  else 
  {
    echo "<BR><center>There are no sectors </center>";
    return "";
  }
}

// Function to get a list of companies from a specific sector in the database
function getCompanyList ($sector)
{
  // Open a connection to the database
  $conn = OpenCon();

  // Check if the company table exists
  $sql = "SELECT COUNT(*)FROM information_schema.tables WHERE table_schema =  DATABASE() AND table_name=\"company\";";
  $result = $conn->query($sql);

  $row = $result->fetch_assoc();
  if ($row['COUNT(*)'] == 0)
  {
    echo "<BR><center>There are no companies in TFM DB</center>";
    CloseCon($conn);
    return -1;
  }  

  $sql = "select * from company where sector ='" . $sector . "';";
  if (!$result = $conn->query($sql)) 
  {
      echo "<br><br>Sorry, this website is experiencing problems.";
      echo "Error: Query failed to search for list of Companies, here is why: <br>";
      echo "Query: " . $sql . "<br>";
      echo "Errno: " . $conn->errno . "<br>";
      echo "Error: " . $conn->error . "<br>";
      CloseCon($conn);
      return -1;
  }
  
  $companyCount = 0;

  while($row = $result->fetch_assoc())
  {
    if ($companyCount == 0)
    {
      echo "        <label for='name' class='required'> Companies &nbsp;&nbsp;: </label>";
      echo "        <select name=\"Companies[]\" id=\"companies\" multiple>";
    }
    echo "<option value='" . $row['short_name'] . "'> " . $row['full_name'] . "</option>\n";

    $companyCount++;
  }

  CloseCon($conn);

  if ($companyCount > 0)
  {
    echo "</select>\n";
  }
  else 
  {
    echo "<BR><center>There are no companies </center>";
    return -1;
  }
}

?>
