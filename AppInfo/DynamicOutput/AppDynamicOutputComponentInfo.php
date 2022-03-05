<?php

use Apps\AppInfo\resources\config\Sprints;
use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\ComponentInfo;

$appsConfiguredComponentOverviewHtml = ComponentInfo::appsConfiguredComponentOverviewHtml();

printf(
    Sprints::outputContainerSprint(),
    (
    empty($appsConfiguredComponentOverviewHtml)
    ? ComponentInfo::noConfiguredComponentsMessage(
        'DynamicOutputComponent',
        'new-dynamic-output-component'
    ) 
    : $appsConfiguredComponentOverviewHtml
    )
);
