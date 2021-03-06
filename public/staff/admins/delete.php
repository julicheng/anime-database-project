<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/admins/index.php'));
}

$id = $_GET['id'];

$admin = find_admin_by_id($id); // for displaying the info of the record wanting to delete

if(is_post_request()) {
   $result = delete_admin($id); // for deleting the record
   $_SESSION['message'] = 'The admin was deleted successfully.';
   redirect_to(url_for('/staff/admins/index.php'));
} else {
    $admin = find_admin_by_id($id);
}

?>

<?php $page_title = "Delete Admin"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

    <div class="admin delete">
        <h1>Delete Admin</h1>
        <p>Are you sure you want to delete this admin?</p>
        <p class="item">Name: <?php echo h($admin['first_name']) . " " . h($admin['last_name']); ?></p>
        <p class="item">Username: <?php echo h($admin['username']); ?></p>
        <p class="item">Email: <?php echo h($admin['email']); ?></p>


        <form action="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete Admin">
            </div>
        </form>
    </div>
</div>