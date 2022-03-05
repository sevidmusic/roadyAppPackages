<?php

use Apps\AppInfo\resources\config\Sprints;
use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\ComponentInfo;

$appsConfiguredComponentOverviewHtml = ComponentInfo::appsConfiguredComponentOverviewHtml();

printf(
    Sprints::outputContainerSprint(),
    (
    empty($appsConfiguredComponentOverviewHtml)
    ? 
        '<p class="roady-message">' .
        'There are no DynamicOutputComponents configured for the ' .
        (
            CoreComponents::currentRequest()->getGet()['appName'] 
            ?? 
            'roady'
        ) .
        ' app.' .
        '</p>' .
        '<p class="roady-note">' .
        'To configure a new DynamicOutputComponent' .
        ' use <code class="roady-inline-code">' .
        '<a href="' .
            Sprints::onlineDocumentationRequestSprint() . 
            'new-dynamic-output-component" ' .
            'target="_blank" ' .
            'rel="noopener noreferrer"' . 
        '>' .
        'rig --new-dynamic-output-component' . 
        '</a>' .
        '</code>'.
        '</p>'
        : $appsConfiguredComponentOverviewHtml
    )
);
