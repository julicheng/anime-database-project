<?php require_once('../../../private/initialize.php'); ?>

<?php

require_login();

$id = isset($_GET['id']) ? $_GET['id'] : '1';

// $id = $_GET['id'] ?? '1'; // PHP 7.0 or more

$genre = find_genre_by_id($id);

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

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>