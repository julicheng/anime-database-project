<?php 

require_once('../../../private/initialize.php');

// if no id then don't show this page
if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/admins/index.php'));
}

// if there is an id assign it to the variable $id
$id = $_GET['id'];

// if it's a post request then process the form, if not then show the page
if(is_post_request()) {

    // handle form values sent by new.php
    $admin = [];
    $admin['id'] = $id;
    $admin['first_name'] = isset($_POST['first_name']) ? $_POST['first_name'] : "";
    $admin['last_name'] = isset($_POST['last_name']) ? $_POST['last_name'] : "";
    $admin['username'] = isset($_POST['username']) ? $_POST['username'] : "";
    $admin['email'] = isset($_POST['email']) ? $_POST['email'] : "";
    $admin['password'] = isset($_POST['password']) ? $_POST['password'] : "";
    $admin['confirm_password'] = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";    

    $result = update_admin($admin);
    if($result === true) {
        $_SESSION['message'] = 'The admin was edited successfully.';
        redirect_to(url_for('/staff/admins/show.php?id=' . $id )); 
    } else {
        $errors = $result;
    }


} else {
    $admin = find_admin_by_id($id);
}

?>

<?php $page_title = "Edit Admin"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php?id=' . h(u($id))); ?>">&laquo; Back to List</a>

    <div class="admin edit">
        <h1>Edit Admin</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/staff/admins/edit.php?id=' . $id); ?>" method="post">

            <dl>
                <dt>First Name</dt>
                <dd><input type="text" name="first_name" value="<?php echo h($admin['first_name']); ?>"></dd>
            </dl>

            <dl>
                <dt>Last Name</dt>
                <dd><input type="text" name="last_name" value="<?php echo h($admin['last_name']); ?>"></dd>
            </dl>

            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="username" value="<?php echo h($admin['username']); ?>"></dd>
            </dl>

            <dl>
                <dt>Email</dt>
                <dd><input type="email" name="email" value="<?php echo h($admin['email']); ?>"></dd>
            </dl>

            <dl>
                <dt>Password</dt>
                <dd><input type="password" name="password" value=""></dd>
            </dl>

            <dl>
                <dt>Confirm Password</dt>
                <dd><input type="password" name="confirm_password" value=""></dd>
            </dl>
            <p>Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol.</p>

            <div id="operations">
                <input type="submit" value="Edit Admin">
            </div>

        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>