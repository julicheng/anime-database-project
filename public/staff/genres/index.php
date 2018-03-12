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

    <div id="content">
        <div class="listing subjects">
            <h1>Genres</h1>

            <div class="actions">
                <a class="action" href="">Create New Genre</a>
            </div>

            <table class="list">
                <tr>
                    <th>ID</th>
                    <th>Position</th>
                    <th>Visible</th>
                    <th>Genre</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

                <?php foreach($genres as $genre) { ?>
                    <tr>
                        <td><?php echo $genre['id']; ?></td>
                        <td><?php echo $genre['position']; ?></td>
                        <td><?php echo $genre['visible']; ?></td>
                        <td><?php echo $genre['menu_name']; ?></td>
                        <td><a class="action" href="<?php echo url_for('/staff/genres/show.php?id=' . $genre['id']); ?>">View</a></td>
                        <td><a class="action" href="">Edit</a></td>
                        <td><a class="action" href="">Delete</a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>