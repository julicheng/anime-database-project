<?php 

require_once('../../../private/initialize.php');

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

        <form action="<?php echo url_for('staff/genres/create.php'); ?>" method="post">

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