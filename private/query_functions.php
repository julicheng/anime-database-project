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
        $sql.= "WHERE id='" . db_escape($db, $id) . "'"; //finds id
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
        $sql.= "'" . db_escape($db, $genre['menu_name']) . "', ";
        $sql.= "'" . db_escape($db, $genre['position']) . "', ";
        $sql.= "'" . db_escape($db, $genre['visible']) . "'";
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
        $sql.= "menu_name='" . db_escape($db, $genre['menu_name']) . "', "; //uses variables above
        $sql.= "position='" . db_escape($db, $genre['position']) . "', ";
        $sql.= "visible='" . db_escape($db, $genre['visible']) . "' ";
        $sql.= "WHERE id='" . db_escape($db, $genre['id']) . "' "; //uses the $_GET['id']
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
        $sql.= "WHERE id='" . db_escape($db, $id) . "' ";
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
        $sql.= "WHERE id='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        $page = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $page;
    }

    function validate_page($page) {
        $errors = [];

        // menu_name
        if(is_blank($page['menu_name'])) {
        $errors[] = "Title cannot be blank.";
        } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Title must be between 2 and 255 characters.";
        }
        $current_id = isset($page['id']) ? $page['id'] : "0";
        if (!has_unique_page_menu_name($page['menu_name'], $current_id)) {
            $errors[] = "Menu name must be unique.";
        }

        // genre_id
        if(is_blank($page['genre_id'])) {
            $errors[] = "Genre cannot be blank";
        }

        // position
        // Make sure we are working with an integer
        $postion_int = (int) $page['position'];
        if($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
        }
        if($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
        }

        // visible
        // Make sure we are working with a string
        $visible_str = (string) $page['visible'];
        if(!has_inclusion_of($visible_str, ["0","1"])) {
        $errors[] = "Visible must be true or false.";
        }

        // content 
        if(is_blank($page['content'])) {
            $errors[] = "Content cannot be blank.";
        }

        return $errors;
    }

    function insert_page($page) {
        global $db;

        $errors = validate_page($page);
        if(!empty($errors)) {
            return $errors;
        }

        $sql = "INSERT INTO pages ";
        $sql.= "(genre_id, menu_name, position, visible, content) ";
        $sql.= "VALUES (";
        $sql.= "'" . db_escape($db, $page['genre_id']) . "',";
        $sql.= "'" . db_escape($db, $page['menu_name']) . "',";
        $sql.= "'" . db_escape($db, $page['position']) . "',";
        $sql.= "'" . db_escape($db, $page['visible']) . "',";
        $sql.= "'" . db_escape($db, $page['content']) . "'";
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

        $errors = validate_page($page);
        if(!empty($errors)) {
            return $errors;
        }

        $sql = "UPDATE pages SET ";
        $sql.= "genre_id='" . db_escape($db, $page['genre_id']) . "', ";
        $sql.= "menu_name='" . db_escape($db, $page['menu_name']) . "', ";
        $sql.= "position='" . db_escape($db, $page['position']) . "', ";
        $sql.= "visible='" . db_escape($db, $page['visible']) . "', ";
        $sql.= "content='" . db_escape($db, $page['content']) . "' ";
        $sql.= "WHERE id='" . db_escape($db, $page['id']) . "' ";
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
        $sql.= "WHERE id='" . db_escape($db, $id) . "' ";
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