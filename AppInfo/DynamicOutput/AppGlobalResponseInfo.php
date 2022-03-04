<?php

use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\interfaces\component\Factory\Factory;
use roady\classes\component\Web\Routing\GlobalResponse;

/** Vars and Constants */

const OUTPUT_CONTAINER_SPRINT = '
    <div class="roady-app-output-container">%s</div>
';
const RESPONDS_TO_SPRINT='
            <li>Responds to:</li>
            <li class="roady-note">
                Note: GlobalResponses will respond to all Requests,
                but may still be assigned specific Requests. The
                following urls are associated with the Requests 
                assigned to this GlobalResponse.
            </li>
            <!-- Start REQUEST_LINK_SPRINT -->
            %s
            <!-- End REQUEST_LINK_SPRINT -->
';
const REQUEST_LINK_SPRINT = '<li><a href="%s">%s</a></li>';
const QUERY_STRING_SPRINT = 
    '&appName=%s&responseName=%s&responseUniqueId=%s&responseLocation=%s&responseContainer=%s&global';
const APPS_ASSIGNED_GLOBAL_GLOBAL_RESPONSE_INFO_SPRINT = '
    <h2>GlobalResponses configured by the %s app:</h2>
    %s
';
const GLOBAL_RESPONSE_INFO_SPRINT = '
    <div class="roady-generic-container">
        <h3>%s</h3>
        <ul class="roady-ul-list">
            <li>Unique Id:</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Type</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Location</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Container</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Position</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <!-- start RESPONDS_TO_SPRINT -->
            %s
            <!-- end RESPONDS_TO_SPRINT -->
        </ul>
        <ul class="roady-ul-list">
            <li>Assigned Components:</li>
            <li>
                <a href="index.php?request=ResponseRequestInfo' . 
                QUERY_STRING_SPRINT . '">Requests</a>
            </li>
            <li>
                <a href="index.php?request=ResponseOutputComponentInfo' . 
                QUERY_STRING_SPRINT . '">OutputComponents</a>
            </li>
            <li>
                <a href="index.php?' . 
                'request=ResponseDynamicOutputComponentInfo' . 
                QUERY_STRING_SPRINT . '">DynamicOutputComponents</a>
            </li>
        </ul>
    </div>
';

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

$globalResponseRequestUrls = [];

$globalResponseInfo = [];

/** Functions */

$generateRequestInfoStrings = 
function (
    GlobalResponse $registeredComponent, 
    ComponentCrud $componentCrud
): array {
    $globalResponseRequestInfo = [];
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
            $globalResponseRequestInfo,
            sprintf(
                REQUEST_LINK_SPRINT,
                $request->getUrl(),
                $request->getUrl()
            )
        );
    }
    return $globalResponseRequestInfo;
};

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
         * @var GlobalResponse $registeredComponent
         */
        if($registeredComponent->getType() === GlobalResponse::class) {
            array_push(
                $globalResponseInfo,
                sprintf(
                    GLOBAL_RESPONSE_INFO_SPRINT,
                    $registeredComponent->getName(),
                    $registeredComponent->getUniqueId(),
                    $registeredComponent->getType(),
                    $registeredComponent->getLocation(),
                    $registeredComponent->getContainer(),
                    $registeredComponent->getPosition(),
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

$appInfoOutput = sprintf(
    APPS_ASSIGNED_GLOBAL_GLOBAL_RESPONSE_INFO_SPRINT,
    $currentRequest->getGet()['appName'] ?? 'roady',
    implode(PHP_EOL, $globalResponseInfo)
);

printf(
    OUTPUT_CONTAINER_SPRINT,
    (
        empty($globalResponseInfo) 
        ? 
        '<p class="roady-message">' .
        'There are no GlobalResponses configured for the ' .
        ($currentRequest->getGet()['appName'] ?? 'roady') .
        ' app.' .
        '</p>' .
        '<p class="roady-note">' .
        'To configure a new GlobalResponse' .
        ' use <code class="roady-inline-code">' .
        '<a href="' .
            ONLINE_DOCUMENTATION_REQUEST . 
            'new-global-response" ' .
            'target="_blank" ' .
            'rel="noopener noreferrer"' . 
        '>' .
        'rig --new-global-response --for-app --name' .
        '</a>' .
        '</code> or <code class="roady-inline-code">'.
        '<a href="' .
            ONLINE_DOCUMENTATION_REQUEST . 
            'configure-app-output" ' .
            'target="_blank" ' .
            'rel="noopener noreferrer"' . 
        '>' .
        'rig --configure-app-output --for-app --name --output' .
        ' --global</a></code>' .
        '</p>'
        : 
        $appInfoOutput
    )
);
