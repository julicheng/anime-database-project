<?php require_once('../../../private/initialize.php'); ?>

<?php 

require_login();

$id = isset($_GET['id']) ? $_GET['id'] : '1';

// $id = $_GET['id'] ?? '1'; // PHP 7.0 or more

$page = find_page_by_id($id);
// returns an assoc array
$genre = find_genre_by_id($page['genre_id']);

?>

<?php $page_title = "Show Page" ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('staff/genres/show.php?id=' . h(u($page['genre_id']))); ?>">&laquo; Back to Genre Page</a>

    <div class="page show">

        <h1>Title: <?php echo h($page['menu_name']); ?></h1>

        <div class="actions">
            <a class="action" href="<?php echo url_for('index.php?id=' . h(u($genre['id']))) . '&preview=true'; ?>" target="_blank">Preview</a>
        </div>

        <div class="attributes">
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