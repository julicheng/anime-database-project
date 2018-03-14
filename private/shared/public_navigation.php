<navigation>

    <?php $nav_genres = find_all_genres(); ?>
    <ul class="subjects">
        <?php while($nav_genre = mysqli_fetch_assoc($nav_genres)) { ?>
            <li>
                <a href="<?php echo url_for('index.php'); ?>">
                <?php echo h($nav_genre['menu_name']); ?>
                </a>
            </li>
        <?php } // while $nav_genres ?>
    </ul>   
    <?php mysqli_free_result($nav_genres); ?>

</navigation>