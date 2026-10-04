// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

const checkHash = document.getElementById('checkHash');
checkHash.addEventListener('click', async () => {
    let formData = new FormData();
    formData.append('txtTipo', document.getElementById('txtTipoHash').value);
    formData.append('txtArquivo', document.getElementById('txtArquivo').value);
    formData.append('txtHash', document.getElementById('txtHash').value);

    document.getElementById('resultado').innerHTML = 'Verificar hash...';

    await post('/checkhash', formData, function (response) {
        if (response) {
            document.getElementById('resultado').innerHTML = response;
        }
    });
});