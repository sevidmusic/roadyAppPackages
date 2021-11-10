<?php

use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\interfaces\component\Factory\Factory;

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

$appInfo = [];

foreach (
        $componentCrud->readAll(
            App::deriveAppLocationFromRequest($currentRequest),
            Factory::CONTAINER
        )
        as
        $factory
) {
    /**
     * @var Factory $factory
     */
    if(
        $factory->getType() === AppComponentsFactory::class
        &&
        $factory->getApp()->getName() !== 'roady'
    ) {
        /**
         * @var AppComponentsFactory $factory
         */
        array_push(
            $appInfo,
            sprintf(
                APP_INFO_SPRINT,
                $factory->getApp()->getName(),
                $factory->getApp()->getUniqueId(),
                $factory->getApp()->getType(),
                $factory->getApp()->getLocation(),
                $factory->getApp()->getContainer(),
                $factory->getApp()->getName(),
                $factory->getApp()->getName(),
                $factory->getApp()->getName(),
                $factory->getApp()->getName(),
                $factory->getApp()->getName()
            )
        );
    }
}

echo (
    empty($appInfo)
        ? '<p>There are no Apps running on ' .
           $currentRequest->getUrl() .
           ' app</p>'
        : implode(PHP_EOL, $appInfo)
);
