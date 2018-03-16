<?php 

$page_id = isset($page_id) ? $page_id : "";
$genre_id = isset($genre_id) ? $genre_id : "";

?>

<navigation>

    <?php $nav_genres = find_all_genres(); ?>
    <ul class="subjects">
        <?php while($nav_genre = mysqli_fetch_assoc($nav_genres)) { ?>
            <?php // if(!nav_genre['visible']) { continue; } ?>
            <li class="<?php if($nav_genre['id'] == $genre_id) { echo "selected"; } ?>">
                <a href="<?php echo url_for('index.php?genre_id=' . h(u($nav_genre['id']))); ?>">
                <?php echo h($nav_genre['menu_name']); ?>
                </a>

                <?php if($nav_genre['id'] == $genre_id) { ?> 
                    <?php $nav_pages = find_pages_by_genre_id($nav_genre['id']); ?>
                    <ul class="pages">
                        <?php // if(!nav_page['visible]) { continue; } ?>
                        <?php while($nav_page = mysqli_fetch_assoc($nav_pages)) { ?>
                            <li class="<?php if ($nav_page['id'] == $page_id) { echo "selected";} ?>">
                                <a href="<?php echo url_for('index.php?id=' . h(u($nav_page['id']))); ?>">
                                <?php echo h($nav_page['menu_name']); ?>
                                </a>
                                
                            </li>
                        <?php } // while $nav_pages ?>
                    </ul>   
                    <?php mysqli_free_result($nav_pages); ?>
                <?php } // for if statement to check if nav_genre['id'] == $genre_id ?>
            </li>
        <?php } // while $nav_genres ?>
    </ul>   
    <?php mysqli_free_result($nav_genres); ?>

</navigation>