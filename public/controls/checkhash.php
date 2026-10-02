<?php
// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

declare(strict_types=1);

use MiPhantLibs\system\exec;

require_once(dirname(__DIR__) . '/vendor/autoload.php');
require_once(__DIR__ . '/hash.php');

function strposa(string $value, mixed $keywords): bool
{
    if (!is_array($keywords)) {
        $keywords = [$keywords];
    }

    foreach ($keywords as $query) {
        if (strpos($value, $query, 0) !== false) {
            return true; // stop on first true result
        }
    }
    return false;
}

function protegerArquivo(string $arquivo): string|false
{
    if ($arquivo === '' || !is_file($arquivo)) {
        return false;
    }

    return escapeshellarg($arquivo);
}

function validarAlfanumerico(string $valor): bool
{
    return preg_match('/\A[a-zA-Z0-9]+\z/', $valor) === 1;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $txtTipo = trim($_POST['txtTipo'] ?? '');
    $txtArquivo = protegerArquivo(trim($_POST['txtArquivo'] ?? ''));
    $txtHash = trim($_POST['txtHash'] ?? '');

    if (!strposa($txtTipo, ['md5', 'sha1', 'sha256', 'sha512'])) {
        exit('Tipo de Hash não encontrado!');
    }

    if (!validarAlfanumerico($txtHash)) {
        exit('Hash informado incorretamente!');
    }

    if (!$txtArquivo) {
        exit('Arquivo inválido!');
    }

   $sHash = getHash($txtTipo, $txtArquivo);

    if (isset($sHash)) {
        if ($txtHash == $sHash) {
            echo 'Hash Correto!';
        } else {
            echo 'Hash Incorreto!';
        }
    } else {
        echo 'Hash Incorreto!';
    }
}
