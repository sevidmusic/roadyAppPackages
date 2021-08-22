#!/bin/bash
# make.sh

set -o posix


rig --new-app --name HelloWorld --domain 'http://localhost:8080'

rig --new-response --for-app 'HelloWorld' --name 'HelloWorld' --position '0'

rig --new-request --for-app 'HelloWorld' --name 'HelloWorld' --relative-url 'index.php?request=HelloWorld' --container 'HelloWorldRequests'

rig --new-request --for-app 'HelloWorld' --name 'HelloWorld0' --relative-url '' --container 'HelloWorldRequests'

rig --new-dynamic-output-component --for-app 'HelloWorld' --name 'HelloWorld' --container 'HelloWorldDynamicOutput' --position '0' 

rig --assign-to-response --for-app 'HelloWorld' --response 'HelloWorld' --requests 'HelloWorld0' 

rig --assign-to-response --for-app 'HelloWorld' --response 'HelloWorld' --requests 'HelloWorld' 

rig --assign-to-response --for-app 'HelloWorld' --response 'HelloWorld' --dynamic-output-components 'HelloWorld' 
