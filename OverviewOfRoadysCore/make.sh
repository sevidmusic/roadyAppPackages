#!/bin/bash
# make.sh

set -o posix


rig --new-app --name OverviewOfRoadysCore --domain 'http://localhost:8080'

rig --new-response --for-app 'OverviewOfRoadysCore' --name 'Identifiable' --position '1'

rig --new-request --for-app 'OverviewOfRoadysCore' --name 'Identifiable' --relative-url 'index.php?request=Identifiable' --container 'OverviewOfRoadysCoreRequests'

rig --new-request --for-app 'OverviewOfRoadysCore' --name 'Identifiable0' --relative-url 'index.php?request=Primary' --container 'OverviewOfRoadysCoreRequests'

rig --new-request --for-app 'OverviewOfRoadysCore' --name 'Identifiable1' --relative-url '?request=Primary' --container 'Requests'

rig --new-dynamic-output-component --for-app 'OverviewOfRoadysCore' --name 'Identifiable' --container 'OverviewOfRoadysCoreDynamicOutput' --position '0' 

rig --assign-to-response --for-app 'OverviewOfRoadysCore' --response 'Identifiable' --requests 'Identifiable1' 

rig --assign-to-response --for-app 'OverviewOfRoadysCore' --response 'Identifiable' --requests 'Identifiable' 

rig --assign-to-response --for-app 'OverviewOfRoadysCore' --response 'Identifiable' --requests 'Identifiable0' 

rig --assign-to-response --for-app 'OverviewOfRoadysCore' --response 'Identifiable' --dynamic-output-components 'Identifiable' 
