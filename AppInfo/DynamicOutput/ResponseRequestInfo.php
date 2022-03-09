<?php

use Apps\AppInfo\resources\config\Sprints;
use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\ComponentInfo;
use roady\classes\component\Web\Routing\Request;

printf(
    Sprints::outputContainerSprint(),
    ComponentInfo::htmlOverviewOfResponsesConfiguredComponents(
        ComponentInfo::requestedResponseName(),
        Request::class
    )
);
