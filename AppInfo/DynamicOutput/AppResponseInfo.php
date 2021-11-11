<?php

use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\interfaces\component\Factory\Factory;
use roady\interfaces\component\Component;
use roady\classes\component\Web\Routing\Response;

const RESPONSE_INFO_SPRINT = '
    <h2>%s</h2>
    <p>Unique Id: %s</p>
    <p>Type: %s</p>
    <p>Location: %s</p>
    <p>Container: %s</p>
    <p>Position: %s</p>
    <h3>Component Info</h3>
    <nav>
        <a href="index.php?request=ResponseRequestInfo&appName=%s&responseName=%s">Requests</a>
        <a href="index.php?request=ResponseOutputComponentInfo&appName=%s&responseName=%s">OutputComponents</a>
        <a href="index.php?request=ResponseDynamicOutputComponentInfo&appName=%s&responseName=%s">DynamicOutputComponents</a>
    </nav>
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
                '<div style="border-bottom: 3px solid purple;"></div><h3>Responds to:</h3><nav>'
            );
            foreach(
                $registeredComponent->getRequestStorageInfo() 
                as 
                $requestStorageInfo) 
            {
                $url = $componentCrud->read($requestStorageInfo)->getUrl();
                array_push(
                    $responseInfo, 
                    '<a href="' . $url . '">' .
                    $url .
                    '</a>'
                );
            }
            array_push($responseInfo, '</nav><div style="border-bottom: 0.3rem double limegreen; margin-top: 1rem; margin-bottom: 3rem;"></div>');
        }
    }
}

$appInfoOutput = '<h1>Response configured for the ' . 
    ($currentRequest->getGet()['appName'] ?? 'roady') . 
    ' app:</h1>' . 
    implode(PHP_EOL, $responseInfo);

echo '<div class="roady-app-output-container">' . (
    empty($responseInfo)
        ? '<p>There are no Responses configured for the ' .
           ($currentRequest->getGet()['appName'] ?? 'roady') .
           ' app</p>'
        : $appInfoOutput
) . '</div>';
