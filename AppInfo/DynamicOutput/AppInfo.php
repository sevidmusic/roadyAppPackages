<?php

use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\interfaces\component\Factory\Factory;

$appName = 'AppInfo';
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

foreach (
        $componentCrud->readAll(App::deriveAppLocationFromRequest($currentRequest), Factory::CONTAINER)
        as
        $factory
) {
    /**
     * @var Factory $factory
     */
    if($factory->getType() === AppComponentsFactory::class) {
        /**
         * @var AppComponentsFactory $factory
         */
        echo '<div style="color: white; background: black; font-family: monospace; padding: 2rem; margin-bottom: 2rem;">' .
            '<div style="padding: 0.5rem; margin: 2rem; overflow: auto;">' .
            '<h1>' . $factory->getName() . '</h1>' .
            '</div>' .
            '<div style="border: 3px solid #b9ecff; border-radius: 2rem; padding: 0.5rem; margin: 2rem; overflow: auto;">' .
            '<p>Unique Id:</p>' .
            '<p>' . $factory->getUniqueId() . '</p>' .
            '</div>' .
            '<div style="border: 3px solid #b9ecff; border-radius: 2rem; padding: 0.5rem; margin: 2rem; overflow: auto;">' .
            '<p>Type:</p>' .
            '<p>' . $factory->getType() . '</p>' .
            '</div>' .
            '<div style="border: 3px solid #b9ecff; border-radius: 2rem; padding: 0.5rem; margin: 2rem; overflow: auto;">' .
            '<p>Location:</p>' .
            '<p>' . $factory->getLocation() . '</p>' .
            '</div>' .
            '<div style="border: 3px solid #b9ecff; border-radius: 2rem; padding: 0.5rem; margin: 2rem; overflow: auto;">' .
            '<p>Container:</p>' .
            '<p>' . $factory->getContainer() . '</p>' .
            '</div>' .
            '</div>';
    }
}
