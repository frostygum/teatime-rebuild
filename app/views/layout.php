<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- DOC TITLE -->
        <title><?= ucfirst($title) ?></title>
        
        <!-- SCRIPTS -->
        <script type="text/javascript" src="<?= JS_PATH ?>index.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" defer></script>

        <!-- ASSETS -->
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet"> 
        <link type="text/css" href="<?= CSS_PATH ?>style.css" rel="stylesheet">
    </head>

    <body>
        <?= $content ?>
    </body>
    
</html>