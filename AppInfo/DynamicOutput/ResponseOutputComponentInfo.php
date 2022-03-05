<?php

use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\classes\component\Web\Routing\Response;
use roady\classes\component\Web\Routing\GlobalResponse;
use roady\classes\component\OutputComponent;

/** Vars and Constants */

const ONLINE_DOCUMENTATION_REQUEST = 'https://roady.tech/index.php?request=';
const OUTPUT_PREVIEW_SPRINT = '<div class="roady-output-preview">%s</div>';
const OUTPUT_CONTAINER_SPRINT = '
    <div class="roady-app-output-container">%s</div>
';
const RESPONSES_ASSIGNED_OUTPUT_COMPONENT_INFO_SPRINT = '
    <h2>
        OutputComponents assigned to the %s app\'s %s Response:
    </h2>
    <!-- Start OUTPUT_COMPONENT_INFO_SPRINT output -->
    %s
    <!-- End OUTPUT_COMPONENT_INFO_SPRINT output -->
';
const OUTPUT_COMPONENT_INFO_SPRINT = '
    <div class="roady-generic-container">
        <h3>%s</h3>
        <ul class="roady-ul-list">
            <li>Unique Id:</li>
            <li> %s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Type:</spanli
            <li> %s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Location:</spanli
            <li> %s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Container:</spanli
            <li> %s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Position:</spanli
            <li> %s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>State:</spanli
            <li> %s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Output:</spanli
            <li>
                <!-- Start OUTPUT_PREVIEW_SPRINT -->
                %s
                <!-- End OUTPUT_PREVIEW_SPRINT -->
            </li>
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

$requestInfo = [];
foreach($response->getOutputComponentStorageInfo() as $requestStorable) {
    /**
     * @var OutputComponent $request
     */
    $request = $componentCrud->read($requestStorable);
    if($request->getType() === OutputComponent::class) {
        array_push(
            $requestInfo,
            sprintf(
                OUTPUT_COMPONENT_INFO_SPRINT,
                $request->getName(),
                $request->getUniqueId(),
                $request->getType(),
                $request->getLocation(),
                $request->getContainer(),
                $request->getPosition(),
                (
                    $request->getState() === true
                    ? 'true'
                    : 'false'
                ),
                sprintf(
                    OUTPUT_PREVIEW_SPRINT,
                    $request->getOutput()
                ),
            ),
        );
    }
}


$appInfoOutput = sprintf(
    RESPONSES_ASSIGNED_OUTPUT_COMPONENT_INFO_SPRINT,
    $currentRequest->getGet()['appName'] ?? 'unknown',
    $currentRequest->getGet()['responseName'] ?? 'unknown',
    implode(PHP_EOL, $requestInfo)
);

printf(
    OUTPUT_CONTAINER_SPRINT,
    (
    empty($requestInfo)
    ? 
        '<p class="roady-message">' .
        'There are no OutputComponents assigned to the ' .
        ($currentRequest->getGet()['appName'] ?? 'roady') .
        ' App\'s ' .
        ($currentRequest->getGet()['responseName'] ?? 'unknown') .
        'Response' .
        '</p>' .
        '<p class="roady-note">' .
        'To assign an OutputComponent to a Response' .
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
        : $appInfoOutput
    )
);
