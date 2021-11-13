<?php

use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\classes\component\Web\Routing\Response;
use roady\classes\component\DynamicOutputComponent;

/** Vars and Constants */

const OUTPUT_PREVIEW_SPRINT = '
    <div class="roady-output-preview">%s</div>';
const OUTPUT_CONTAINER_SPRINT = '
    <div class="roady-app-output-container">%s</div>
';
const RESPONSES_ASSIGNED_DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT = '
    <h1>
        DynamicOutputComponents assigned to the %s app\'s %s 
        Response:
    </h1>
    <!-- Start DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT -->
    %s
    <!-- End DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT -->
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
 * @var Response $response
 */
$response = $componentCrud->readByNameAndType(
    ($currentRequest->getGet()['responseName'] ?? 'unknown'),
    Response::class,
    ($currentRequest->getGet()['responseLocation'] ?? 'unknown'),
    ($currentRequest->getGet()['responseContainer'] ?? 'unknown'),
);

$dynamicOutputComponentInfo = [];
foreach(
    $response->getOutputComponentStorageInfo() 
    as 
    $requestStorable
) {
    /**
     * @var DynamicOutputComponent $request
     */
    $request = $componentCrud->read($requestStorable);
    if($request->getType() === DynamicOutputComponent::class) {
        array_push(
            $dynamicOutputComponentInfo,
            sprintf(
                DYNAMIC_OUTPUT_COMPONENT_INFO_SPRINT,
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
                $request->getDynamicFilePath(),
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
    ? '<p>
        There are no DynamicOutputComponents assigned to the ' .
        ($currentRequest->getGet()['appName'] ?? 'unknown') .
        ' app\'s ' .
        ($currentRequest->getGet()['responseName'] ?? 'unknown') .
        ' Response
       </p>'
    : $responseDynamicOutputComponentInfo
    )
);
