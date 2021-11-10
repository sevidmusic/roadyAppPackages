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

const APP_INFO_SPRINT = '
<div class="roady-app-output-container">
    <h1>%s</h1>
    <p>Unique Id:</p>
    <p>%s</p>
    <p>Type:</p>
    <p>%s</p>
    <p>Location:</p>
    <p>%s</p>
    <p>Container:</p>
    <p>%s</p>
    <p>Position</p>
    <p>%s</p>
    <div>
    <nav>
        <a href="index.php?request=ResponseRequestInfo&appName=%s&responseName=%s">Requests</a>
        <a href="index.php?request=ResponseOutputComponentInfo&appName=%s&responseName=%s">OutputComponents</a>
        <a href="index.php?request=ResponseDynamicOutputComponentInfo&appName=%s&responseName=%s">DynamicOutputComponents</a>
    </nav>
</div>
<div style="margin-top: 2rem; border-bottom: .3rem double black;"></div>
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

$factory = $componentCrud->readByNameAndType(
    ($currentRequest->getGet()['appName'] ?? 'roady'),
    AppComponentsFactory::class,
    App::deriveAppLocationFromRequest($currentRequest),
    Factory::CONTAINER
);

$responseInfo = [];

/**
 * @var Factory $factory
 */
if($factory->getType() === AppComponentsFactory::class) {
    /**
     * @var AppComponentsFactory $factory
     */
    foreach ($factory->getStoredComponentRegistry()->getRegisteredComponents() as $registeredComponent) {
        if($registeredComponent->getType() === Response::class) {
            /**
             * @var Response $registeredComponent
             */
            array_push(
                $responseInfo,
                sprintf(
                    APP_INFO_SPRINT,
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
        }
    }
}

echo (
    empty($responseInfo)
        ? '<p>There are no Responses configured for the ' .
           ($currentRequest->getGet()['appName'] ?? 'roady') .
           ' app</p>'
        : implode(PHP_EOL, $responseInfo)
);