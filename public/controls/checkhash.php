<?php
// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

declare(strict_types=1);

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
        exit('<div class="alert error">Tipo de Hash não encontrado!</div>');
    }

    if (!validarAlfanumerico($txtHash)) {
        exit('<div class="alert error">Hash informado incorretamente!</div>');
    }

    if (!$txtArquivo) {
        exit('<div class="alert error">Arquivo inválido!</div>');
    }

    $sHash = getHash($txtTipo, $txtArquivo);

    if (isset($sHash)) {
        if ($txtHash == $sHash) {
            echo '<div class="alert success">Hash Correto!</div>';
        } else {
            echo '<div class="alert error">Hash Incorreto!</div>';
        }
    } else {
        echo '<div class="alert error">Hash Incorreto!</div>';
    }
}
