#!/bin/bash
# make.sh

set -o posix


rig --new-app --name AppPackager --domain 'http://localhost:8420'

rig --new-response --for-app 'AppPackager' --name 'AppPackager' --position '1'

rig --new-response --for-app 'AppPackager' --name 'AppPackagerStyles' --position '-100'

rig --new-request --for-app 'AppPackager' --name 'AppPackager' --relative-url 'index.php?page=AppPackager' --container 'Requests'

rig --new-dynamic-output-component --for-app 'AppPackager' --name 'AppPackager' --container 'DynamicOutputComponents' --position '0' 

rig --new-output-component --for-app 'AppPackager' --name 'AppPackagerStyles' --output '<link rel="stylesheet" href="Apps/AppPackager/css/app-packager-styles.css">' --container 'AppPackagerSylesheetLinks' --position '1'

rig --assign-to-response --for-app 'AppPackager' --response 'AppPackager' --requests 'AppPackager' 

rig --assign-to-response --for-app 'AppPackager' --response 'AppPackager' --dynamic-output-components 'AppPackager' 

rig --assign-to-response --for-app 'AppPackager' --response 'AppPackagerStyles' --requests 'AppPackager' 

rig --assign-to-response --for-app 'AppPackager' --response 'AppPackagerStyles' --output-components 'AppPackagerStyles'
