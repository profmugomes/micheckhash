<?php
// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

declare(strict_types=1);

use MiPhantLibs\langs\translate;

ob_implicit_flush(true);

$dirPublic = dirname(__DIR__);

require_once($dirPublic . '/core/hash.php');
require_once($dirPublic . '/core/functions.php');

$translate = new translate();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $txtTipo = trim($_POST['txtTipo'] ?? '');
    $txtArquivo = protegerArquivo(trim($_POST['txtArquivo'] ?? ''));
    $txtHash = trim($_POST['txtHash'] ?? '');

    if (!strposa($txtTipo, ['md5', 'sha1', 'sha256', 'sha512'])) {
        exit('<div class="alert error">' .  $translate->get('Hash type not found!') . '</div>');
    }

    if (!$txtArquivo) {
        exit('<div class="alert error">' . $translate->get('Invalid file!') . '</div>');
    }

    if (!validarAlfanumerico($txtHash)) {
        exit('<div class="alert error">' . $translate->get('Incorrect hash provided!') . '</div>');
    }

    $sHash = getHash($txtTipo, $txtArquivo);

    if ($txtHash == $sHash) {
        echo '<div class="alert success">' . $translate->get('Correct Hash!') . '</div>';
    } else {
        echo '<div class="alert error">' . $translate->get('Incorrect Hash!') . '</div>';
    }
}
