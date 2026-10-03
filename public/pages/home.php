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

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f6f8;
            color: #20252b;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 720px;
            margin: 0 auto;
        }

        .card {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: 600;
        }

        input,
        select {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #cbd1d8;
            border-radius: 6px;
            background: #fff;
            color: #20252b;
            font-size: 15px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        input:focus,
        select:focus {
            border-color: #4d7cff;
            box-shadow: 0 0 0 3px rgba(77, 124, 255, 0.12);
        }

        .input-action {
            position: relative;
        }

        .input-action input {
            padding-right: 48px;
        }

        .input-action button {
            position: absolute;
            top: 1px;
            right: 1px;
            width: 42px;
            height: 40px;
            border: 0;
            border-left: 1px solid #cbd1d8;
            border-radius: 0 5px 5px 0;
            background: #f5f6f8;
            color: #59616b;
            font-size: 18px;
            line-height: 1;
            cursor: pointer;
        }

        .input-action button:hover {
            background: #e9ecf0;
        }

        .input-action button:active {
            background: #dfe3e8;
        }

        .button {
            height: 42px;
            padding: 0 20px;
            border: 0;
            border-radius: 6px;
            background: #315efb;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s;
        }

        .button:hover {
            background: #244edb;
        }

        .button:active {
            background: #1d42ba;
        }

        .result {
            margin-top: 17px;
        }

        .alert {
            margin-bottom: 20px;
            padding: 13px 15px;
            border-radius: 6px;
            font-size: 14px;
            line-height: 1.5;
        }

        .alert.success {
            border: 1px solid #a8d8b5;
            background: #eaf7ed;
            color: #216b32;
        }

        .alert.error {
            border: 1px solid #e4a8a8;
            background: #fbecec;
            color: #8b2929;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            .card {
                padding: 20px;
            }
        }
    </style>
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

            <button type="button" onclick="checkHash()" class="button">Verificar</button>

            <div id="resultado" class="result"></div>
        </section>
    </main>

    <script src="/js/script.js" class="result"></script>
</body>

</html>