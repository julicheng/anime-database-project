<?php 
    if (!isset($page_title)) {
        $page_title = "Staff Area";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anime Database - <?php echo h($page_title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link rel="stylesheet" href="<?php echo url_for('/stylesheets/staff.css'); ?>">
</head>
<body>
    <header>
        <h1>Anime Database - <?php echo h($page_title); ?></h1>
    </header>

    <navigation>
        <ul>
            <li>User: <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></li>
            <li><a href="<?php echo url_for('/staff/index.php'); ?>">Menu</a></li>
            <li><a href="<?php echo url_for('/staff/logout.php'); ?>">Logout</a></li>
        </ul>
    </navigation>

    <?php echo display_session_message(); ?>