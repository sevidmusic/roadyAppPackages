<?php

use Apps\AppInfo\resources\config\Sprints;
use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\ComponentInfo;
use roady\classes\component\DynamicOutputComponent;

printf(
    Sprints::outputContainerSprint(),
    ComponentInfo::htmlOverviewOfAppsConfiguredComponents(
        ComponentInfo::requestedAppName(),
        DynamicOutputComponent::class
    )
);
