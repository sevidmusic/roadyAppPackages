<?php

use Apps\AppInfo\resources\config\Sprints;
use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\ComponentInfo;
use roady\classes\component\OutputComponent;

printf(
    Sprints::outputContainerSprint(),
    ComponentInfo::htmlOverviewOfAppsConfiguredComponents(
        (
            CoreComponents::currentRequest()->getGet()['appName'] 
            ?? 
            'AppInfo'
        ),
        OutputComponent::class
    )
);
