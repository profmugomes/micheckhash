// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

function post(url, data, callback) {
    var xhr = new XMLHttpRequest();
    var recebido = '';
    var buffer = '';
    var total = 0;

    xhr.open('POST', url, true);

    xhr.onreadystatechange = function() {
        if (this.status != 200) {
            return;
        }

        var novo = this.responseText.substring(recebido.length);
        recebido = this.responseText;

        if (this.readyState === 3) {
            buffer += novo;

            var partes = buffer.split('|');
            buffer = partes.pop();

            partes.forEach(function(parte) {
                if (parte.startsWith('TOTAL:')) {
                    total = parseInt(parte.substring(6));
                }

                if (parte.startsWith('PROGRESS:')) {
                    var processado = parseInt(parte.substring(9));

                    if (total > 0) {
                        progressHash.value =
                            Math.min((processado / total) * 100, 100);
                    }
                }
            });
        }

        if (this.readyState === 4) {
            buffer += novo;

            var partes = buffer.split('|');

            partes.forEach(function(parte) {
                if (parte.startsWith('TOTAL:')) {
                    total = parseInt(parte.substring(6));
                }

                if (parte.startsWith('PROGRESS:')) {
                    var processado = parseInt(parte.substring(9));

                    if (total > 0) {
                        progressHash.value =
                            Math.min((processado / total) * 100, 100);
                    }
                }
            });

            var resposta = partes[partes.length - 1];

            callback(resposta);
        }
    };

    xhr.send(data);
}

const btnArquivo = document.getElementById('btnArquivo');
btnArquivo.addEventListener('click', async () => {
  document.getElementById('txtArquivo').value = await miphant.openFile();
});
