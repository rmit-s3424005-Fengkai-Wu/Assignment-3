
<!DOCTYPE html>
<html>
    <head>
        <?php require_once 'parts/head/head.php';?>
        <?php require_once 'parts/head/'.file_name().'_head.php';?>
    </head>
    <body>
        <?php require_once 'parts/masthead.html';?>
        <?php require_once 'parts/navigation.html';?>
        <?php require_once 'parts/content/'.file_name().'_content.php';?>
        <?php require_once 'parts/footer.php';?>
    </body>
</html>