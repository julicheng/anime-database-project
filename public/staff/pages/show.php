<?php require_once('../../../private/initialize.php'); ?>

<?php 

$id = isset($_GET['id']) ? $_GET['id'] : '1';

// $id = $_GET['id'] ?? '1'; // PHP 7.0 or more

$page = find_page_by_id($id);

?>

<?php $page_title = "Show Page" ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('staff/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject show">

        <h1>Title: <?php echo h($page['menu_name']); ?></h1>

        <div class="attributes">
            <!-- returns an assoc array -->
            <?php $genre = find_genre_by_id($page['genre_id']); ?>
            <dl>
                <dt>Title</dt>
                <dd><?php echo h($page['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Genre ID</dt>
                <dd><?php echo h($genre['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($page['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo h($page['visible']) == "1" ? "true" : "false"; ?></dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd><?php echo h($page['content']); ?></dd>
            </dl>

        </div>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>