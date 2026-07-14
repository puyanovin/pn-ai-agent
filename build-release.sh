#!/bin/bash

set -e

PLUGIN="pn-ai-agent"
MAIN_FILE="${PLUGIN}.php"

VERSION=$(grep -i "^ \* Version:" "$MAIN_FILE" | head -1 | sed 's/.*Version:[[:space:]]*//' | tr -d '\r')

if [ -z "$VERSION" ]; then
    echo "Version not found!"
    exit 1
fi

RELEASE_DIR="release"
ZIP_NAME="${PLUGIN}-${VERSION}.zip"

echo "Building release:"
echo "$ZIP_NAME"

mkdir -p "$RELEASE_DIR"

rm -f "${RELEASE_DIR}/${ZIP_NAME}"

zip -r "${RELEASE_DIR}/${ZIP_NAME}" . \
    -x ".git/*" \
    -x ".github/*" \
    -x "release/*" \
    -x "*.zip" \
    -x "node_modules/*" \
    -x "build-release.sh"

echo ""
echo "Release created successfully:"
echo "${RELEASE_DIR}/${ZIP_NAME}"
