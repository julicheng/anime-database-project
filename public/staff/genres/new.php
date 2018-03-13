<?php 

require_once('../../../private/initialize.php');

$menu_name = "";
$position = "";
$visible = "";

if(is_post_request()) {
// handle form values sent by new.php

    $menu_name = isset($_POST['menu_name']) ? $_POST['menu_name'] : "";
    $position = isset($_POST['position']) ? $_POST['position'] : "";
    $visible = isset($_POST['visible']) ? $_POST['visible'] : "";

    echo "Form parameters <br>";
    echo "Menu name: " . $menu_name . "<br>";
    echo "Position: " . $position . "<br>";
    echo "Visible: " . $visible . "<br>";

} 

?>

<?php $page_title = "Create Genre"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/genres/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create Genre</h1>

        <form action="<?php echo url_for('staff/genres/create.php'); ?>" method="post">

            <dl>
                <dt>Genre</dt>
                <dd><input type="text" name="menu_name" value="<?php echo h($menu_name); ?>"></dd>
            </dl>

            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <option value="1"<?php if($position == "1") { echo " selected"; } ?>>1</option>
                    </select>
                </dd>
            </dl>

            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0">
                    <input type="checkbox" name="visible" value="1"<?php if($visible == "1") { echo " checked"; } ?>>
                </dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Create Genre">
            </div>

        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>