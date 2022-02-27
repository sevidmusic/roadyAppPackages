#!/bin/bash
# make.sh

set -o posix


rig --new-app --name roadyThemeTester --domain 'http://localhost:8080'

rig --new-response --for-app 'roadyThemeTester' --name 'StylePreview' --position '0'

rig --new-request --for-app 'roadyThemeTester' --name 'StylePreview' --relative-url 'index.php?request=StylePreview' --container 'roadyThemeTesterRequests'

rig --new-request --for-app 'roadyThemeTester' --name 'StylePreview0' --relative-url '' --container 'roadyThemeTesterRequests'

rig --new-request --for-app 'roadyThemeTester' --name 'StylePreview1' --relative-url 'index.php' --container 'roadyThemeTesterRequests'

rig --new-dynamic-output-component --for-app 'roadyThemeTester' --name 'StylePreview' --container 'roadyThemeTesterDynamicOutput' --position '0' 

rig --assign-to-response --for-app 'roadyThemeTester' --response 'StylePreview' --requests 'StylePreview1' 

rig --assign-to-response --for-app 'roadyThemeTester' --response 'StylePreview' --requests 'StylePreview0' 

rig --assign-to-response --for-app 'roadyThemeTester' --response 'StylePreview' --requests 'StylePreview' 

rig --assign-to-response --for-app 'roadyThemeTester' --response 'StylePreview' --dynamic-output-components 'StylePreview' 
