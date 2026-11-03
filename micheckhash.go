// Copyright (C) 2024-2026 Murilo Gomes <profmugomes.com.br>
// SPDX-License-Identifier: GPL-2.0-only

// Site: https://www.profmugomes.com.br

package main

import (
	"net/url"
	"os"
	"strings"

	"fyne.io/fyne/v2"
	"fyne.io/fyne/v2/app"
	"fyne.io/fyne/v2/container"
	"fyne.io/fyne/v2/layout"
	"fyne.io/fyne/v2/widget"

	"github.com/profmugomes/mgdialogbox/v3"
	"github.com/profmugomes/mgsmartflow/v3"

	c "profmugomes/micheckhash/controls"
)

var a fyne.App

const VERSION_APP = "9.0.0"

func main() {
	c.LoadTranslations()

	a = app.NewWithID("br.com.profmugomes.micheckhash")
	a.SetIcon(resourceMicheckhashPng)
	w := a.NewWindow("MiCheckHash")
	w.CenterOnScreen()
	w.SetFixedSize(true)
	w.Resize(fyne.NewSize(424, 392))

	sMenu := fyne.NewMainMenu(
		fyne.NewMenu(c.T("Tools"),
			fyne.NewMenuItem(c.T("Generate Hash"), showGerarHash),
		),
		fyne.NewMenu(c.T("About"),
			fyne.NewMenuItem(c.T("Support MiCheckHash"), func() {
				sURL, _ := url.Parse("https://github.com/profmugomes/micheckhash/releases")
				a.OpenURL(sURL)
			}),
			fyne.NewMenuItemSeparator(),
			fyne.NewMenuItem(c.T("About MiCheckHash"), showAbout),
		),
	)

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

	label3 := widget.NewLabel(c.T("Hash provided by the developer"))
	label3.TextStyle = fyne.TextStyle{Bold: true}
	txtHashDev := widget.NewEntry()
	cHashDev := container.NewVBox(label3, txtHashDev)
	flow.AddRow(cHashDev)
	flow.Gap(cHashDev, 0, 24)

	lblInfo := widget.NewLabel("")

	flow.AddRow(lblInfo)

	var btnCheck *widget.Button

	btnCheck = widget.NewButton(c.T("Check"), func() {
		go func() {
			fyne.Do(func() {
				lblInfo.SetText(c.T("Checking..."))
				cboTipoHash.Disable()
				btnArquivo.Disable()
				txtHashDev.Disable()
				btnCheck.Disable()
			})
			sTipo := cboTipoHash.Selected

			sFile, err := os.Open(txtArquivo.Text)
			if err != nil {
				fyne.Do(func() {
					mgdialogbox.NewAlert(a, "MiCheckHash", c.T("File does not exist!"), true, "Ok", nil)
				})
			}
			defer sFile.Close()

			sFileHash := c.GetHash(strings.ToLower(sTipo), sFile)

			fyne.Do(func() {
				if sFileHash == txtHashDev.Text {
					mgdialogbox.NewAlert(a, "MiCheckHash", c.T("Success!"), false, "Ok", nil)
				} else {
					mgdialogbox.NewAlert(a, "MiCheckHash", c.T("Different!"), true, "Ok", nil)
				}

				cboTipoHash.Enable()
				btnArquivo.Enable()
				txtHashDev.Enable()
				btnCheck.Enable()

				lblInfo.SetText("")
			})
		}()
	})
	flow.AddColumn(&layout.Spacer{}, btnCheck, &layout.Spacer{})
	flow.Resize(btnCheck, 119, 37)

	w.SetMainMenu(sMenu)
	w.SetContent(flow.Container)
	w.ShowAndRun()
}
