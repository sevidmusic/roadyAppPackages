#!/bin/bash
# make.sh

set -o posix


rig --new-app --name sevidmusicPages --domain 'http://localhost:8080'

rig --new-response --for-app 'sevidmusicPages' --name 'Homepage' --position '1'

rig --new-request --for-app 'sevidmusicPages' --name 'Homepage' --relative-url 'index.php?request=Homepage' --container 'sevidmusicPagesRequests'

rig --new-request --for-app 'sevidmusicPages' --name 'Homepage0' --relative-url '' --container 'sevidmusicPagesRequests'

rig --new-request --for-app 'sevidmusicPages' --name 'Homepage1' --relative-url 'index.php' --container 'sevidmusicPagesRequests'

rig --new-dynamic-output-component --for-app 'sevidmusicPages' --name 'Homepage' --container 'sevidmusicPagesDynamicOutput' --position '1' 

rig --assign-to-response --for-app 'sevidmusicPages' --response 'Homepage' --requests 'Homepage' 

rig --assign-to-response --for-app 'sevidmusicPages' --response 'Homepage' --requests 'Homepage0' 

rig --assign-to-response --for-app 'sevidmusicPages' --response 'Homepage' --requests 'Homepage1' 

rig --assign-to-response --for-app 'sevidmusicPages' --response 'Homepage' --dynamic-output-components 'Homepage' 
