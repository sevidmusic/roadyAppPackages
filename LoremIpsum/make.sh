#!/bin/bash
# make.sh

set -o posix


rig --new-app --name LoremIpsum --domain 'http://localhost:8080'

rig --new-response --for-app 'LoremIpsum' --name 'LoremIpsum' --position '0'

rig --new-request --for-app 'LoremIpsum' --name 'LoremIpsum' --relative-url 'index.php?request=LoremIpsum' --container 'LoremIpsumRequests'

rig --new-dynamic-output-component --for-app 'LoremIpsum' --name 'LoremIpsum' --container 'LoremIpsumDynamicOutput' --position '0' 

rig --assign-to-response --for-app 'LoremIpsum' --response 'LoremIpsum' --requests 'LoremIpsum' 

rig --assign-to-response --for-app 'LoremIpsum' --response 'LoremIpsum' --dynamic-output-components 'LoremIpsum' 
