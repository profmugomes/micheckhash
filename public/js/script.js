// Copyright (c) 2024-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved. (https://profmugomes.com.br)

// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

function post(url, data, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);

    xhr.onreadystatechange = function() {
      if (this.readyState === 4 && this.status == 200) {
        callback(this.responseText);
      }  
    };

    xhr.send(data);
}

const btnArquivo = document.getElementById('btnArquivo');
btnArquivo.addEventListener('click', async () => {
    document.getElementById('txtArquivo').value = await miphant.openFile();
});
