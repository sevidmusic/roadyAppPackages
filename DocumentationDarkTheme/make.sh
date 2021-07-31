#!/bin/bash
# make.sh

set -o posix


rig --new-app --name DocumentationDarkTheme --domain 'http://localhost:8080'

rig --new-global-response --name 'DocumentationDarkThemeStylesheetLink' --position '-2000' --for-app 'DocumentationDarkTheme'

rig --new-request --name 'DocumentationDarkThemeStylesheetLink' --relative-url 'index.php?request=DocumentationDarkThemeStylesheetLink' --container 'DocumentationDarkThemeRequests' --for-app 'DocumentationDarkTheme'

rig --new-output-component --name 'DocumentationDarkThemeStylesheetLink' --container 'DocumentationDarkThemeOutput' --position '-2000' --output '<link rel="stylesheet" href="Apps/DocumentationDarkTheme/css/documentation-dark-theme.css">' --for-app 'DocumentationDarkTheme'

rig --assign-to-response --response 'DocumentationDarkThemeStylesheetLink' --output-components 'DocumentationDarkThemeStylesheetLink' --for-app 'DocumentationDarkTheme'
