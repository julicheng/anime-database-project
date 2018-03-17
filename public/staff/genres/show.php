<?php require_once('../../../private/initialize.php'); ?>

<?php

require_login();

$id = isset($_GET['id']) ? $_GET['id'] : '1';

// $id = $_GET['id'] ?? '1'; // PHP 7.0 or more

$genre = find_genre_by_id($id);
$page_set = find_pages_by_genre_id($id);

?>

<?php $page_title = "Show Genre" ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('staff/genres/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject show">

        <h1>Genre: <?php echo h($genre['menu_name']); ?></h1>

        <div class="attributes">
            <dl>
                <dt>Title</dt>
                <dd><?php echo h($genre['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($genre['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo h($genre['visible']) == "1" ? "true" : "false"; ?></dd>
            </dl>

        </div>

    </div>

    <hr>

    <div class="listing pages">
        <h2>Pages</h2>

        <div class"actions">
                <a class="action" href="<?php echo url_for('/staff/pages/new.php?genre_id=' . h(u($genre['id']))); ?>">Create New Page</a>
        </div><br>

        <table class="list">
            <tr>
                <th>ID</th>
                <!-- <th>Genre ID</th> -->
                <th>Position</th>
                <th>Visible</th>
                <th>Title</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

            <?php while($page = mysqli_fetch_assoc($page_set)) { ?>
                <!-- <?php $genre = find_genre_by_id($page['genre_id']); ?> -->
                <tr>
                    <td><?php echo h($page['id']); ?></td>
                    <!-- <td><?php echo h($genre['menu_name']); ?></td> -->
                    <td><?php echo h($page['position']); ?></td>
                    <!-- don't need to htmlspecialchars for visible as not outputting the value of it onto page -->
                    <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
                    <td><?php echo h($page['menu_name']); ?></td>
                    <td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id']))); ?>">View</a></td>
                    <td><a class="action" href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id']))); ?>">Edit</a></td>
                    <td><a class="action" href="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id']))); ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

        <?php 
        
        mysqli_free_result($page_set);

        ?>

    </div>


</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>