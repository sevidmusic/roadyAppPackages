#!/bin/bash
# make.sh

set -o posix


rig --new-app --name RoadyMediaPlayer --domain 'http://localhost:8420'

rig --new-response --for-app 'RoadyMediaPlayer' --name 'AddMedia' --position '0'

rig --new-response --for-app 'RoadyMediaPlayer' --name 'SelectMedia' --position '0'

rig --new-request --for-app 'RoadyMediaPlayer' --name 'AddMedia' --relative-url 'index.php?request=AddMedia' --container 'RoadyMediaPlayerRequests'

rig --new-request --for-app 'RoadyMediaPlayer' --name 'SelectMedia' --relative-url 'index.php?request=SelectMedia' --container 'RoadyMediaPlayerRequests'

rig --new-dynamic-output-component --for-app 'RoadyMediaPlayer' --name 'AddMedia' --container 'RoadyMediaPlayerDynamicOutput' --position '1' 

rig --new-dynamic-output-component --for-app 'RoadyMediaPlayer' --name 'SelectMedia' --container 'RoadyMediaPlayerDynamicOutput' --position '1' 

rig --assign-to-response --for-app 'RoadyMediaPlayer' --response 'AddMedia' --requests 'AddMedia' 

rig --assign-to-response --for-app 'RoadyMediaPlayer' --response 'AddMedia' --dynamic-output-components 'AddMedia' 

rig --assign-to-response --for-app 'RoadyMediaPlayer' --response 'SelectMedia' --requests 'SelectMedia' 

rig --assign-to-response --for-app 'RoadyMediaPlayer' --response 'SelectMedia' --dynamic-output-components 'SelectMedia' 
