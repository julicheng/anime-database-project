<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/genres/index.php'));
}

$id = $_GET['id'];

$genre = find_genre_by_id($id);

if(is_post_request()) {
   $result = delete_genre($id);
   redirect_to(url_for('/staff/genres/index.php'));
} else {
    $genre = find_genre_by_id($id);
}

?>

<?php $page_title = "Delete Genre"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/genres/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject delete">
        <h1>Delete Genre</h1>
        <p>Are you sure you want to delete this genre?</p>
        <p class="item"><?php echo h($genre['menu_name']); ?></p>

        <form action="<?php echo url_for('/staff/genres/delete.php?id=' . h(u($genre['id']))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete Genre">
            </div>
        </form>
    </div>
</div>