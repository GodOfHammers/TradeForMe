<?php

include 'db_connection.php';

//This file is responsible for handling the AJAX request sent by the 'changeSector' function in the previous file
//It receives the selected sector value and calls the 'update_company_value' function to update the list of companies

if ($_POST['function'] == "update_company_value"){
    //If the function parameter sent in the AJAX request is 'update_company_value'
    $companies = update_company_value($_POST['value']);
    //Call the 'update_company_value' function and pass in the selected sector value as a parameter
    echo $companies;
    //Echo the returned list of companies to be displayed on the webpage
}

function update_company_value($sector) {
    //This function takes in the selected sector value and calls the 'getCompanyList' function to retrieve the list of companies for that sector
    $companies = getCompanyList($sector);
    //Retrieve the list of companies for the selected sector
    return $companies;    
    //Return the list of companies
}

?>