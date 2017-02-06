<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?></title>
    </head>
    <body>
        Hello <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>
    </body>
</html>
