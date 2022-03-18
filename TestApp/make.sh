#!/bin/bash
# make.sh

set -o posix


rig --new-app --name TestApp --domain 'http://localhost:8080'

rig --new-response --for-app 'TestApp' --name 'DynamicOutputComponent' --position '0'

rig --new-response --for-app 'TestApp' --name 'DynamicOutputConfiguredToRespondToMultipleRequests' --position '0'

rig --new-global-response --for-app 'TestApp' --name 'EmptyGlobalResponse' --position '0'

rig --new-response --for-app 'TestApp' --name 'EmptyResponse' --position '0'

rig --new-global-response --for-app 'TestApp' --name 'GlobalOutputComponent' --position '0'

rig --new-response --for-app 'TestApp' --name 'NegativelyPositionedDynamicOutputComponent' --position '-1'

rig --new-response --for-app 'TestApp' --name 'NegativelyPositionedOutputComponent' --position '-2'

rig --new-response --for-app 'TestApp' --name 'OutputComponent' --position '0'

rig --new-response --for-app 'TestApp' --name 'OutputComponentConfiguredToRespondToMultipleRequests' --position '0'

rig --new-request --for-app 'TestApp' --name 'DynamicOutputComponent' --relative-url 'index.php?request=DynamicOutputComponent' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'DynamicOutputConfiguredToRespondToMultipleRequests' --relative-url 'index.php?request=DynamicOutputConfiguredToRespondToMultipleRequests' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'DynamicOutputConfiguredToRespondToMultipleRequests0' --relative-url '' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'DynamicOutputConfiguredToRespondToMultipleRequests1' --relative-url 'index.php' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'DynamicOutputConfiguredToRespondToMultipleRequests2' --relative-url '?request=multiRequest' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'DynamicOutputConfiguredToRespondToMultipleRequests3' --relative-url 'index.php?request=multiRequest' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'DynamicOutputConfiguredToRespondToMultipleRequests4' --relative-url 'multiRequest' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'GlobalOutputComponent' --relative-url 'index.php?request=GlobalOutputComponent' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'NegativelyPositionedDynamicOutputComponent' --relative-url 'index.php?request=NegativelyPositionedDynamicOutputComponent' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'NegativelyPositionedOutputComponent' --relative-url 'index.php?request=NegativelyPositionedOutputComponent' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'OutputComponent' --relative-url 'index.php?request=OutputComponent' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'OutputComponentConfiguredToRespondToMultipleRequests' --relative-url 'index.php?request=OutputComponentConfiguredToRespondToMultipleRequests' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'OutputComponentConfiguredToRespondToMultipleRequests0' --relative-url '' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'OutputComponentConfiguredToRespondToMultipleRequests1' --relative-url 'index.php' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'OutputComponentConfiguredToRespondToMultipleRequests2' --relative-url '?request=multiRequest' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'OutputComponentConfiguredToRespondToMultipleRequests3' --relative-url 'index.php?request=multiRequest' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'OutputComponentConfiguredToRespondToMultipleRequests4' --relative-url 'multiRequest' --container 'TestAppRequests'

rig --new-request --for-app 'TestApp' --name 'RequestWithCustomContainer' --relative-url '?request=unassignedRequests' --container 'CustomContainerName'

rig --new-request --for-app 'TestApp' --name 'UnassignedRequest' --relative-url '?request=unassignedRequests' --container 'Requests'

rig --new-dynamic-output-component --for-app 'TestApp' --name 'DynamicOutputComponent' --container 'TestAppDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'TestApp' --name 'DynamicOutputConfiguredToRespondToMultipleRequests' --container 'TestAppDynamicOutput' --position '0' 

rig --new-output-component --for-app 'TestApp' --name 'FooBarOC' --output '<p>Foo Bar Output Component</p>' --container 'OutputComponents' --position '2938'

rig --new-output-component --for-app 'TestApp' --name 'GlobalOutputComponent' --output '<h1>Configured Global Static Output</h1><p>Some text, lorem ipsum, <a href="https://github.com/sevidmusic/roady">roady on GitHub</a>.</p>' --container 'TestAppOutput' --position '0'

rig --new-dynamic-output-component --for-app 'TestApp' --name 'NegativelyPositionedDynamicOutputComponent' --container 'TestAppDynamicOutput' --position '0' 

rig --new-output-component --for-app 'TestApp' --name 'NegativelyPositionedOutputComponent' --output '<style> body { background-color: blue; } </style>' --container 'TestAppOutput' --position '0'

rig --new-output-component --for-app 'TestApp' --name 'OutputComponent' --output '<h1>Configured Static Output</h1><p>Some text, lorem ipsum, <a href="https://roady.tech">roady.tech</a>.</p>' --container 'TestAppOutput' --position '0'

rig --new-output-component --for-app 'TestApp' --name 'OutputComponentConfiguredToRespondToMultipleRequests' --output '<h1>Output Component Configured To Respond To Multiple Requests</h1><p>Some text, lorem ipsum, <a href="https://roady.tech">roady.tech</a>.</p>' --container 'TestAppOutput' --position '0'

