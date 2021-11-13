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
    <p>
        <span class="roady-name-value-name">
            Responds to:    
        </span>
    </p>
    <div class="roady-note-container">
        <p>
            Note: GlobalResponses will respond to all Requests,
            but may still be assigned specific Requests. The
            following urls are associated with the Requests 
            assigned to this GlobalResponse.
        </p>
    </div>
    <nav>%s</nav>
';
const REQUEST_LINK_SPRINT = '<a href="%s">%s</a>';
const QUERY_STRING_SPRINT = 
    '&appName=%s&responseName=%s&responseUniqueId=%s&responseLocation=%s&responseContainer=%s&global';
const APPS_ASSIGNED_GLOBAL_GLOBAL_RESPONSE_INFO_SPRINT = '
    <h1>GlobalResponses configured by the %s app:</h1>
    <!-- Start GLOBAL_RESPONSE_INFO_SPRINT -->
    %s
    <!-- End GLOBAL_RESPONSE_INFO_SPRINT -->
';
const GLOBAL_RESPONSE_INFO_SPRINT = '
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
        <span class="roady-name-value-name">Position</span>:
        <span class="roady-name-value-value"> %s</span>
    </p>
    <!-- Start Responds To: -->
    %s
    <!-- End Responds To: -->
    <p>
        <span class="roady-name-value-name">
            Assigned Components:
        </span>
    </p>
    <nav>
        <a href="index.php?request=ResponseRequestInfo' . 
        QUERY_STRING_SPRINT . '">
            Requests
        </a>
        <a href="index.php?request=ResponseOutputComponentInfo' . 
        QUERY_STRING_SPRINT . '">
            OutputComponents
        </a>
        <a href="index.php?request=ResponseDynamicOutputComponentInfo' . 
        QUERY_STRING_SPRINT . '">
            DynamicOutputComponents
        </a>
    </nav>
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
        ? '<p>There are no Responses configured for the ' .
           ($currentRequest->getGet()['appName'] ?? 'roady') .
           ' app</p>'
        : $appInfoOutput
    )
);
