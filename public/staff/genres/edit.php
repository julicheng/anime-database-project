<?php 

require_once('../../../private/initialize.php');

// if no id then don't show this page
if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/genres/index.php'));
}

// if there is an id assign it to the variable $id
$id = $_GET['id'];

// if it's a post request then process the form, if not then show the page
if(is_post_request()) {

    // handle form values sent by new.php
    $genre = []; //pass array into function later
    $genre['id'] = $id;
    $genre['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name'] : "";
    $genre['position'] = isset($_POST['position']) ? $_POST['position'] : "";
    $genre['visible'] = isset($_POST['visible']) ? $_POST['visible'] : "";

    $result = update_genre($genre);
    if($result === true) {
        $_SESSION['message'] = 'The genre was edited successfully.';
        redirect_to(url_for('/staff/genres/show.php?id=' . $id)); 
    } else {
        $errors = $result;
        // var_dump($errors);
    }

}  else {
    $genre = find_genre_by_id($id); //now we have an array
}

    $genre_set = find_all_genres(); //find all records then count the records v
    $genre_count = mysqli_num_rows($genre_set);
    mysqli_free_result($genre_set);

    //theres also a count function in php

?>

<?php $page_title = "Edit Genre"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/genres/index.php?id=' . h(u($id))); ?>">&laquo; Back to List</a>

    <div class="subject edit">
        <h1>Edit Genre</h1>
        
        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/staff/genres/edit.php?id=' . $id); ?>" method="post">

            <dl>
                <dt>Genre</dt>
                <dd><input type="text" name="menu_name" value="<?php echo h($genre['menu_name']); ?>"></dd>
            </dl>

            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php
                            for($i=1; $i <= $genre_count; $i++) {
                                echo "<option value=\"{$i}\"";
                                if ($genre['position'] == $i) { 
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
                    <input type="checkbox" name="visible" value="1"<?php if($genre['visible'] == "1") { echo " checked"; } ?>>
                </dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Edit Genre">
            </div>

        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>