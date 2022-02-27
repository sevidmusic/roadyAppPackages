<?php

use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\interfaces\component\Factory\Factory;
use roady\classes\component\OutputComponent;

/** Vars and Constants */

const OUTPUT_COMPONENT_OUTPUT_PREVIEW_SPRINT = 
    '<pre class="roady-multi-line-code-container">' .
    '<code class="roady-multi-line-code">%s</code>' . 
    '</pre>';

const OUTPUT_CONTAINER_SPRINT = '
    <div class="roady-app-output-container">%s</div>';

const APPS_ASSIGNED_OUTPUT_COMPONENT_INFO_SPRINT = '
    <h1>OutputComponents configured by the %s app:</h1>
    %s';

const OUTPUT_COMPONENT_INFO_SPRINT = '
    <div class="roady-generic-container">
        <h2>%s</h2>
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
            <li>Position:</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>State:</li>
            <li>%s</li>
        </ul>
        <h3>Output</h3>
        <pre class="roady-multi-line-code-container>
            <code class="roady-inline-code">%s</code>
        </pre> 
    </div>';

const ONLINE_DOCUMENTATION_REQUEST = 'https://roady.tech/index.php?request=';

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

$outputComponentInfo = [];

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
        if(
            $registeredComponent->getType() 
            === 
            OutputComponent::class
        ) {
            array_push(
                $outputComponentInfo,
                sprintf(
                    OUTPUT_COMPONENT_INFO_SPRINT,
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
                        OUTPUT_COMPONENT_OUTPUT_PREVIEW_SPRINT,
                        $registeredComponent->getOutput()
                    ),
                ),
            );
        }
    }
}

$appOutputComponentInfo = sprintf(
    APPS_ASSIGNED_OUTPUT_COMPONENT_INFO_SPRINT,
    $currentRequest->getGet()['appName'] ?? 'roady',
    implode(PHP_EOL, $outputComponentInfo)
);


printf(
    OUTPUT_CONTAINER_SPRINT,
    (
    empty($outputComponentInfo)
    ? 
        '<p class="roady-message">' .
        'There are no OutputComponents configured for the ' .
        ($currentRequest->getGet()['appName'] ?? 'roady') .
        ' app.' .
        '</p>' .
        '<p class="roady-note">' .
        'To configure a new OutputComponent' .
        ' use <code class="roady-inline-code">' .
        '<a href="' .
            ONLINE_DOCUMENTATION_REQUEST . 
            'new-global-response" ' .
            'target="_blank" ' .
            'rel="noopener noreferrer"' . 
        '>' .
        'rig --new-output-component --for-app --name --output' .
        '</a>' .
        '</code> or <code class="roady-inline-code">'.
        '<a href="' .
            ONLINE_DOCUMENTATION_REQUEST . 
            'configure-app-output" ' .
            'target="_blank" ' .
            'rel="noopener noreferrer"' . 
        '>' .
        'rig --configure-app-output --for-app --name --output' .
        '</a></code>' .
        '</p>'
        : $appOutputComponentInfo
    )
);
