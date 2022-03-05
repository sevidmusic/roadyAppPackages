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

/** Vars and Constants */

const ONLINE_DOCUMENTATION_REQUEST = 'https://roady.tech/index.php?request=';
const OUTPUT_CONTAINER_SPRINT = '
    <div class="roady-app-output-container">%s</div>
';
const RESPONDS_TO_SPRINT='
    <ul class="roady-ul-list">
        <li>Responds to:</li>
        <li class="roady-note">
            Note: The following urls are associated with the 
            Requests assigned to this Response.
        </li>
        <li>
        <!-- Start REQUEST_LINK_SPRINT output -->
            %s
        <!-- End REQUEST_LINK_SPRINT output -->
        </li>
    </ul>
';
const REQUEST_LINK_SPRINT = '<li><a href="%s">%s</a></li>';
const QUERY_STRING_SPRINT = 
    '&appName=%s&responseName=%s&responseUniqueId=%s&responseLocation=%s&responseContainer=%s';
const APPS_ASSIGNED_RESPONSE_INFO_SPRINT = '
    <h2>Responses configured by the %s app:</h2>
    <!-- Start RESPONSE_INFO_SPRINT output -->
    %s
    <!-- End RESPONSE_INFO_SPRINT output -->
';
const RESPONSE_INFO_SPRINT = '
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
        <!-- Start Responds To: -->
        %s
        <!-- End Responds To: -->
        <ul class="roady-ul-list">
            <li>Assigned Components:</li>
            <li><a href="index.php?request=ResponseRequestInfo' . 
                QUERY_STRING_SPRINT . '">Requests</a></li>
            <li><a href="index.php?request=ResponseOutputComponentInfo' . 
                QUERY_STRING_SPRINT . '">OutputComponents</a></li>
            <li><a href="index.php?request=ResponseDynamicOutputComponentInfo' . 
                QUERY_STRING_SPRINT . '">DynamicOutputComponents</a></li>
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

$responseRequestUrls = [];

$responseInfo = [];

/** Functions */

$generateRequestInfoStrings = 
function(
    Response $registeredComponent, 
    ComponentCrud $componentCrud
): array {
    $responseRequestInfo = [];
    foreach(
        $registeredComponent->getRequestStorageInfo()
        as
        $requestStorageInfo
    )
    {
        /**
         * @var Request $request
         */
        $request = $componentCrud->read($requestStorageInfo);
        array_push(
            $responseRequestInfo,
            sprintf(
                REQUEST_LINK_SPRINT,
                $request->getUrl(),
                $request->getUrl()
            )
        );
    }
    return $responseRequestInfo;
};

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
         * @var Response $registeredComponent
         */
        if($registeredComponent->getType() === Response::class) {
            array_push(
                $responseInfo,
                sprintf(
                    RESPONSE_INFO_SPRINT,
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
                    sprintf(
                        RESPONDS_TO_SPRINT,
                        implode(
                            PHP_EOL,
                            $generateRequestInfoStrings(
                                $registeredComponent,
                                $componentCrud
                            )
                        )
                    ),
                    ($currentRequest->getGet()['appName'] ?? 'roady'),
                    $registeredComponent->getName(),
                    $registeredComponent->getUniqueId(),
                    $registeredComponent->getLocation(),
                    $registeredComponent->getContainer(),
                    ($currentRequest->getGet()['appName'] ?? 'roady'),
                    $registeredComponent->getName(),
                    $registeredComponent->getUniqueId(),
                    $registeredComponent->getLocation(),
                    $registeredComponent->getContainer(),
                    ($currentRequest->getGet()['appName'] ?? 'roady'),
                    $registeredComponent->getName(),
                    $registeredComponent->getUniqueId(),
                    $registeredComponent->getLocation(),
                    $registeredComponent->getContainer(),
                ),
            );
        }
    }
}

$appResponseInfo = sprintf(
    APPS_ASSIGNED_RESPONSE_INFO_SPRINT,
    $currentRequest->getGet()['appName'] ?? 'roady',
    implode(PHP_EOL, $responseInfo)
);

printf(
    OUTPUT_CONTAINER_SPRINT,
    (
    empty($appResponseInfo)
    ? 
        '<p class="roady-message">' .
        'There are no Responses configured for the ' .
        ($currentRequest->getGet()['appName'] ?? 'roady') .
        ' app.' .
        '</p>' .
        '<p class="roady-note">' .
        'To configure a new Response' .
        ' use <code class="roady-inline-code">' .
        '<a href="' .
            ONLINE_DOCUMENTATION_REQUEST . 
            'new-response" ' .
            'target="_blank" ' .
            'rel="noopener noreferrer"' . 
        '>' .
        'rig --new-response' . 
        '</a>' .
        '</code>'.
        '</p>'
        : $appResponseInfo
    )
);