rig --new-dynamic-output-component --for-app 'TestApp' --name 'UnassignedDynamicOutputComponent' --container 'UnassignedDynamicOutputComponents' --position '0' 

rig --new-output-component --for-app 'TestApp' --name 'UnassignedOutputComponent' --output '<h1>Unassigned Output Component</h1><p>Some text, lorem ipsum, <a href="https://roady.tech">roady.tech</a>.</p>' --container 'UnassignedOutputComponents' --position '5'

rig --assign-to-response --for-app 'TestApp' --response 'DynamicOutputComponent' --requests 'DynamicOutputComponent' 

rig --assign-to-response --for-app 'TestApp' --response 'DynamicOutputComponent' --dynamic-output-components 'DynamicOutputComponent' 

rig --assign-to-response --for-app 'TestApp' --response 'DynamicOutputConfiguredToRespondToMultipleRequests' --requests 'DynamicOutputConfiguredToRespondToMultipleRequests' 

rig --assign-to-response --for-app 'TestApp' --response 'DynamicOutputConfiguredToRespondToMultipleRequests' --requests 'DynamicOutputConfiguredToRespondToMultipleRequests0' 

rig --assign-to-response --for-app 'TestApp' --response 'DynamicOutputConfiguredToRespondToMultipleRequests' --requests 'DynamicOutputConfiguredToRespondToMultipleRequests1' 

rig --assign-to-response --for-app 'TestApp' --response 'DynamicOutputConfiguredToRespondToMultipleRequests' --requests 'DynamicOutputConfiguredToRespondToMultipleRequests2' 

rig --assign-to-response --for-app 'TestApp' --response 'DynamicOutputConfiguredToRespondToMultipleRequests' --requests 'DynamicOutputConfiguredToRespondToMultipleRequests3' 

rig --assign-to-response --for-app 'TestApp' --response 'DynamicOutputConfiguredToRespondToMultipleRequests' --requests 'DynamicOutputConfiguredToRespondToMultipleRequests4' 

rig --assign-to-response --for-app 'TestApp' --response 'DynamicOutputConfiguredToRespondToMultipleRequests' --dynamic-output-components 'DynamicOutputConfiguredToRespondToMultipleRequests' 

rig --assign-to-response --for-app 'TestApp' --response 'GlobalOutputComponent' --output-components 'GlobalOutputComponent'

rig --assign-to-response --for-app 'TestApp' --response 'NegativelyPositionedDynamicOutputComponent' --requests 'NegativelyPositionedDynamicOutputComponent' 

rig --assign-to-response --for-app 'TestApp' --response 'NegativelyPositionedDynamicOutputComponent' --dynamic-output-components 'NegativelyPositionedDynamicOutputComponent' 

rig --assign-to-response --for-app 'TestApp' --response 'NegativelyPositionedOutputComponent' --requests 'NegativelyPositionedOutputComponent' 

rig --assign-to-response --for-app 'TestApp' --response 'NegativelyPositionedOutputComponent' --output-components 'NegativelyPositionedOutputComponent'

rig --assign-to-response --for-app 'TestApp' --response 'OutputComponent' --requests 'OutputComponent' 

rig --assign-to-response --for-app 'TestApp' --response 'OutputComponent' --output-components 'OutputComponent'

rig --assign-to-response --for-app 'TestApp' --response 'OutputComponentConfiguredToRespondToMultipleRequests' --requests 'OutputComponentConfiguredToRespondToMultipleRequests' 

rig --assign-to-response --for-app 'TestApp' --response 'OutputComponentConfiguredToRespondToMultipleRequests' --requests 'OutputComponentConfiguredToRespondToMultipleRequests0' 

rig --assign-to-response --for-app 'TestApp' --response 'OutputComponentConfiguredToRespondToMultipleRequests' --requests 'OutputComponentConfiguredToRespondToMultipleRequests1' 

rig --assign-to-response --for-app 'TestApp' --response 'OutputComponentConfiguredToRespondToMultipleRequests' --requests 'OutputComponentConfiguredToRespondToMultipleRequests2' 

rig --assign-to-response --for-app 'TestApp' --response 'OutputComponentConfiguredToRespondToMultipleRequests' --requests 'OutputComponentConfiguredToRespondToMultipleRequests3' 

rig --assign-to-response --for-app 'TestApp' --response 'OutputComponentConfiguredToRespondToMultipleRequests' --requests 'OutputComponentConfiguredToRespondToMultipleRequests4' 

rig --assign-to-response --for-app 'TestApp' --response 'OutputComponentConfiguredToRespondToMultipleRequests' --output-components 'FooBarOC'

rig --assign-to-response --for-app 'TestApp' --response 'OutputComponentConfiguredToRespondToMultipleRequests' --output-components 'OutputComponentConfiguredToRespondToMultipleRequests'
