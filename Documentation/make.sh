#!/bin/bash
# make.sh

set -o posix


rig --new-app --name Documentation --domain 'http://localhost:8080'

rig --new-response --name 'AboutRoady' --position '0.1' --for-app 'Documentation'

rig --new-response --name 'Apps' --position '0.1' --for-app 'Documentation'

rig --new-response --name 'RIGConfigureAppOutput' --position '0.1' --for-app 'Documentation'

rig --new-global-response --name 'DocumentationMenu' --position '0' --for-app 'Documentation'

rig --new-response --name 'GettingStarted' --position '0' --for-app 'Documentation'

rig --new-response --name 'Installation' --position '0' --for-app 'Documentation'

rig --new-response --name 'rig' --position '0.1' --for-app 'Documentation'

rig --new-request --name 'AboutRoady' --relative-url 'index.php?request=AboutRoady' --container 'DocumentationRequests' --for-app 'Documentation'

rig --new-request --name 'Apps' --relative-url 'index.php?request=Apps' --container 'DocumentationRequests' --for-app 'Documentation'

rig --new-request --name 'RIGConfigureAppOutput' --relative-url 'index.php?request=RIGConfigureAppOutput' --container 'DocumentationRequests' --for-app 'Documentation'

rig --new-request --name 'DocumentationMenu' --relative-url 'index.php?request=DocumentationMenu' --container 'DocumentationRequests' --for-app 'Documentation'

rig --new-request --name 'GettingStarted' --relative-url 'index.php?request=GettingStarted' --container 'DocumentationRequests' --for-app 'Documentation'

rig --new-request --name 'Installation' --relative-url 'index.php?request=Installation' --container 'DocumentationRequests' --for-app 'Documentation'

rig --new-request --name 'Root' --relative-url '' --container 'Requests' --for-app 'Documentation'

rig --new-request --name 'rig' --relative-url 'index.php?request=rig' --container 'DocumentationRequests' --for-app 'Documentation'

rig --new-dynamic-output-component --name 'AboutRoady' --container 'DocumentationDynamicOutput' --position '0.1' --for-app 'Documentation'

rig --new-dynamic-output-component --name 'Apps' --container 'DocumentationDynamicOutput' --position '0.1' --for-app 'Documentation'

rig --new-dynamic-output-component --name 'RIGConfigureAppOutput' --container 'DocumentationDynamicOutput' --position '0.1' --for-app 'Documentation'

rig --new-dynamic-output-component --name 'DocumentationMenu' --container 'DocumentationDynamicOutput' --position '0' --for-app 'Documentation'

rig --new-dynamic-output-component --name 'GettingStarted' --container 'DocumentationDynamicOutput' --position '0.1' --for-app 'Documentation'

rig --new-dynamic-output-component --name 'Installation' --container 'DocumentationDynamicOutput' --position '0.1' --for-app 'Documentation'

rig --new-dynamic-output-component --name 'rig' --container 'DocumentationDynamicOutput' --position '0.1' --for-app 'Documentation'

rig --assign-to-response --response 'AboutRoady' --requests 'AboutRoady' --for-app 'Documentation'

rig --assign-to-response --response 'AboutRoady' --requests 'Root' --for-app 'Documentation'

rig --assign-to-response --response 'AboutRoady' --dynamic-output-components 'AboutRoady' --for-app 'Documentation'

rig --assign-to-response --response 'Apps' --requests 'Apps' --for-app 'Documentation'

rig --assign-to-response --response 'Apps' --dynamic-output-components 'Apps' --for-app 'Documentation'

rig --assign-to-response --response 'RIGConfigureAppOutput' --requests 'RIGConfigureAppOutput' --for-app 'Documentation'

rig --assign-to-response --response 'RIGConfigureAppOutput' --dynamic-output-components 'RIGConfigureAppOutput' --for-app 'Documentation'

rig --assign-to-response --response 'DocumentationMenu' --dynamic-output-components 'DocumentationMenu' --for-app 'Documentation'

rig --assign-to-response --response 'GettingStarted' --requests 'GettingStarted' --for-app 'Documentation'

rig --assign-to-response --response 'GettingStarted' --dynamic-output-components 'GettingStarted' --for-app 'Documentation'

rig --assign-to-response --response 'Installation' --requests 'Installation' --for-app 'Documentation'

rig --assign-to-response --response 'Installation' --dynamic-output-components 'Installation' --for-app 'Documentation'

rig --assign-to-response --response 'rig' --requests 'rig' --for-app 'Documentation'

rig --assign-to-response --response 'rig' --dynamic-output-components 'rig' --for-app 'Documentation'
