<?php require_once('../../../private/initialize.php'); ?>

<?php 

$pages = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'Nana'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Tsuki Ga Kirei'],
    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Kimi Ni Todoke'],
    ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Anohana'],
];

?>

<?php $page_title = "Pages"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="listing pages">
        <h1>Pages</h1>

        <div class"actions">
            <a class="action" href="<?php echo url_for('/staff/pages/new.php'); ?>">Create New Page</a>
        </div>

        <table class="list">
            <tr>
                <th>ID</th>
                <th>Position</th>
                <th>Visible</th>
                <th>Title</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach($pages as $page) { ?>
                <tr>
                    <td><?php echo h($page['id']); ?></td>
                    <td><?php echo h($page['position']); ?></td>
                    <!-- don't need to htmlspecialchars for visible as not outputting the value of it onto page -->
                    <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
                    <td><?php echo h($page['menu_name']); ?></td>
                    <td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id']))); ?>">View</a></td>
                    <td><a class="action" href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id']))); ?>">Edit</a></td>
                    <td><a class="action" href="">Delete</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>