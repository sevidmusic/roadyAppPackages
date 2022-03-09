<?php

use Apps\AppInfo\resources\config\Sprints;
use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\ComponentInfo;
use roady\classes\component\Web\Routing\Response;

printf(
    Sprints::outputContainerSprint(),
    ComponentInfo::htmlOverviewOfAppsConfiguredComponents(
        ComponentInfo::requestedAppName(),
        Response::class
    )
);
