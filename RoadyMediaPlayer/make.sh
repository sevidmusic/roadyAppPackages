#!/bin/bash
# make.sh

set -o posix


rig --new-app --name RoadyMediaPlayer --domain 'http://localhost:8420'

rig --new-global-response --for-app 'RoadyMediaPlayer' --name 'ManualTests' --position '0'

rig --new-request --for-app 'RoadyMediaPlayer' --name 'ManualTests' --relative-url 'index.php?request=ManualTests' --container 'RoadyMediaPlayerRequests'

rig --new-dynamic-output-component --for-app 'RoadyMediaPlayer' --name 'ManualTests' --container 'RoadyMediaPlayerDynamicOutput' --position '0' 

rig --assign-to-response --for-app 'RoadyMediaPlayer' --response 'ManualTests' --dynamic-output-components 'ManualTests' 
