<?php require_once('../../../private/initialize.php'); ?>

<?php

require_login();

$genre_set = find_all_genres();

?>

<?php $page_title = "Genres"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="content">
        <div class="listing subjects">
            <h1>Genres</h1>

            <div class="actions">
                <a class="action" href="<?php echo url_for('/staff/genres/new.php'); ?>">Create New Genre</a>
            </div>

            <table class="list">
                <tr>
                    <th>ID</th>
                    <th>Position</th>
                    <th>Visible</th>
                    <th>Genre</th>
                    <th>Pages</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

                <?php while($genre = mysqli_fetch_assoc($genre_set)) { ?>
                    <?php $page_count = count_pages_by_genre_id($genre['id']); ?>
                    <tr>
                        <td><?php echo h($genre['id']); ?></td>
                        <td><?php echo h($genre['position']); ?></td>
                        <td><?php echo $genre['visible'] == 1 ? 'true' : 'false'; ?></td>
                        <td><?php echo h($genre['menu_name']); ?></td>
                        <td><?php echo $page_count ?></td>
                        <td><a class="action" href="<?php echo url_for('/staff/genres/show.php?id=' . h(u( $genre['id']))); ?>">View</a></td>
                        <td><a class="action" href="<?php echo url_for('/staff/genres/edit.php?id=' . h(u( $genre['id']))); ?>">Edit</a></td>
                        <td><a class="action" href="<?php echo url_for('/staff/genres/delete.php?id=' . h(u( $genre['id']))); ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </table>
            
            <?php 
                mysqli_free_result($genre_set);
            ?>

        </div>
    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>