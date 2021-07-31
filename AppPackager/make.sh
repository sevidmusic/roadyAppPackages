#!/bin/bash
# make.sh

set -o posix


rig --new-app --name AppPackager --domain 'http://localhost:8080'

rig --new-response --name 'AppPackager' --position '1' --for-app 'AppPackager'

rig --new-response --name 'AppPackagerStyles' --position '-100' --for-app 'AppPackager'

rig --new-request --name 'AppPackager' --relative-url 'index.php?page=AppPackager' --container 'Requests' --for-app 'AppPackager'

rig --new-dynamic-output-component --name 'AppPackager' --container 'DynamicOutputComponents' --position '0' --for-app 'AppPackager'

rig --new-output-component --name 'AppPackagerStyles' --container 'AppPackagerSylesheetLinks' --position '1' --output '<link rel="stylesheet" href="Apps/AppPackager/css/app-packager-styles.css">' --for-app 'AppPackager'

rig --assign-to-response --response 'AppPackager' --requests 'AppPackager' --for-app 'AppPackager'

rig --assign-to-response --response 'AppPackager' --dynamic-output-components 'AppPackager' --for-app 'AppPackager'

rig --assign-to-response --response 'AppPackagerStyles' --requests 'AppPackager' --for-app 'AppPackager'

rig --assign-to-response --response 'AppPackagerStyles' --output-components 'AppPackagerStyles' --for-app 'AppPackager'
