// Copyright (C) 2024-2026 Murilo Gomes <profmugomes.com.br>
// SPDX-License-Identifier: GPL-2.0-only

// Site: https://www.profmugomes.com.br

package controls

import (
	"github.com/profmugomes/mglang/v3"
)

func LoadTranslations() {
	lang := mglang.GetLang()
	switch lang {
	case "pt":
		mglang.Set("Tools", "Ferrramentas")
		mglang.Set("Generate Hash", "Gerar Hash")
		mglang.Set("About", "Sobre")
		mglang.Set("Support MiCheckHash", "Apoie MiCheckHash")
		mglang.Set("About MiCheckHash", "Sobre MiCheckHash")

		mglang.Set("Hash Type", "Tipo do Hash")
		mglang.Set("File", "Arquivo")
		mglang.Set("Open File", "Abrir Arquivo")
		mglang.Set("Hash provided by the developer", "Hash fornecido pelo desenvolvedor")
		mglang.Set("Check", "Verificar")
		mglang.Set("Checking...", "Verificando...")
		mglang.Set("File does not exist!", "Arquivo não existe!")
		mglang.Set("Success!", "Sucesso!")
		mglang.Set("Different!", "Diferente!")

		mglang.Set("Generate", "Gerar")
		mglang.Set("Generating hash...", "Gerando hash...")
		mglang.Set("Could not find the file!", "Não foi possível encontrar o arquivo!")
		mglang.Set("Save", "Salvar")
		mglang.Set("Unable to save hash!", "Não foi possível salvar o hash!")

	}
}

func T(key string, args ...any) string {
	return mglang.T(key, args...)
}
