<?php
// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

declare(strict_types=1);

use MiPhantLibs\system\exec;

function getHash(string $txtTipo, string $txtArquivo): string
{
    $comando = $txtTipo . 'sum "' . $txtArquivo . '"';

    $exec = new exec();
    $exec->command($comando)->run();

    while ($s = $exec->values()) {
        $sHash = strstr($s, ' ', true);
        $exec->clean();
    }

    $exec->close();

    return isset($sHash) ? $sHash : '';
}
