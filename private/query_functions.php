<?php 

    //GENRE FUNCTIONS

    function find_all_genres($options=[]) {
        global $db; //need to pass $db as not in scope

        $visible = isset($options['visible']) ? $options['visible'] : false;
        $sql = "SELECT * FROM genres ";
        if($visible) {
            $sql.= "WHERE visible = true ";
        }
        $sql.= "ORDER BY position ASC";
        // echo $sql; check the string
        $result = mysqli_query($db, $sql);
        confirm_result_set($result); // runs to check if there is a result set
        return $result;
    }

    function find_genre_by_id($id, $options=[]) {
        global $db; //db not in scope so need to global it

        $visible = isset($options['visible']) ? $options['visible'] : false;

        $sql = "SELECT * FROM genres ";
        $sql.= "WHERE id='" . db_escape($db, $id) . "' "; //finds id
        if($visible) {
            $sql.= "AND visible = true";
        }
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

    function find_page_by_id($id, $options=[]) {
        global $db;

        $visible = isset($options['visible']) ? $options['visible'] : false;

        $sql = "SELECT * FROM pages ";
        $sql.= "WHERE id='" . db_escape($db, $id) . "' ";
        if($visible) {
            $sql.= "AND visible = true";
        }
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

    function find_pages_by_genre_id($genre_id , $options=[]) {
        global $db;

        $visible = isset($options['visible']) ? $options['visible'] : false;

        $sql = "SELECT * FROM pages ";
        $sql.= "WHERE genre_id='" . db_escape($db, $genre_id) . "' ";
        if($visible) {
            $sql.= "AND visible = true ";
        }
        $sql.= "ORDER BY position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        return $result;
    }

    // ADMIN FUNCTIONS 

    function find_all_admins() {
        global $db;

        $sql = "SELECT * FROM admins ";
        $sql.= "ORDER BY last_name ASC, first_name ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function find_admin_by_id($id) {
        global $db;

        $sql = "SELECT * FROM admins ";
        $sql.= "WHERE id='" . db_escape($db, $id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        $admin = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $admin;
    }

    function validate_admin($admin, $options=[]) {
        $errors = [];

        // determine if password is required
        // $password_required can be true or false
        $password_required = isset($options['password_required']) ? $options['password_required'] : true; 
        // first_name
        if(is_blank($admin['first_name'])) {
        $errors[] = "First Name cannot be blank.";
        } elseif(!has_length($admin['first_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "First Name must be between 2 and 255 characters.";
        }

        // last_name
        if(is_blank($admin['last_name'])) {
        $errors[] = "Last Name cannot be blank.";
        } elseif(!has_length($admin['last_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Last Name must be between 2 and 255 characters.";
        }

        // username
        if(is_blank($admin['username'])) {
        $errors[] = "Username cannot be blank.";
        }
        $current_id = isset($admin['id']) ? $admin['id'] : "0";
        if (!has_unique_username($admin['username'], $current_id)) {
            $errors[] = "Username must be unique.";
        } elseif(!has_length($admin['username'], ['min' => 8, 'max' => 255])) {
        $errors[] = "Username must be between 8 and 255 characters.";
        }

        // email
        if(is_blank($admin['email'])) {
        $errors[] = "Email cannot be blank.";
        } elseif(!has_length($admin['email'], ['max' => 255])) {
        $errors[] = "Last Name must be under 255 characters.";
        } elseif(!has_valid_email_format($admin['email'])) {
        $errors[] = "Email must be in a valid format.";
        } 

        // password
        if ($password_required) {
            if(is_blank($admin['password'])) {
            $errors[] = "Password cannot be blank.";
            } elseif (!has_length(($admin['password']), ['min' => 12])) {
                $errors[] = "Password must contain 12 or more characters.";
            } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
                $errors[] = "Password must contain at least 1 uppercase letter.";
            } elseif (!preg_match('/[a-z]/', $admin['password'])) {
                $errors[] = "Password must contain at least 1 lowercase letter.";
            } elseif (!preg_match('/[0-9]/', $admin['password'])) {
                $errors[] = "Password must contain at least 1 number.";
            } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
                $errors[] = "Password must contain at least 1 symbol.";
            }
        

            if(is_blank($admin['confirm_password'])) {
                $errors[] = "Confirm password cannot be blank.";
            } elseif ($admin['password'] !== $admin['confirm_password']) {
                $errors[] = "Password and confirm password must match.";
            }
        }

        return $errors;
    }

    function insert_admin($admin) {
        global $db;

        $errors = validate_admin($admin);
        if(!empty($errors)) {
            return $errors;
        }

        $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO admins ";
        $sql.= "(first_name, last_name, username, email, hashed_password) ";
        $sql.= "VALUES (";
        $sql.= "'" . db_escape($db, $admin['first_name']) . "', ";
        $sql.= "'" . db_escape($db, $admin['last_name']) . "', ";
        $sql.= "'" . db_escape($db, $admin['username']) . "', ";
        $sql.= "'" . db_escape($db, $admin['email']) . "', ";
        $sql.= "'" . db_escape($db, $hashed_password) . "'";
        $sql.= ")";

        $result = mysqli_query($db, $sql);

        if($result) {
           return true;
        } else {
            //insert failed
            echo mysqli_error($db);
            db_disconnect($db);
        }

    }

    function update_admin($admin) {
        global $db;

        // if password was sent then it is REQUIRED since gotta do checks
        // if not blank then we know its sent
        $password_sent = !is_blank($admin['password']);

        $errors = validate_admin($admin, ['password_required' => $password_sent]);
        if(!empty($errors)) {
            return $errors;
        }

        $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

        $sql = "UPDATE admins SET ";
        $sql.= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
        $sql.= "last_name='" . db_escape($db, $admin['last_name']) . "', ";
        $sql.= "username='" . db_escape($db, $admin['username']) . "', ";
        if($password_sent) {
            $sql.= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
        }        
        $sql.= "email='" . db_escape($db, $admin['email']) . "' ";
        $sql.= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
        $sql.= "LIMIT 1";

        $result = mysqli_query($db, $sql);;

        if($result) {
           return true;
        } else {
            //insert failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit();
        }
    }

    function delete_admin($id) {
        global $db;

        $sql = "DELETE FROM admins ";
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

    // login

     function find_admin_by_username($username) {
        global $db;

        $sql = "SELECT * FROM admins ";
        $sql.= "WHERE username='" . db_escape($db, $username) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        $admin = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $admin;
    }

?>