<?php

include 'db_connection.php';

if ($_POST['function'] == "update_company_value"){
    $companies = update_company_value($_POST['value']);
    echo $companies;
}

function update_company_value($sector) {
    $companies = getCompanyList($sector);
    return $companies;    
}

?>