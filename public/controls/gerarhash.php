<?php
// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

declare(strict_types=1);
ob_implicit_flush(true);

$dirPublic = dirname(__DIR__);

require_once($dirPublic . '/core/hash.php');
require_once($dirPublic . '/core/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $txtTipo = trim($_POST['txtTipo'] ?? '');
    $txtArquivo = protegerArquivo(trim($_POST['txtArquivo'] ?? ''));

    if (!strposa($txtTipo, ['md5', 'sha1', 'sha256', 'sha512'])) {
        exit('Tipo de Hash não encontrado!');
    }

    if (!$txtArquivo) {
        exit('Arquivo inválido!');
    }

    echo getHash($txtTipo, $txtArquivo);
}
