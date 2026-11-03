// Copyright (C) 2024-2026 Murilo Gomes <profmugomes.com.br>
// SPDX-License-Identifier: GPL-2.0-only

// Site: https://www.profmugomes.com.br

package main

import (
	"fmt"
	"os"
	"path/filepath"
	"strings"

	"fyne.io/fyne/v2"
	"fyne.io/fyne/v2/container"
	"fyne.io/fyne/v2/layout"
	"fyne.io/fyne/v2/widget"

	"github.com/profmugomes/mgdialogbox/v3"
	"github.com/profmugomes/mgsmartflow/v3"

	c "profmugomes/micheckhash/controls"
)

func showGerarHash() {
	w := a.NewWindow(c.T("Generate Hash"))
	w.CenterOnScreen()
	w.SetFixedSize(true)
	w.Resize(fyne.NewSize(432, 388))

	flow := mgsmartflow.New()

	label1 := widget.NewLabel(c.T("Hash Type"))
	label1.TextStyle = fyne.TextStyle{Bold: true}
	cboTipoHash := widget.NewSelect([]string{"MD5", "SHA1", "SHA256", "SHA512"}, nil)
	cboTipoHash.SetSelectedIndex(0)
	flow.AddRow(container.NewVBox(label1, cboTipoHash))

	label2 := widget.NewLabel(c.T("File"))
	label2.TextStyle = fyne.TextStyle{Bold: true}
	txtArquivo := widget.NewEntry()
	txtArquivo.Disable()

	btnArquivo := widget.NewButton("...", func() {
		mgdialogbox.NewOpenFile(a, c.T("Open File"), []string{}, false, func(filename []string) {
			txtArquivo.SetText(filename[0])
		})
	})
	ctnArquivo := container.NewVBox(widget.NewLabel(""), btnArquivo)
	flow.AddColumn(container.NewVBox(label2, txtArquivo), ctnArquivo)
	flow.Resize(ctnArquivo, 50, 0)

	var txtHash *widget.Entry
	var btnSave *widget.Button
	var btnGerarHash *widget.Button

	lblInfo := widget.NewLabel("")
	flow.AddRow(lblInfo)

	btnGerarHash = widget.NewButton(c.T("Generate"), func() {
		go func() {
			fyne.Do(func() {
				lblInfo.SetText(c.T("Generating hash..."))
				cboTipoHash.Disable()
				btnArquivo.Disable()
				btnGerarHash.Disable()
				btnSave.Disable()
			})

			sFile, err := os.Open(txtArquivo.Text)
			if err != nil {
				fyne.Do(func() {
					mgdialogbox.NewAlert(a, "MiCheckHash", c.T("Could not find the file!"), true, "Ok", nil)
				})
			}
			defer sFile.Close()

			sTipo := cboTipoHash.Selected
			sHash := c.GetHash(strings.ToLower(sTipo), sFile)

			fyne.Do(func() {
				cboTipoHash.Enable()
				btnArquivo.Enable()
				btnGerarHash.Enable()
				btnSave.Enable()

				txtHash.SetText(sHash)

				lblInfo.SetText("")
			})
		}()
	})
	flow.AddColumn(&layout.Spacer{}, btnGerarHash, &layout.Spacer{})

	label3 := widget.NewLabel("Hash")
	label3.TextStyle = fyne.TextStyle{Bold: true}
	txtHash = widget.NewEntry()
	txtHash.Disable()
	btnSave = widget.NewButton(c.T("Save"), func() {
		sFile := filepath.Base(txtArquivo.Text)
		sData := fmt.Sprintf("%s %s", txtHash.Text, sFile)
		err := os.WriteFile(fmt.Sprintf("%s.%s", txtArquivo.Text, strings.ToLower(cboTipoHash.Selected)), []byte(sData), 0644)
		if err != nil {
			mgdialogbox.NewAlert(a, "MiCheckHash", c.T("Unable to save hash!"), true, "Ok", nil)
		}
	})
	ctnSave := container.NewVBox(widget.NewLabel(""), btnSave)
	flow.AddColumn(container.NewVBox(label3, txtHash), ctnSave)
	flow.Resize(ctnSave, 59, 0)

	w.SetContent(flow.Container)
	w.Show()
}
