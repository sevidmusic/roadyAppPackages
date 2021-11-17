#!/bin/bash

set -o posix

rig --new-app --name HelloWorld --domain 'http://localhost:8080'

rig --configure-app-output \
    --for-app HelloWorld \
    --name HelloWorld \
    --output '<p>Hello World</p>' \
    --relative-urls 'index.php' '/' 

