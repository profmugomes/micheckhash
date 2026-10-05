<?php
// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

use MiPhantLibs\app\router;

require_once(__DIR__ . '/vendor/autoload.php');

$rt = new router();

$rt->get(['/', '/home'], function() {
    require_once(__DIR__ . '/pages/home.php');
});
$rt->get('/checkhash', function() {
    require_once(__DIR__ . '/controls/checkhash.php');
});

$rt->get('/gerarhash', function() {
    require_once(__DIR__ . '/pages/gerarhash.php');
});
$rt->get('/gerarhash/start', function() {
    require_once(__DIR__ . '/controls/gerarhash.php');
});
$rt->get('/gerarhash/save', function() {
    require_once(__DIR__ . '/controls/savehash.php');
});

$rt->get('/about', function() {
    require_once(__DIR__ . '/pages/about.php');
});

if ($rt->noPHP()) {
    return false;
}