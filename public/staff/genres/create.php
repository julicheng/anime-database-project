<?php 
require_once('../../../private/initialize.php');

if(is_post_request()) {
// handle form values sent by new.php

$genre = [];
$genre['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name'] : "";
$genre['position'] = isset($_POST['position']) ? $_POST['position'] : "";
$genre['visible'] = isset($_POST['visible']) ? $_POST['visible'] : "";

$result = insert_genre($genre); //use above variables in function
if($result === true) {
    $new_id = mysqli_insert_id($db); //check the new id that has been created
    redirect_to(url_for('/staff/genres/show.php?id=' . $new_id)); //use the new id and load show page
} else {
    $errors = $result;
}
} else {
    redirect_to(url_for('/staff/genres/new.php'));
}

// ERROR HANDLING NOT GOOD FOR MULTIPLE FORM SUBMISSION
?>