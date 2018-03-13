<!-- where we store functions related to database -->

<?php 

require_once('db_credentials.php');

// connect to database
function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

function db_disconnect($connection) {
    if(isset($conneciton)) {
        mysqli_close($connection);
    }
}

?>
