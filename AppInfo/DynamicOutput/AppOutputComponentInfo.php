<?php

use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\interfaces\component\Factory\Factory;
use roady\classes\component\Web\Routing\Response;
use roady\classes\component\Web\Routing\GlobalResponse;
use roady\classes\component\OutputComponent;

/** Vars and Constants */

const OUTPUT_PREVIEW_SPRINT = '<div class="roady-output-preview">%s</div>';
const REQUEST_LINK_SPRINT = '<a href="%s">%s</a>';
const OUTPUT_CONTAINER_SPRINT = '
    <div class="roady-app-output-container">%s</div>
';
const APPS_ASSIGNED_REQUEST_INFO_SPRINT = '
    <h1>OutputComponents configured by the %s app:</h1>
    <!-- Start REQUEST_INFO_SPRINT output -->
    %s
    <!-- End REQUEST_INFO_SPRINT output -->
';
const REQUEST_INFO_SPRINT = '
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
        <span class="roady-name-value-name">Output:</span>:
    </p>
    <!-- Start OUTPUT_PREVIEW_SPRINT -->
    %s
    <!-- End OUTPUT_PREVIEW_SPRINT -->
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

$responseRequestUrls = [];

$responseInfo = [];

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
         * @var OutputComponent $registeredComponent
         */
        if($registeredComponent->getType() === OutputComponent::class) {
            array_push(
                $responseInfo,
                sprintf(
                    REQUEST_INFO_SPRINT,
                    $registeredComponent->getName(),
                    $registeredComponent->getUniqueId(),
                    $registeredComponent->getType(),
                    $registeredComponent->getLocation(),
                    $registeredComponent->getContainer(),
                    $registeredComponent->getPosition(),
                    (
                        $registeredComponent->getState() === true
                        ? 'true'
                        : 'false'
                    ),
                    sprintf(
                        OUTPUT_PREVIEW_SPRINT,
                        $registeredComponent->getOutput()
                    ),
                ),
            );
        }
    }
}

$appInfoOutput = sprintf(
    APPS_ASSIGNED_REQUEST_INFO_SPRINT,
    $currentRequest->getGet()['appName'] ?? 'roady',
    implode(PHP_EOL, $responseInfo)
);


printf(
    OUTPUT_CONTAINER_SPRINT,
    (
    empty($responseInfo)
        ? '<p>There are no OutputComponents configured for the ' .
           ($currentRequest->getGet()['appName'] ?? 'roady') .
           ' app</p>'
        : $appInfoOutput
    )
);
