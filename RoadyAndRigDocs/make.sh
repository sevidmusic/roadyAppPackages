#!/bin/bash
# make.sh

set -o posix


rig --new-app --name RoadyAndRigDocs --domain 'http://localhost:8080'

rig --new-global-response --for-app 'RoadyAndRigDocs' --name 'Documentation' --position '2'

rig --new-request --for-app 'RoadyAndRigDocs' --name 'Documentation' --relative-url 'index.php?request=Documentation' --container 'RoadyAndRigDocsRequests'

rig --new-dynamic-output-component --for-app 'RoadyAndRigDocs' --name 'Documentation' --container 'RoadyAndRigDocsDynamicOutput' --position '0' 

rig --assign-to-response --for-app 'RoadyAndRigDocs' --response 'Documentation' --dynamic-output-components 'Documentation' 
