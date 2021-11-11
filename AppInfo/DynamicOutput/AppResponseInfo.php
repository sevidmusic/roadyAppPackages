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

const QUERY_STRING_SPRINT = "&appName=%s&responseName=%s";
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
    <h3>Component Info</h3>
    <nav>
        <a href="index.php?request=ResponseRequestInfo' . QUERY_STRING_SPRINT . '">Requests</a>
        <a href="index.php?request=ResponseOutputComponentInfo' . QUERY_STRING_SPRINT . '">OutputComponents</a>
        <a href="index.php?request=ResponseDynamicOutputComponentInfo' . QUERY_STRING_SPRINT . '">DynamicOutputComponents</a>
    </nav>
';

const REQUEST_LINK_SPRINT = "<a href=\"%s\">%s</a>";

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

/**
 * @var AppComponentsFactory $factory
 */
if($factory->getType() === AppComponentsFactory::class) {
    foreach (
        $factory->getStoredComponentRegistry()->getRegisteredComponents()
        as
        $registeredComponent
    ) {
        if($registeredComponent->getType() === Response::class) {
            /**
             * @var Response $registeredComponent
             */
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
                    ($currentRequest->getGet()['appName'] ?? 'roady'),
                    $registeredComponent->getName(),
                    ($currentRequest->getGet()['appName'] ?? 'roady'),
                    $registeredComponent->getName(),
                    ($currentRequest->getGet()['appName'] ?? 'roady'),
                    $registeredComponent->getName()
                )
            ); 
            array_push(
                $responseInfo, 
                '<h3>Responds to:</h3>',
                '<nav>'
            );
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
                    $responseInfo,
                    sprintf(
                        REQUEST_LINK_SPRINT,
                        $request->getUrl(),
                        $request->getUrl()
                    )
                );
            }
            array_push(
                $responseInfo,
                '</nav>'
            );
        }
    }
}

$appInfoOutput = sprintf(
    "<h1>Response configured for the %s app:</h1>%s",
    $currentRequest->getGet()['appName'] ?? 'roady',
    implode(PHP_EOL, $responseInfo)
);

echo '<div class="roady-app-output-container">' . (
    empty($responseInfo)
        ? '<p>There are no Responses configured for the ' .
           ($currentRequest->getGet()['appName'] ?? 'roady') .
           ' app</p>'
        : $appInfoOutput
) . '</div>';
