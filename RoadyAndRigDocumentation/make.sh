#!/bin/bash
# make.sh

set -o posix


rig --new-app --name RoadyAndRigDocumentation --domain 'http://localhost:8080'

rig --new-global-response --for-app 'RoadyAndRigDocumentation' --name 'Documentation' --position '2'

rig --new-response --for-app 'RoadyAndRigDocumentation' --name 'Identifiable' --position '1'

rig --new-global-response --for-app 'RoadyAndRigDocumentation' --name 'MainMenu' --position '0'

rig --new-request --for-app 'RoadyAndRigDocumentation' --name 'Documentation' --relative-url 'index.php?request=Documentation' --container 'RoadyAndRigDocumentationRequests'

rig --new-request --for-app 'RoadyAndRigDocumentation' --name 'Identifiable' --relative-url 'index.php?request=Identifiable' --container 'RoadyAndRigDocumentationRequests'

rig --new-request --for-app 'RoadyAndRigDocumentation' --name 'Identifiable0' --relative-url 'index.php?request=Primary' --container 'RoadyAndRigDocumentationRequests'

rig --new-request --for-app 'RoadyAndRigDocumentation' --name 'Identifiable1' --relative-url '?request=Primary' --container 'RoadyAndRigDocumentationRequests'

rig --new-request --for-app 'RoadyAndRigDocumentation' --name 'MainMenu' --relative-url 'index.php?request=MainMenu' --container 'RoadyAndRigDocumentationRequests'

rig --new-dynamic-output-component --for-app 'RoadyAndRigDocumentation' --name 'Documentation' --container 'RoadyAndRigDocumentationDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'RoadyAndRigDocumentation' --name 'Identifiable' --container 'RoadyAndRigDocumentationDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'RoadyAndRigDocumentation' --name 'MainMenu' --container 'RoadyAndRigDocumentationDynamicOutput' --position '0' 

rig --assign-to-response --for-app 'RoadyAndRigDocumentation' --response 'Documentation' --dynamic-output-components 'Documentation' 

rig --assign-to-response --for-app 'RoadyAndRigDocumentation' --response 'Identifiable' --requests 'Identifiable' 

rig --assign-to-response --for-app 'RoadyAndRigDocumentation' --response 'Identifiable' --requests 'Identifiable0' 

rig --assign-to-response --for-app 'RoadyAndRigDocumentation' --response 'Identifiable' --requests 'Identifiable1' 

rig --assign-to-response --for-app 'RoadyAndRigDocumentation' --response 'Identifiable' --dynamic-output-components 'Identifiable' 

rig --assign-to-response --for-app 'RoadyAndRigDocumentation' --response 'MainMenu' --dynamic-output-components 'MainMenu' 
