<?php require_once('../../../private/initialize.php'); ?>

<?php

$genres = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'Comedy'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Slice of Life'],
    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'School'],
    ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Romance'],
];

?>

<?php $page_title = "Genres"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="content"></div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>