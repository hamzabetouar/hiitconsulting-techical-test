<!DOCTYPE HTML>
<html>
    <head>
        <title>Tchat</title>

        <link rel="stylesheet" href="<?=$request->server->getPath() ?>assets/bootstrap/css/bootstrap.css">
    </head>

    <body>
        <script src="<?=$request->server->getPath() ?>assets/jquery/jquery.js"></script>
        <div class="container" style="margin-top: 40px;">
            <?= $content ?>
        </div>
    </body>
</html>