// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

const btnGerar = document.getElementById('btnGerar');
btnGerar.addEventListener('click', async () => {
    let formData = new FormData();
    formData.append('txtTipo', document.getElementById('txtTipoHash').value);
    formData.append('txtArquivo', document.getElementById('txtArquivo').value);

    document.getElementById('resultado').innerHTML = 'Gerar hash...';

    await post('/gerarhash/start', formData, function (response) {
        document.getElementById('txtHash').value = response;
        document.getElementById('resultado').innerHTML = '';
    });
});

const btnSave = document.getElementById('btnSave');
btnSave.addEventListener('click', async () => {
    let formData = new FormData();
    formData.append('txtTipo', document.getElementById('txtTipoHash').value);
    formData.append('txtArquivo', document.getElementById('txtArquivo').value);
    formData.append('txtHash', document.getElementById('txtHash').value);

    document.getElementById('resultado').innerHTML = 'Salvando hash...';

    await post('/gerarhash/save', formData, function (response) {
        if (response) {
            miphant.alert('MiCheckHash', response, 'info', 'Continuar');
        }

        document.getElementById('resultado').innerHTML = '';
    });
});
