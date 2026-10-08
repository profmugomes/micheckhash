<?php
// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

declare(strict_types=1);

use MiPhantLibs\langs\translate;

$dirPublic = dirname(__DIR__);

require_once($dirPublic . '/core/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $txtTipo = trim($_POST['txtTipo'] ?? '');
    $txtArquivo = protegerArquivo(trim($_POST['txtArquivo'] ?? ''));
    $txtHash = trim($_POST['txtHash'] ?? '');
    $translate = new translate();

    if (!strposa($txtTipo, ['md5', 'sha1', 'sha256', 'sha512'])) {
        exit($translate->get('Hash type not found!'));
    }

    if (!validarAlfanumerico($txtHash)) {
        exit($translate->get('Incorrect hash provided!'));
    }

    if (!$txtArquivo) {
        exit($translate->get('Invalid file!'));
    }

    if (file_put_contents($txtArquivo . '.' . $txtTipo, sprintf('%s %s', $txtHash, basename($txtArquivo)))) {
        echo $translate->get('File saved successfully!');
    } else {
        echo $translate->get('An error occurred while trying to save the file!');
    }
}
