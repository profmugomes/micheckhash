// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

const btnCheckHash = document.getElementById('btnCheckHash');
const progressHash = document.getElementById('progressHash');

progressHash.style.display = 'none';

btnCheckHash.addEventListener('click', async () => {
    let formData = new FormData();
    formData.append('txtTipo', document.getElementById('txtTipoHash').value);
    formData.append('txtArquivo', document.getElementById('txtArquivo').value);
    formData.append('txtHash', document.getElementById('txtHash').value);

    btnCheckHash.style.display = 'none';

    document.getElementById('info').innerHTML = '<div class="alert success">Verificar hash...</div>';
    document.getElementById('resultado').innerHTML = '';

    progressHash.style.display = 'block';

    await post('/checkhash', formData, function (response) {
        if (response) {
            document.getElementById('resultado').innerHTML = response;
        }

        progressHash.value = 0;
        progressHash.style.display = 'none';
        document.getElementById('info').innerHTML = '';

        btnCheckHash.style.display = '';
    });
});