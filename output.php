<!DOCTYPE html>
    <html lang="en">
        <head>
            <title><?php echo DESCRIPTION; ?></title>
            <base href="<?php echo SHORTENER_BASE; ?>">
            <meta charset="utf-8">
            <meta name="description" content="<?php echo DESCRIPTION; ?>">
            <link rel="stylesheet" href="<?php echo SHORTENER_BASE; ?>/style.css">

        </head>
<body>
<div id="wrapper">
    <h1><?php echo DESCRIPTION; ?></h1>
    <?php echo $msg; ?>
    <article>
        <form method="post" action="">
            <input type="text" name="shortenme" placeholder="http://www.your.link">
            <input type="submit" value="make short">
        </form>
    </article>
    </div>
</body>
</html>