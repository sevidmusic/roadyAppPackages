<?php

use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\classes\component\Web\Routing\Response;
use roady\classes\component\Web\Routing\GlobalResponse;
use roady\classes\component\DynamicOutputComponent;

/** Vars and Constants */

const ONLINE_DOCUMENTATION_REQUEST = 'https://roady.tech/index.php?request=';
const OUTPUT_CONTAINER_SPRINT = '
    <div class="roady-app-output-container">%s</div>
';
const RESPONSES_ASSIGNED_DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT = '
    <h2>
        DynamicOutputComponents assigned to the %s app\'s %s 
        Response:
    </h2>
    <!-- Start DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT -->
    %s
    <!-- End DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT -->
';
const DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT = '
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
            <li>Position:</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>State:</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>DynamicOutput file:</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Output:</li>
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
 * @var Response $response
 */
$response = $componentCrud->readByNameAndType(
    ($currentRequest->getGet()['responseName'] ?? 'unknown'),
    (
        isset($currentRequest->getGet()['global'])
        ? GlobalResponse::class 
        : Response::class
    ),
    ($currentRequest->getGet()['responseLocation'] ?? 'unknown'),
    ($currentRequest->getGet()['responseContainer'] ?? 'unknown'),
);

$dynamicOutputComponentInfo = [];
foreach(
    $response->getOutputComponentStorageInfo() 
    as 
    $dynamicOutputComponentStorable
) {
    /**
     * @var DynamicOutputComponent $dynamicOutputComponent
     */
    $dynamicOutputComponent = $componentCrud->read($dynamicOutputComponentStorable);
    if($dynamicOutputComponent->getType() === DynamicOutputComponent::class) {
        array_push(
            $dynamicOutputComponentInfo,
            sprintf(
                DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT,
                $dynamicOutputComponent->getName(),
                $dynamicOutputComponent->getUniqueId(),
                $dynamicOutputComponent->getType(),
                $dynamicOutputComponent->getLocation(),
                $dynamicOutputComponent->getContainer(),
                $dynamicOutputComponent->getPosition(),
                (
                    $dynamicOutputComponent->getState() === true
                    ? 'true'
                    : 'false'
                ),
                $dynamicOutputComponent->getDynamicFilePath(),
                (
                    ($currentRequest->getGet()['appName']  ?? '')
                    ===
                    'AppInfo'
                    ? '<span class="roady-error-message">' . 
                    'The App Info App\'s DynamicOutput cannot be previewed.' .
                    '</span>'
                    : $dynamicOutputComponent->getOutput()
                )
            ),
        );
    }
}


$responseDynamicOutputComponentInfo = sprintf(
    RESPONSES_ASSIGNED_DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT,
    $currentRequest->getGet()['appName'] ?? 'unknown',
    $currentRequest->getGet()['responseName'] ?? 'unknown',
    implode(PHP_EOL, $dynamicOutputComponentInfo)
);

printf(
    OUTPUT_CONTAINER_SPRINT,
    (
    empty($dynamicOutputComponentInfo)
    ? 
        '<p class="roady-message">' .
        'There are no DynamicOutputComponents assigned to the ' .
        ($currentRequest->getGet()['appName'] ?? 'roady') .
        ' App\'s ' .
        ($currentRequest->getGet()['responseName'] ?? 'unknown') .
        'Response' .
        '</p>' .
        '<p class="roady-note">' .
        'To assign a DynamicOutputComponent to a Response' .
        ' use <code class="roady-inline-code">' .
        '<a href="' .
            ONLINE_DOCUMENTATION_REQUEST . 
            'assign-to-response" ' .
            'target="_blank" ' .
            'rel="noopener noreferrer"' . 
        '>' .
        'rig --assign-to-response' . 
        '</a>' .
        '</code>'.
        '</p>'
        : $responseDynamicOutputComponentInfo
    )
);
