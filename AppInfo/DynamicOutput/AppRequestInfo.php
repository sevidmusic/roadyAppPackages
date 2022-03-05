<?php

use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\interfaces\component\Factory\Factory;

/** Vars and Constants */

const ONLINE_DOCUMENTATION_REQUEST = 'https://roady.tech/index.php?request=';
const REQUEST_LINK_SPRINT = '<a href="%s">%s</a>';
const OUTPUT_CONTAINER_SPRINT = '
    <div class="roady-app-output-container">%s</div>
';
const APPS_ASSIGNED_REQUEST_INFO_SPRINT = '
    <h2>Requests configured by the %s app:</h2>
    <!-- Start REQUEST_INFO_SPRINT output -->
    %s
    <!-- End REQUEST_INFO_SPRINT output -->
';
const REQUEST_INFO_SPRINT = '
    <div class="roady-generic-container">
        <h3>%s</h3>
        <ul class="roady-ul-list">
            <li>Unique Id:</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Type:</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Location:</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Container:</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Url:</li>
            <li>%s</li>
        </ul>
    </div>
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

$requestInfo = [];

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
         * @var Request $registeredComponent
         */
        if($registeredComponent->getType() === Request::class) {
            array_push(
                $requestInfo,
                sprintf(
                    REQUEST_INFO_SPRINT,
                    $registeredComponent->getName(),
                    $registeredComponent->getUniqueId(),
                    $registeredComponent->getType(),
                    $registeredComponent->getLocation(),
                    $registeredComponent->getContainer(),
                    sprintf(
                        REQUEST_LINK_SPRINT,
                        $registeredComponent->getUrl(),
                        $registeredComponent->getUrl(),
                    ),
                ),
            );
        }
    }
}

$appRequestInfo = sprintf(
    APPS_ASSIGNED_REQUEST_INFO_SPRINT,
    $currentRequest->getGet()['appName'] ?? 'roady',
    implode(PHP_EOL, $requestInfo)
);

printf(
    OUTPUT_CONTAINER_SPRINT,
    (
    empty($appRequestInfo)
    ? 
        '<p class="roady-message">' .
        'There are no Requests configured for the ' .
        ($currentRequest->getGet()['appName'] ?? 'roady') .
        ' app.' .
        '</p>' .
        '<p class="roady-note">' .
        'To configure a new Request' .
        ' use <code class="roady-inline-code">' .
        '<a href="' .
            ONLINE_DOCUMENTATION_REQUEST . 
            'new-request" ' .
            'target="_blank" ' .
            'rel="noopener noreferrer"' . 
        '>' .
        'rig --new-request' . 
        '</a>' .
        '</code>'.
        '</p>'
        : $appRequestInfo
    )
);
