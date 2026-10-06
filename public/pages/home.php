<?php
// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

use MiPhantLibs\system\env;

$env = new env();
?>
<!DOCTYPE html>
<html lang="<?= $env->lang(); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiCheckHash</title>

    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <main class="container">
        <section class="card">
            <div class="form-group">
                <label for="txtTipoHash">Tipo do Hash</label>
                <select id="txtTipoHash">
                    <option value="md5">MD5</option>
                    <option value="sha1">SHA1</option>
                    <option value="sha256">SHA256</option>
                    <option value="sha512">SHA512</option>
                </select>
            </div>

            <div class="form-group">
                <label for="txtArquivo">Selecione um Arquivo</label>

                <div class="input-action">
                    <input id="txtArquivo" type="text" readonly>
                    <button id="btnArquivo" type="button">...</button>
                </div>
            </div>

            <div class="form-group">
                <label for="txtHash">Digite/Cole o Hash</label>
                <input id="txtHash" type="text">
            </div>

            <progress id="progressHash" value="0" max="100"></progress>
            <div id="info" class="result"></div>

            <button id="btnCheckHash" type="button" class="button">Verificar</button>
            
            <div id="resultado" class="result"></div>
        </section>
    </main>

    <script src="/js/script.js"></script>
    <script src="/js/home.js"></script>
</body>

</html>