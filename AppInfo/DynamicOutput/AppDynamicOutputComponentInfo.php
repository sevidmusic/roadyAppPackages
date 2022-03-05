<?php

use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\interfaces\component\Factory\Factory;
use roady\classes\component\DynamicOutputComponent;
use Apps\AppInfo\resources\config\Sprints;
use Apps\AppInfo\resources\config\CoreComponents;

$dynamicOutputComponentInfo = [];

if(
    CoreComponents::appsAppComponentsFactory()->getType() 
    === 
    AppComponentsFactory::class
) {
    foreach (
        CoreComponents::appsAppComponentsFactory()
            ->getStoredComponentRegistry()
            ->getRegisteredComponents()
        as
        $registeredComponent
    ) {
        /**
         * @var DynamicOutputComponent $registeredComponent
         */
        if(
            $registeredComponent->getType() 
            === 
            DynamicOutputComponent::class
        ) {
            array_push(
                $dynamicOutputComponentInfo,
                sprintf(
                    Sprints::dynamicOutputComponentInfoSprint(),
                    $registeredComponent->getName(),
                    $registeredComponent->getUniqueId(),
                    $registeredComponent->getType(),
                    $registeredComponent->getLocation(),
                    $registeredComponent->getContainer(),
                    $registeredComponent->getPosition(),
                    (
                        $registeredComponent->getState() 
                        ? 'true'
                        : 'false'
                    ),
                    $registeredComponent->getDynamicFilePath(),
                    (
                        (
                            CoreComponents::currentRequest()
                                ->getGet()['appName']  
                            ?? 
                            ''
                        )
                        ===
                        'AppInfo'
                        ? '<span class="roady-error-message">' . 
                        'The App Info App\'s DynamicOutput ' .
                        'cannot be previewed.</span>'
                        : $registeredComponent->getOutput()
                    )
                ),
            );
        }
    }
}

$appDynamicOutputComponentInfo = sprintf(
    Sprints::appsConfiguredDynamicOutputComponentSprint(),
    CoreComponents::currentRequest()->getGet()['appName'] ?? 'roady',
    implode(PHP_EOL, $dynamicOutputComponentInfo)
);

printf(
    Sprints::outputContainerSprint(),
    (
    empty($dynamicOutputComponentInfo)
    ? 
        '<p class="roady-message">' .
        'There are no DynamicOutputComponents configured for the ' .
        (CoreComponents::currentRequest()->getGet()['appName'] ?? 'roady') .
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
        : $appDynamicOutputComponentInfo
    )
);
