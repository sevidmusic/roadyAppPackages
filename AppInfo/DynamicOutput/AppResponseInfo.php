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
            Note: The following urls are associated with the 
            Requests assigned to this Response.
        </p>
    </div>
    <nav>%s</nav>
';
const REQUEST_LINK_SPRINT = '<a href="%s">%s</a>';
const QUERY_STRING_SPRINT = 
    '&appName=%s&responseName=%s&responseUniqueId=%s&responseLocation=%s&responseContainer=%s';
const APPS_ASSIGNED_RESPONSE_INFO_SPRINT = '
    <h1>Responses configured by the %s app:</h1>
    <!-- Start RESPONSE_INFO_SPRINT output -->
    %s
    <!-- End RESPONSE_INFO_SPRINT output -->
';
const RESPONSE_INFO_SPRINT = '
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
        <a href="index.php?request=ResponseRequestInfo' . QUERY_STRING_SPRINT . '">Requests</a>
        <a href="index.php?request=ResponseOutputComponentInfo' . QUERY_STRING_SPRINT . '">OutputComponents</a>
        <a href="index.php?request=ResponseDynamicOutputComponentInfo' . QUERY_STRING_SPRINT . '">DynamicOutputComponents</a>
    </nav>
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

$generateRequestInfoStrings = function(Response $registeredComponent, ComponentCrud $componentCrud): array {
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
    APPS_ASSIGNED_RESPONSE_INFO_SPRINT,
    $currentRequest->getGet()['appName'] ?? 'roady',
    implode(PHP_EOL, $responseInfo)
);


printf(
    OUTPUT_CONTAINER_SPRINT,
    (
    empty($responseInfo)
        ? '<p>There are no Responses configured for the ' .
           ($currentRequest->getGet()['appName'] ?? 'roady') .
           ' app</p>'
        : $appInfoOutput
    )
);
