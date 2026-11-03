// Copyright (C) 2024-2026 Murilo Gomes <profmugomes.com.br>
// SPDX-License-Identifier: GPL-2.0-only

// Site: https://www.profmugomes.com.br

package controls

import (
	"crypto/md5"
	"crypto/sha1"
	"crypto/sha256"
	"crypto/sha512"
	"encoding/hex"
	"hash"
	"io"
)

func GetHash(sType string, sFile io.Reader) string {
	var sHash hash.Hash

	switch sType {
	case "md5":
		sHash = md5.New()
	case "sha1":
		sHash = sha1.New()
	case "sha256":
		sHash = sha256.New()
	case "sha512":
		sHash = sha512.New()
	default:
		sHash = md5.New()
	}

	if _, err := io.Copy(sHash, sFile); err != nil {
		return ""
	}

	hashBytes := sHash.Sum(nil)
	return hex.EncodeToString(hashBytes)
}