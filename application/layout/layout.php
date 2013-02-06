<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>LAYOUT</title>
        <link href="<?= $this->baseUrl() ?>css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="header">header</div>
        <div id="content">
            <?= $this->content(); ?>
        </div>
        <div id="footer">footer</div>
    </body>
</html>
