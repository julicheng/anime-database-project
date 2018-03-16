<?php require_once('../private/initialize.php'); ?>

<?php 

if(isset($_GET['id'])) {
    $page_id = $_GET['id'];
    $page = find_page_by_id($page_id, ['visible' => true]);
    if(!$page) {
        redirect_to(url_for('/index.php'));
    }
    $genre_id = $page['genre_id'];
    $genre = find_genre_by_id($genre_id, ['visible' => true]);
    if(!$genre) {
        redirect_to(url_for('/index.php'));
    }
} elseif(isset($_GET['genre_id'])) {
    $genre_id = $_GET['genre_id'];
    $page_set = find_pages_by_genre_id($genre_id, ['visible' => true]);
    $genre = find_genre_by_id($genre_id, ['visible' => true]);
    if(!$genre) {
        redirect_to(url_for('/index.php'));
    }
    $page = mysqli_fetch_assoc($page_set);
    mysqli_free_result($page_set);
    if(!$page) {
        redirect_to(url_for('/index.php'));
    }
} else {
    // nothing selected; show the homepage
}

?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

    <?php include(SHARED_PATH . '/public_navigation.php'); ?>

    <div id="page">
    <?php if (isset($page)) {
        // <!-- show the page from the database -->
        echo strip_tags($page['content'], $allowed_tags = '<div><img><h1><h2><p><br><strong><em><ul><li>');
    } else {
        include(SHARED_PATH . '/static_homepage.php');
    }
    ?>
    </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>