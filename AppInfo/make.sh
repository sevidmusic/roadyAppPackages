#!/bin/bash
# make.sh

set -o posix


rig --new-app --name AppInfo --domain 'http://localhost:8420'

rig --new-response --for-app 'AppInfo' --name 'AppDynamicOutputComponentInfo' --position '0'

rig --new-response --for-app 'AppInfo' --name 'AppGlobalResponseInfo' --position '0'

rig --new-response --for-app 'AppInfo' --name 'AppInfo' --position '0'

rig --new-response --for-app 'AppInfo' --name 'AppOutputComponentInfo' --position '0'

rig --new-response --for-app 'AppInfo' --name 'AppRequestInfo' --position '0'

rig --new-response --for-app 'AppInfo' --name 'AppResponseInfo' --position '0'

rig --new-global-response --for-app 'AppInfo' --name 'MainMenu' --position '0'

rig --new-response --for-app 'AppInfo' --name 'ResponseDynamicOutputComponentInfo' --position '0'

rig --new-response --for-app 'AppInfo' --name 'ResponseOutputComponentInfo' --position '0'

rig --new-response --for-app 'AppInfo' --name 'ResponseRequestInfo' --position '0'

rig --new-request --for-app 'AppInfo' --name 'AppDynamicOutputComponentInfo' --relative-url 'index.php?request=AppDynamicOutputComponentInfo' --container 'AppInfoRequests'

rig --new-request --for-app 'AppInfo' --name 'AppGlobalResponseInfo' --relative-url 'index.php?request=AppGlobalResponseInfo' --container 'AppInfoRequests'

rig --new-request --for-app 'AppInfo' --name 'AppInfo' --relative-url 'index.php?request=AppInfo' --container 'AppInfoRequests'

rig --new-request --for-app 'AppInfo' --name 'AppOutputComponentInfo' --relative-url 'index.php?request=AppOutputComponentInfo' --container 'AppInfoRequests'

rig --new-request --for-app 'AppInfo' --name 'AppRequestInfo' --relative-url 'index.php?request=AppRequestInfo' --container 'AppInfoRequests'

rig --new-request --for-app 'AppInfo' --name 'AppResponseInfo' --relative-url 'index.php?request=AppResponseInfo' --container 'AppInfoRequests'

rig --new-request --for-app 'AppInfo' --name 'MainMenu' --relative-url 'index.php?request=MainMenu' --container 'AppInfoRequests'

rig --new-request --for-app 'AppInfo' --name 'ResponseDynamicOutputComponentInfo' --relative-url 'index.php?request=ResponseDynamicOutputComponentInfo' --container 'AppInfoRequests'

rig --new-request --for-app 'AppInfo' --name 'ResponseOutputComponentInfo' --relative-url 'index.php?request=ResponseOutputComponentInfo' --container 'AppInfoRequests'

rig --new-request --for-app 'AppInfo' --name 'ResponseRequestInfo' --relative-url 'index.php?request=ResponseRequestInfo' --container 'AppInfoRequests'

rig --new-dynamic-output-component --for-app 'AppInfo' --name 'AppDynamicOutputComponentInfo' --container 'AppInfoDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'AppInfo' --name 'AppGlobalResponseInfo' --container 'AppInfoDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'AppInfo' --name 'AppInfo' --container 'AppInfoDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'AppInfo' --name 'AppOutputComponentInfo' --container 'AppInfoDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'AppInfo' --name 'AppRequestInfo' --container 'AppInfoDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'AppInfo' --name 'AppResponseInfo' --container 'AppInfoDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'AppInfo' --name 'MainMenu' --container 'AppInfoDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'AppInfo' --name 'ResponseDynamicOutputComponentInfo' --container 'AppInfoDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'AppInfo' --name 'ResponseOutputComponentInfo' --container 'AppInfoDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'AppInfo' --name 'ResponseRequestInfo' --container 'AppInfoDynamicOutput' --position '0' 

rig --assign-to-response --for-app 'AppInfo' --response 'AppDynamicOutputComponentInfo' --requests 'AppDynamicOutputComponentInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'AppDynamicOutputComponentInfo' --dynamic-output-components 'AppDynamicOutputComponentInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'AppGlobalResponseInfo' --requests 'AppGlobalResponseInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'AppGlobalResponseInfo' --dynamic-output-components 'AppGlobalResponseInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'AppInfo' --requests 'AppInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'AppInfo' --dynamic-output-components 'AppInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'AppOutputComponentInfo' --requests 'AppOutputComponentInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'AppOutputComponentInfo' --dynamic-output-components 'AppOutputComponentInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'AppRequestInfo' --requests 'AppRequestInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'AppRequestInfo' --dynamic-output-components 'AppRequestInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'AppResponseInfo' --requests 'AppResponseInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'AppResponseInfo' --dynamic-output-components 'AppResponseInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'MainMenu' --dynamic-output-components 'MainMenu' 

rig --assign-to-response --for-app 'AppInfo' --response 'ResponseDynamicOutputComponentInfo' --requests 'ResponseDynamicOutputComponentInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'ResponseDynamicOutputComponentInfo' --dynamic-output-components 'ResponseDynamicOutputComponentInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'ResponseOutputComponentInfo' --requests 'ResponseOutputComponentInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'ResponseOutputComponentInfo' --dynamic-output-components 'ResponseOutputComponentInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'ResponseRequestInfo' --requests 'ResponseRequestInfo' 

rig --assign-to-response --for-app 'AppInfo' --response 'ResponseRequestInfo' --dynamic-output-components 'ResponseRequestInfo' 
