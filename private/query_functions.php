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

    function validate_genre($genre) {
        $errors = [];

        // menu_name
        if(is_blank($genre['menu_name'])) {
        $errors[] = "Name cannot be blank.";
        } elseif(!has_length($genre['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
        }

        // position
        // Make sure we are working with an integer
        $postion_int = (int) $genre['position'];
        if($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
        }
        if($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
        }

        // visible
        // Make sure we are working with a string
        $visible_str = (string) $genre['visible'];
        if(!has_inclusion_of($visible_str, ["0","1"])) {
        $errors[] = "Visible must be true or false.";
        }

        return $errors;
    }

    function insert_genre($genre) {
        global $db;

        $errors = validate_genre($genre);
        if(!empty($errors)) {
            return $errors; //skips out of function early and returns $errors into $result
        }

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

        $errors = validate_genre($genre);
        if(!empty($errors)) {
            return $errors; //skips out of function early and returns $errors into $result
        }

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