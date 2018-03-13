<?php 

    function find_all_genres() {
        global $db; //need to pass $db as not in scope

        $sql = "SELECT * FROM genres ";
        $sql.= "ORDER BY position ASC";
        // echo $sql; check the string
        $result = mysqli_query($db, $sql);
        confirm_result_set($result); // runs to check if there is a result set
        return $result;
    }

    function find_all_pages() {
        global $db;

        $sql = "SELECT * FROM pages ";
        $sql.= "ORDER BY genre_id ASC, position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }
?>