<!-- where we store functions related to database -->

<?php 

require_once('db_credentials.php');

// connect to database
function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect(); //check if there are any connection errors
    return $connection;
}

function db_disconnect($connection) {
    if(isset($conneciton)) {
        mysqli_close($connection);
    }
}

//check if connection was successful
function confirm_db_connect() {
    if(mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

//if doesn't run if there is a result set
function confirm_result_set($result_set) {
    if(!$result_set) {
        exit("Database query failed.");
    }
}

function db_escape($connection, $string) {
    return mysqli_real_escape_string($connection, $string);
}

?>
