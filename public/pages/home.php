<?php
// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.
?>
<!DOCTYPE html>
<html lang="<?= $_ENV['MIPHANT_LANG']; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiCheckHash</title>
</head>

<body>
    <div>
        <label for="txtTipoHash">Tipo do Hash</label>
        <select id="txtTipoHash">
            <option value="md5">MD5</option>
            <option value="sha1">SHA1</option>
            <option value="sha256">SHA256</option>
            <option value="sha512">SHA512</option>
        </select>
    </div>
    <div>
        <label for="txtArquivo">Selecione um arquivo</label>
        <input id="txtArquivo" type="text">
    </div>
    <div>
        <label for="txtHash">Digite/Cole o Hash</label>
        <input id="txtHash" type="text">
    </div>

    <button type="button" onclick="checkHash()">Verificar</button>

    <div id="resultado"></div>

    <script src="/js/script.js"></script>
</body>

</html>