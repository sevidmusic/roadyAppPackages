#!/bin/bash
# make.sh

set -o posix


rig --new-app --name RoadyMediaPlayer --domain 'http://localhost:8080'

rig --new-response --for-app 'RoadyMediaPlayer' --name 'AddMedia' --position '1'

rig --new-global-response --for-app 'RoadyMediaPlayer' --name 'DevMenu' --position '0'

rig --new-global-response --for-app 'RoadyMediaPlayer' --name 'SelectMedia' --position '3'

rig --new-response --for-app 'RoadyMediaPlayer' --name 'ViewMedia' --position '2'

rig --new-request --for-app 'RoadyMediaPlayer' --name 'AddMedia' --relative-url 'index.php?request=AddMedia' --container 'RoadyMediaPlayerRequests'

rig --new-request --for-app 'RoadyMediaPlayer' --name 'DevMenu' --relative-url 'index.php?request=DevMenu' --container 'RoadyMediaPlayerRequests'

rig --new-request --for-app 'RoadyMediaPlayer' --name 'SelectMedia' --relative-url 'index.php?request=SelectMedia' --container 'RoadyMediaPlayerRequests'

rig --new-request --for-app 'RoadyMediaPlayer' --name 'ViewMedia' --relative-url 'index.php?request=ViewMedia' --container 'RoadyMediaPlayerRequests'

rig --new-dynamic-output-component --for-app 'RoadyMediaPlayer' --name 'AddMedia' --container 'RoadyMediaPlayerDynamicOutput' --position '1' 

rig --new-dynamic-output-component --for-app 'RoadyMediaPlayer' --name 'DevMenu' --container 'RoadyMediaPlayerDynamicOutput' --position '0' 

rig --new-dynamic-output-component --for-app 'RoadyMediaPlayer' --name 'SelectMedia' --container 'RoadyMediaPlayerDynamicOutput' --position '1' 

rig --new-dynamic-output-component --for-app 'RoadyMediaPlayer' --name 'ViewMedia' --container 'RoadyMediaPlayerDynamicOutput' --position '2' 

rig --assign-to-response --for-app 'RoadyMediaPlayer' --response 'AddMedia' --requests 'AddMedia' 

rig --assign-to-response --for-app 'RoadyMediaPlayer' --response 'AddMedia' --dynamic-output-components 'AddMedia' 

rig --assign-to-response --for-app 'RoadyMediaPlayer' --response 'DevMenu' --dynamic-output-components 'DevMenu' 

rig --assign-to-response --for-app 'RoadyMediaPlayer' --response 'SelectMedia' --dynamic-output-components 'SelectMedia' 

rig --assign-to-response --for-app 'RoadyMediaPlayer' --response 'ViewMedia' --requests 'ViewMedia' 

rig --assign-to-response --for-app 'RoadyMediaPlayer' --response 'ViewMedia' --dynamic-output-components 'ViewMedia' 
