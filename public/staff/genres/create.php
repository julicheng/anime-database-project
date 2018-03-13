<?php 
require_once('../../../private/initialize.php');

if(is_post_request()) {
// handle form values sent by new.php

$menu_name = isset($_POST['menu_name']) ? $_POST['menu_name'] : "";
$position = isset($_POST['position']) ? $_POST['position'] : "";
$visible = isset($_POST['visible']) ? $_POST['visible'] : "";

$result = insert_genre($menu_name, $position, $visible); //use above variables in function
$new_id = mysqli_insert_id($db); //check the new id that has been created
redirect_to(url_for('/staff/genres/show.php?id=' . $new_id)); //use the new id and load show page

} else {
    redirect_to(url_for('/staff/genres/new.php'));
}
?>