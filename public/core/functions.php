<?php
// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

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

    return $arquivo;
}

function validarAlfanumerico(string $valor): bool
{
    return preg_match('/\A[a-zA-Z0-9]+\z/', $valor) === 1;
}