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
    <div>
    <nav>
        <a href="index.php?request=AppResponseInfo&appName=%s">Responses</a>
        <a href="index.php?request=AppGlobalResponseInfo&appName=%s">GlobalResponses</a>
        <a href="index.php?request=AppRequestInfo&appName=%s">Requests</a>
        <a href="index.php?request=AppOutputComponentInfo&appName=%s">OutputComponents</a>
        <a href="index.php?request=AppDynamicOutputComponentInfo&appName=%s">DynamicOutputComponents</a>
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

/**
 * @var Factory $factory
 */
if($factory->getType() === AppComponentsFactory::class) {
    /**
     * @var AppComponentsFactory $factory
     */
    foreach ($factory->getStoredComponentRegistry()->getRegisteredComponents() as $registeredComponent) {
        if($registeredComponent->getType() === Response::class) {
            echo sprintf(
                APP_INFO_SPRINT,
                $registeredComponent->getName(),
                $registeredComponent->getUniqueId(),
                $registeredComponent->getType(),
                $registeredComponent->getLocation(),
                $registeredComponent->getContainer(),
                $registeredComponent->getName(),
                $registeredComponent->getName(),
                $registeredComponent->getName(),
                $registeredComponent->getName(),
                $registeredComponent->getName()
            );
        }
    }
}
