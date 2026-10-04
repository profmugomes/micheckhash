<?php
// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

declare(strict_types=1);

function getHash(string $txtTipo, string $txtArquivo): string
{
    if (!file_exists($txtArquivo)) {
        return '';
    }

    $ctx = hash_init($txtTipo);
    
    $file = fopen($txtArquivo, 'rb');
    if (!$file) {
        return '';
    }

    while (!feof($file)) {
        $buffer = fread($file, 1048576);
        hash_update($ctx, $buffer);
    }

    fclose($file);

    return hash_final($ctx);
}
