#!/bin/bash
# make.sh

set -o posix


rig --new-app --name HelloWorld --domain 'http://localhost:8080'

rig --new-response --name 'HelloWorld' --position '0' --for-app 'HelloWorld'

rig --new-request --name 'HelloWorld' --relative-url 'index.php?request=HelloWorld' --container 'HelloWorldRequests' --for-app 'HelloWorld'

rig --new-request --name 'HelloWorld0' --relative-url '' --container 'HelloWorldRequests' --for-app 'HelloWorld'

rig --new-dynamic-output-component --name 'HelloWorld' --container 'HelloWorldDynamicOutput' --position '0' --for-app 'HelloWorld'

rig --assign-to-response --response 'HelloWorld' --requests 'HelloWorld' --for-app 'HelloWorld'

rig --assign-to-response --response 'HelloWorld' --requests 'HelloWorld0' --for-app 'HelloWorld'

rig --assign-to-response --response 'HelloWorld' --dynamic-output-components 'HelloWorld' --for-app 'HelloWorld'
