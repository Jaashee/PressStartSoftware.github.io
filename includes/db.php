<?php
function db_connect(){
    return pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DATABASE." user=".DB_ADMIN." password=".DB_PASSWORD);
}
$conn = db_connect();


$user_insert = pg_prepare($conn,"client_insert","INSERT INTO client(client_email) VALUES($1)");


function insert_client($email_address){
    global $conn;
    return pg_excute($conn,"client_insert",array($email_address));
    }
    $stmt1 = pg_prepare($conn, 'employee_retrieve','SELECT * FROM employee WHERE employee_id = $1 ');

    function user_exists($email_address){
        global $conn;
        $results = pg_execute($conn,'employee_retrieve', array($email_address));
        if(pg_num_rows($results==1))
        {
        return true;
        }
        else{
            false;
        }
        }
?>