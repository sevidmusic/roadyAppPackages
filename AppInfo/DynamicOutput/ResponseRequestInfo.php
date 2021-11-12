<?php

use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\classes\component\Web\Routing\Response;

/** Vars and Constants */

const REQUEST_LINK_SPRINT = '<a href="%s">%s</a>';
const OUTPUT_CONTAINER_SPRINT = '
    <div class="roady-app-output-container">%s</div>
';
const RESPONSES_ASSIGNED_REQUEST_INFO_SPRINT = '
    <h1>Requests assigned to the %s app\'s %s Response:</h1>
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
        <span class="roady-name-value-name">Type</span>:
        <span class="roady-name-value-value"> %s</span>
    </p>
    <p>
        <span class="roady-name-value-name">Location</span>:
        <span class="roady-name-value-value"> %s</span>
    </p>
    <p>
        <span class="roady-name-value-name">Container</span>:
        <span class="roady-name-value-value"> %s</span>
    </p>
    <p>
        <span class="roady-name-value-name">Url</span>:
        <span class="roady-name-value-value"> %s</span>
    </p>
    <div class="roady-content-separator"></div>
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

$requestInfo = [];
foreach($response->getRequestStorageInfo() as $requestStorable) {
    /**
     * @var Request $request
     */
    $request = $componentCrud->read($requestStorable);
    if($request->getType() === Request::class) {
        array_push(
            $requestInfo,
            sprintf(
                REQUEST_INFO_SPRINT,
                $request->getName(),
                $request->getUniqueId(),
                $request->getType(),
                $request->getLocation(),
                $request->getContainer(),
                sprintf(
                    REQUEST_LINK_SPRINT,
                    $request->getUrl(),
                    $request->getUrl(),
                ),
            ),
        );
    }
}


$appInfoOutput = sprintf(
    RESPONSES_ASSIGNED_REQUEST_INFO_SPRINT,
    $currentRequest->getGet()['appName'] ?? 'unknown',
    $currentRequest->getGet()['responseName'] ?? 'unknown',
    implode(PHP_EOL, $requestInfo)
);

printf(
    OUTPUT_CONTAINER_SPRINT,
    (
    empty($requestInfo)
        ? '<p>There are no Requests assigned to the ' .
           ($currentRequest->getGet()['appName'] ?? 'unknown') .
           ' app\'s ' .
           ($currentRequest->getGet()['responseName'] ?? 'unknown') .
           ' Response</p>'
        : $appInfoOutput
    )
);
