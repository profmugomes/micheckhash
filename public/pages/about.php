<?php

use MiPhantLibs\app\about;
use MiPhantLibs\system\env;

$env = new env();
?>
<!DOCTYPE html>
<html lang="<?= $env->lang(); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About MiCheckHash</title>
    <link rel="stylesheet" href="/css/style-about.css">
</head>

<body>
    <?php
    $about = new about();
    $about->show('');
    ?>
</body>

</html>