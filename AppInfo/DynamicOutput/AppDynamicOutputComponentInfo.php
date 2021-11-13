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

const OUTPUT_CONTAINER_SPRINT = '
    <div class="roady-app-output-container">%s</div>
';
const APPS_CONFIGURED_DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT = '
    <h1>DynamicOutputComponents configured by the %s app:</h1>
    <!-- 
        Start APPS_CONFIGURED_DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT 
    -->
    %s
    <!-- 
        End APPS_CONFIGURED_DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT 
    -->
';
const DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT = '
    <h2>%s</h2>
    <p>
        <span class="roady-name-value-name">Unique Id:</span>
        <span class="roady-name-value-value"> %s</span>
    </p>
    <p>
        <span class="roady-name-value-name">Type:</span>:
        <span class="roady-name-value-value"> %s</span>
    </p>
    <p>
        <span class="roady-name-value-name">Location:</span>:
        <span class="roady-name-value-value"> %s</span>
    </p>
    <p>
        <span class="roady-name-value-name">Container:</span>:
        <span class="roady-name-value-value"> %s</span>
    </p>
    <p>
        <span class="roady-name-value-name">Position:</span>:
        <span class="roady-name-value-value"> %s</span>
    </p>
    <p>
        <span class="roady-name-value-name">State:</span>:
        <span class="roady-name-value-value"> %s</span>
    </p>
    <p>
        <span class="roady-name-value-name">DynamicOutput file:</span>:
        <span class="roady-name-value-value"> %s</span>
    </p>
    <div class="roady-note-container">
        <p>
            Note: The DynamicOutput file is responsible for 
            generating this DynamicOutputComponent\'s output.
        </p>
    </div>
    <div class="roady-content-seperator"></div>
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
                ),
            );
        }
    }
}

$appDynamicOutputComponentInfo = sprintf(
    APPS_CONFIGURED_DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT,
    $currentRequest->getGet()['appName'] ?? 'roady',
    implode(PHP_EOL, $dynamicOutputComponentInfo)
);


printf(
    OUTPUT_CONTAINER_SPRINT,
    (
    empty($dynamicOutputComponentInfo)
        ? '<p>There are no DynamicOutputComponents configured for the ' .
           ($currentRequest->getGet()['appName'] ?? 'roady') .
           ' app</p>'
        : $appDynamicOutputComponentInfo
    )
);
