<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Anime Database <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link rel="stylesheet" href="<?php echo url_for('/stylesheets/public.css'); ?>">
</head>
<body>
    
    <header>
        <h1>
            <a href="<?php echo url_for('/index.php'); ?>"></a>
        </h1>
    </header>