<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- DOC TITLE -->
        <title><?= ucfirst($title) ?></title>

        <!-- ASSETS -->
        <link type="text/css" href="<?= CSS_PATH ?>style.css" rel="stylesheet">
        <link type="font/ttf" href="<?= FONT_PATH ?>Quicksand.ttf">
        
        <!-- SCRIPTS -->
        <script type="text/javascript" src="<?= JS_PATH ?>index.js" defer></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    </head>

    <body>
        <?= $content ?>
    </body>
    
</html>