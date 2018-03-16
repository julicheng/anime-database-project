<?php 

require_once('../../../private/initialize.php');

if(is_post_request()) {
    // handle form values sent by new.php

    $genre = [];
    $genre['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name'] : "";
    $genre['position'] = isset($_POST['position']) ? $_POST['position'] : "";
    $genre['visible'] = isset($_POST['visible']) ? $_POST['visible'] : "";

    $result = insert_genre($genre); //use above variables in function
    if($result === true) {
        $new_id = mysqli_insert_id($db); //check the new id that has been created
        $_SESSION['message'] = 'The genre was created successfully.';
        redirect_to(url_for('/staff/genres/show.php?id=' . $new_id)); //use the new id and load show page
    } else {
        $errors = $result;
    }

    } else {
        //
}

$menu_name = "";
$position = "";
$visible = "";

$genre_set = find_all_genres(); //find all records then count the records v
$genre_count = mysqli_num_rows($genre_set) + 1; //need to add one as adding another record
mysqli_free_result($genre_set); 

$genre = [];
$genre['position'] = $genre_count;

?>

<?php $page_title = "Create Genre"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/genres/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create Genre</h1>

        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('staff/genres/new.php'); ?>" method="post">

            <dl>
                <dt>Genre</dt>
                <dd><input type="text" name="menu_name" value="<?php echo h($menu_name); ?>"></dd>
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