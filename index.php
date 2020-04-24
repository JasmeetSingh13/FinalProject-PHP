<?php

    require(__DIR__ . '/private/core/app.php');

    $app = new App();

    $app->configure();

    $app->load();

    $app->start();

?>