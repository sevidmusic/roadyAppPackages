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

/** Vars and Constants */

const ONLINE_DOCUMENTATION_REQUEST = 'https://roady.tech/index.php?request=';
const OUTPUT_CONTAINER_SPRINT = '
    <div class="roady-app-output-container">%s</div>
';
const APPS_CONFIGURED_DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT = '
    <h2>DynamicOutputComponents configured by the %s App:</h2>
    %s
';
const DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT = '
    <h3>%s</h3>
    <ul class="roady-ul-list">
        <li>Unique Id:</li>
        <li> %s</li>
    </ul>
    <ul class="roady-ul-list">
        <li>Type:</li>
        <li> %s</li>
    </ul>
    <ul class="roady-ul-list">
        <li>Location:</li>
        <li> %s</li>
    </ul>
    <ul class="roady-ul-list">
        <li>Container:</li>
        <li> %s</li>
    </ul>
    <ul class="roady-ul-list">
        <li>Position:</li>
        <li> %s</li>
    </ul>
    <ul class="roady-ul-list">
        <li>State:</li>
        <li> %s</li>
    </ul>
    <ul class="roady-ul-list">
        <li>DynamicOutput file:</li>
        <li> %s</li>
    </ul>
    <ul class="roady-ul-list">
        <li>Output:</li>
        <li>%s</li>
    </ul>
';

$currentRequest = new Request(
    new Storable(
        'CurrentRequest',
        'AppInfoRequests',
        'CurrentRequests'
    ),
    new Switchable()
);

$componentCrud = new ComponentCrud(
    new Storable(
        'Crud',
        'AppInfoCruds',
        'ComponentCruds'
    ),
    new Switchable(),
    new StorageDriver(
        new Storable(
            'AppInfoCrudStorageDriver',
            'AppInfoDrivers',
            'StorageDrivers'
        ),
        new Switchable()
    )
);

/**
 * @var AppComponentsFactory 
 */
$factory = $componentCrud->readByNameAndType(
    ($currentRequest->getGet()['appName'] ?? 'roady'),
    AppComponentsFactory::class,
    App::deriveAppLocationFromRequest($currentRequest),
    Factory::CONTAINER
);

$dynamicOutputComponentInfo = [];

/** Logic */

/**
 * @var AppComponentsFactory $factory
 */
if($factory->getType() === AppComponentsFactory::class) {
    foreach (
        $factory->getStoredComponentRegistry()->getRegisteredComponents()
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
                    DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT,
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
                        ($currentRequest->getGet()['appName']  ?? '')
                        ===
                        'AppInfo'
                        ? '<span class="roady-error-message">' . 
                        'The App Info App\'s DynamicOutput cannot be previewed.' .
                        '</span>'
                        : $registeredComponent->getOutput()
                    )
                ),
            );
        }
    }
}

$appDynamicOutputComponentInfo = sprintf(
    APPS_CONFIGURED_DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT,
    $currentRequest->getGet()['appName'] ?? 'roady',

    '<div class="roady-generic-container">' .
    implode(PHP_EOL, $dynamicOutputComponentInfo) .
    '</div>'
);

printf(
    OUTPUT_CONTAINER_SPRINT,
    (
    empty($outputComponentInfo)
    ? 
        '<p class="roady-message">' .
        'There are no DynamicOutputComponents configured for the ' .
        ($currentRequest->getGet()['appName'] ?? 'roady') .
        ' app.' .
        '</p>' .
        '<p class="roady-note">' .
        'To configure a new DynamicOutputComponent' .
        ' use <code class="roady-inline-code">' .
        '<a href="' .
            ONLINE_DOCUMENTATION_REQUEST . 
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
