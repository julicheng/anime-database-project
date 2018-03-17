<?php 

require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {
    // handle form values sent by new.php
    $page = [];
    $page['genre_id'] = isset($_POST['genre_id']) ? $_POST['genre_id'] : "";
    $page['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name'] : "";
    $page['position'] = isset($_POST['position']) ? $_POST['position'] : "";
    $page['visible'] = isset($_POST['visible']) ? $_POST['visible'] : "";
    $page['content'] = isset($_POST['content']) ? $_POST['content'] : "";

    $result = insert_page($page);
    if($result === true) {
        $new_id = mysqli_insert_id($db);
        $_SESSION['message'] = 'The page was created successfully.';
        redirect_to(url_for('staff/pages/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }
    

} else {

    $page = [];
    $page['genre_id'] = isset($_GET['genre_id']) ? $_GET['genre_id'] : "1";
    $page['menu_name'] = "";
    $page['position'] = "";
    $page['visible'] = "";
    $page['content'] = "";
}

    $page_set = find_all_pages();
    $page_count = mysqli_num_rows($page_set);
    mysqli_free_result($page_set);

?>

<?php $page_title = "Create Page"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('staff/genres/show.php?id=' . h(u($page['genre_id']))); ?>">&laquo; Back to Genre Page</a>

    <div class="page new">
        <h1>Create Page</h1>

        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('staff/pages/new.php'); ?>" method="post">

            <dl>
                <dt>Title</dt>
                <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>"></dd>
            </dl>

            <dl>
                <dt>Genre ID</dt>
                <dd>
                    <select name="genre_id">
                        <?php 
                        
                        $genre_set = find_all_genres();
                        while($genre = mysqli_fetch_assoc($genre_set)) {
                            echo "<option value=\"" . h($genre['id']) . "\"";
                            if($page["genre_id"] == $genre['id']) {
                                echo " selected";
                            }
                            echo ">" . h($genre['menu_name']) . "</option>";
                        }    
                        mysqli_free_result($genre_set);
                        ?>
                    </select>                    
                </dd>
            </dl>

            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php 
                        
                        for($i=1; $i <= $page_count; $i++) {
                            echo "<option value\"{$i}\"";
                            if($page["position"] == $i) {
                                echo " selected";
                            }
                            echo ">{$i}</option>";
                        }

                        ?>
                    </select>
                </dd>
            </dl>

            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0">
                    <input type="checkbox" name="visible" value="1"<?php if($page['visible'] == "1") { echo " checked"; } ?>>
                </dd>
            </dl>

            <dl>
                <dt>Content</dt>
                <dd>
                    <textarea name="content" id="" cols="30" rows="10" value=""></textarea>
                </dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Create Page">
            </div>

        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>