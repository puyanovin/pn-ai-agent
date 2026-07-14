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
BUILD_DIR="${RELEASE_DIR}/${PLUGIN}"

ZIP_NAME="${PLUGIN}-${VERSION}.zip"

echo "Building ${ZIP_NAME}"

rm -rf "$BUILD_DIR"
mkdir -p "$BUILD_DIR"

# Core files
cp pn-ai-agent.php "$BUILD_DIR/"
cp uninstall.php "$BUILD_DIR/"
cp readme.txt "$BUILD_DIR/"

# Folders
cp -r assets "$BUILD_DIR/"
cp -r languages "$BUILD_DIR/"
cp -r src "$BUILD_DIR/"
cp -r vendor "$BUILD_DIR/"

# Remove previous zip
rm -f "${RELEASE_DIR}/${ZIP_NAME}"

cd "$RELEASE_DIR"

zip -r "$ZIP_NAME" "$PLUGIN"

cd ..

echo ""
echo "Release created:"
echo "${RELEASE_DIR}/${ZIP_NAME}"
