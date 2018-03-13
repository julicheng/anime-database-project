<?php 

require_once('../../../private/initialize.php');

// if no id then don't show this page
if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}

// if there is an id assign it to the variable $id
$id = $_GET['id'];

// if it's a post request then process the form, if not then show the page
if(is_post_request()) {

    // handle form values sent by new.php
    $page = [];
    $page['id'] = $id;
    $page['genre_id'] = isset($_POST['genre_id']) ? $_POST['genre_id'] : "";
    $page['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name'] : "";
    $page['position'] = isset($_POST['position']) ? $_POST['position'] : "";
    $page['visible'] = isset($_POST['visible']) ? $_POST['visible'] : "";
    $page['content'] = isset($_POST['content']) ? $_POST['content'] : "";

    $result = update_page($page);
    redirect_to(url_for('/staff/pages/show.php?id=' . $id ));

} else {
    $page = find_page_by_id($id);

    $page_set = find_all_pages();
    $page_count = mysqli_num_rows($page_set);
    mysqli_free_result($page_set);
}

?>

<?php $page_title = "Edit Page"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php?id=' . h(u($id))); ?>">&laquo; Back to List</a>

    <div class="page edit">
        <h1>Edit Page</h1>

        <form action="<?php echo url_for('/staff/pages/edit.php?id=' . $id); ?>" method="post">

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
                                echo "<option value=\"{$i}\"";
                                if ($page['position'] == $i) { 
                                    echo " selected"; // add selected if the number matches selected
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
                    <!-- <input type="checkbox" name="visible" value="<?php if($page['visible'] == "1") { echo " checked"; } ?>"> -->
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
                <input type="submit" value="Edit Page">
            </div>

        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>