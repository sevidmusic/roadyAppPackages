#!/bin/bash
# make.sh

set -o posix


rig --new-app --name RoadyAndRigDocumentation --domain 'http://localhost:8420'

rig --new-global-response --for-app 'RoadyAndRigDocumentation' --name 'Documentation' --position '2'

rig --new-global-response --for-app 'RoadyAndRigDocumentation' --name 'MainMenu' --position '1'

rig --new-request --for-app 'RoadyAndRigDocumentation' --name 'Documentation' --relative-url 'index.php?request=Documentation' --container 'RoadyAndRigDocumentationRequests'

rig --new-request --for-app 'RoadyAndRigDocumentation' --name 'MainMenu' --relative-url 'index.php?request=MainMenu' --container 'RoadyAndRigDocumentationRequests'

rig --new-dynamic-output-component --for-app 'RoadyAndRigDocumentation' --name 'Documentation' --container 'RoadyAndRigDocumentationDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'RoadyAndRigDocumentation' --name 'MainMenu' --container 'RoadyAndRigDocumentationDynamicOutput' --position '0' 

rig --assign-to-response --for-app 'RoadyAndRigDocumentation' --response 'Documentation' --dynamic-output-components 'Documentation' 

rig --assign-to-response --for-app 'RoadyAndRigDocumentation' --response 'MainMenu' --dynamic-output-components 'MainMenu' 
