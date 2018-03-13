<?php 

    function find_all_genres() {
        global $db; //need to pass $db as not in scope

        $sql = "SELECT * FROM genres ";
        $sql.= "ORDER BY position ASC";
        $result = mysqli_query($db, $sql);
        return $result;
    }

?>