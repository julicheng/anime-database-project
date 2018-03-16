<?php require_once('../../private/initialize.php'); ?> 

<?php $page_title = "Staff Area"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

    <div id="content">

        <div id="main-menu">
            <h2>Main Menu</h2>
            <ul>
                <!-- forward slash means absolute url -->
                <li><a href="<?php echo url_for('staff/genres/index.php'); ?>">Genres</a></li>
                <li><a href="<?php echo url_for('staff/pages/index.php'); ?>">Pages</a></li>
                <li><a href="<?php echo url_for('staff/admins/index.php'); ?>">Admins</a></li>
            </ul>
        </div>

    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>