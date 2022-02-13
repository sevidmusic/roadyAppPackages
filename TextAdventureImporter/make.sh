#!/bin/bash
# make.sh

set -o posix


rig --new-app --name TextAdventureImporter --domain 'http://localhost:8080'

rig --new-response --for-app 'TextAdventureImporter' --name 'TextAdventureImporter' --position '1'

rig --new-request --for-app 'TextAdventureImporter' --name 'TextAdventureImporter' --relative-url 'index.php?request=TextAdventureImporter' --container 'TextAdventureImporterRequests'

rig --new-dynamic-output-component --for-app 'TextAdventureImporter' --name 'TextAdventureImporter' --container 'TextAdventureImporterDynamicOutput' --position '0' 

rig --assign-to-response --for-app 'TextAdventureImporter' --response 'TextAdventureImporter' --requests 'TextAdventureImporter' 

rig --assign-to-response --for-app 'TextAdventureImporter' --response 'TextAdventureImporter' --dynamic-output-components 'TextAdventureImporter' 
