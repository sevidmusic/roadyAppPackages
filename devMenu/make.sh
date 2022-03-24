#!/bin/bash
# make.sh

set -o posix


rig --new-app --name devMenu --domain 'http://localhost:8080'

rig --new-global-response --for-app 'devMenu' --name 'devMenu' --position '5'

rig --new-request --for-app 'devMenu' --name 'devMenu' --relative-url 'index.php?request=devMenu' --container 'devMenuRequests'

rig --new-dynamic-output-component --for-app 'devMenu' --name 'devMenu' --container 'devMenuDynamicOutput' --position '1' 

rig --assign-to-response --for-app 'devMenu' --response 'devMenu' --dynamic-output-components 'devMenu' 
