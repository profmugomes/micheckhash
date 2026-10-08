<?php
// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

use MiPhantLibs\langs\translate;
use MiPhantLibs\system\env;

$env = new env();
$translate = new translate();
?>
<!DOCTYPE html>
<html lang="<?= $env->lang(); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $translate->get('Generate Hash'); ?> | MiCheckHash</title>

    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <main class="container">
        <section class="card">
            <div class="form-group">
                <label for="txtTipoHash"><?= $translate->get('Hash Type'); ?></label>
                <select id="txtTipoHash">
                    <option value="md5">MD5</option>
                    <option value="sha1">SHA1</option>
                    <option value="sha256">SHA256</option>
                    <option value="sha512">SHA512</option>
                </select>
            </div>

            <div class="form-group">
                <label for="txtArquivo"><?= $translate->get('Select File'); ?></label>

                <div class="input-action">
                    <input id="txtArquivo" type="text" readonly>
                    <button id="btnArquivo" type="button">...</button>
                </div>
            </div>

            <button id="btnGerar" type="button" class="button"><?= $translate->get('Generate'); ?></button>

            <progress id="progressHash" value="0" max="100"></progress>
            
            <div id="resultado" class="result"></div>

            <div id="pnlHash" class="form-group">
                <label for="txtHash">Hash</label>

                <div class="input-action">
                    <input id="txtHash" type="text" readonly>
                    <button id="btnSave" type="button"><?= $translate->get('Save'); ?></button>
                </div>
            </div>
        </section>
    </main>

    <script src="/js/script.js"></script>
    <script src="/js/gerarhash.js"></script>
</body>

</html>