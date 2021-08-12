#!/bin/bash
# make.sh

set -o posix


rig --new-app --name RoadyAndRigDocs --domain 'http://localhost:8080'

rig --new-global-response --for-app 'RoadyAndRigDocs' --name 'Documentation' --position '2'

rig --new-response --for-app 'RoadyAndRigDocs' --name 'Installation' --position '5'

rig --new-global-response --for-app 'RoadyAndRigDocs' --name 'MainMenu' --position '0'

rig --new-request --for-app 'RoadyAndRigDocs' --name 'Documentation' --relative-url 'index.php?request=Documentation' --container 'RoadyAndRigDocsRequests'

rig --new-request --for-app 'RoadyAndRigDocs' --name 'Installation' --relative-url 'index.php?request=Installation' --container 'RoadyAndRigDocsRequests'

rig --new-request --for-app 'RoadyAndRigDocs' --name 'Installation0' --relative-url 'index.php?request=installation-and-setup' --container 'RoadyAndRigDocsRequests'

rig --new-request --for-app 'RoadyAndRigDocs' --name 'MainMenu' --relative-url 'index.php?request=MainMenu' --container 'RoadyAndRigDocsRequests'

rig --new-dynamic-output-component --for-app 'RoadyAndRigDocs' --name 'Documentation' --container 'RoadyAndRigDocsDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'RoadyAndRigDocs' --name 'Installation' --container 'RoadyAndRigDocsDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'RoadyAndRigDocs' --name 'MainMenu' --container 'RoadyAndRigDocsDynamicOutput' --position '0' 

rig --assign-to-response --for-app 'RoadyAndRigDocs' --response 'Documentation' --dynamic-output-components 'Documentation' 

rig --assign-to-response --for-app 'RoadyAndRigDocs' --response 'Installation' --requests 'Installation' 

rig --assign-to-response --for-app 'RoadyAndRigDocs' --response 'Installation' --requests 'Installation0' 

rig --assign-to-response --for-app 'RoadyAndRigDocs' --response 'Installation' --dynamic-output-components 'Installation' 

rig --assign-to-response --for-app 'RoadyAndRigDocs' --response 'MainMenu' --dynamic-output-components 'MainMenu' 
