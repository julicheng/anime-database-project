<?php 

    //GENRE FUNCTIONS

    function find_all_genres() {
        global $db; //need to pass $db as not in scope

        $sql = "SELECT * FROM genres ";
        $sql.= "ORDER BY position ASC";
        // echo $sql; check the string
        $result = mysqli_query($db, $sql);
        confirm_result_set($result); // runs to check if there is a result set
        return $result;
    }

    function find_genre_by_id($id) {
        global $db; //db not in scope so need to global it

        $sql = "SELECT * FROM genres ";
        $sql.= "WHERE id='" . $id . "'"; //finds id
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        $genre = mysqli_fetch_assoc($result);
        mysqli_free_result($result); //free result because we have assigned result to a variable
        return $genre; //returns an assoc array
    }

    function insert_genre($genre) {
        global $db;

        $sql = "INSERT INTO genres ";
        $sql.= "(menu_name, position, visible) ";
        $sql.= "VALUES (";
        $sql.= "'" . $genre['menu_name'] . "', ";
        $sql.= "'" . $genre['position'] . "', ";
        $sql.= "'" . $genre['visible'] . "'";
        $sql.= ")";
        $result = mysqli_query($db, $sql);

        // for insert statement ^ $result is true/false
        if($result) {
           return true;
        } else {
            //insert failed
            echo mysqli_error($db);
            db_disconnect($db);
        }
    }

    function update_genre($genre) {
        global $db;

        $sql = "UPDATE genres SET ";
        $sql.= "menu_name='" . $genre['menu_name'] . "', "; //uses variables above
        $sql.= "position='" . $genre['position'] . "', ";
        $sql.= "visible='" . $genre['visible'] . "' ";
        $sql.= "WHERE id='" . $genre['id'] . "' "; //uses the $_GET['id']
        $sql.= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        //for UPDATE statements,$result is true/false
        if ($result) {
            return true;
        } else {
            //update failed
            echo mysqli_error($db);
            db_disconnect($db);
        }
    }

    function delete_genre($id) {
        global $db;

        //if its a post request then do sql
        $sql = "DELETE FROM genres ";
        $sql.= "WHERE id='" . $id . "' ";
        $sql.= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        //for DELETE statements, $result is true/false
        
        if($result) {
            return true;
        } else {
            // delete failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    // PAGE FUNCTIONS

    function find_all_pages() {
        global $db;

        $sql = "SELECT * FROM pages ";
        $sql.= "ORDER BY genre_id ASC, position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_page_by_id($id) {
        global $db;

        $sql = "SELECT * FROM pages ";
        $sql.= "WHERE id='" . $id . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        $page = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $page;
    }

    function insert_page($page) {
        global $db;

        $sql = "INSERT INTO pages ";
        $sql.= "(genre_id, menu_name, position, visible, content) ";
        $sql.= "VALUES (";
        $sql.= "'" . $page['genre_id'] . "',";
        $sql.= "'" . $page['menu_name'] . "',";
        $sql.= "'" . $page['position'] . "',";
        $sql.= "'" . $page['visible'] . "',";
        $sql.= "'" . $page['content'] . "'";
        $sql.= ")";
        $result = mysqli_query($db, $sql);

        if($result) {
           return true;
        } else {
            //insert failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit();
        }
    }

    function update_page($page) {
        global $db;

        $sql = "UPDATE pages SET ";
        $sql.= "genre_id='" . $page['genre_id'] . "', ";
        $sql.= "menu_name='" . $page['menu_name'] . "', ";
        $sql.= "position='" . $page['position'] . "', ";
        $sql.= "visible='" . $page['visible'] . "', ";
        $sql.= "content='" . $page['content'] . "' ";
        $sql.= "WHERE id='" . $page['id'] . "' ";
        $sql.= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        if($result) {
           return true;
        } else {
            //insert failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit();
        }
    }

    function delete_page($id) {
        global $db;

        $sql = "DELETE FROM pages ";
        $sql.= "WHERE id='" . $id . "' ";
        $sql.= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        
        if($result) {
           return true;
        } else {
            //insert failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit();
        }
    }
    
?>