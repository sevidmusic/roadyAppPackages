<?php

namespace Apps\AppInfo\resources\config;

use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Factory\PrimaryFactory;
use roady\classes\component\Registry\Storage\StoredComponentRegistry;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\interfaces\component\Factory\Factory;

class CoreComponents
{

    private static Request|null $currentRequest = null;
    private static ComponentCrud|null $componentCrud = null;
    private static AppComponentsFactory|null $appsAppComponentsFactory = null;

    public static function currentRequest(): Request
    {
        self::$currentRequest = (
            self::$currentRequest ?? self::requestInstance()
        );
        return self::$currentRequest;
    }

    private static function requestInstance(): Request
    {
        return new Request(
            new Storable(
                'CurrentRequest',
                'AppInfoRequests',
                'CurrentRequests'
            ),
            new Switchable()
        );
    }

    public static function componentCrud(): ComponentCrud
    {
        self::$componentCrud = (
            self::$componentCrud ?? self::componentCrudInstance()
        );
        return self::$componentCrud;
    }

    private static function componentCrudInstance(): ComponentCrud
    {
        return new ComponentCrud(
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
    }

    public static function appsAppComponentsFactory(string $appName): AppComponentsFactory
    {
        self::$appsAppComponentsFactory = (
            self::$appsAppComponentsFactory 
            ?? 
            self::appComponentsFactoryInstance($appName)
        );
        return self::$appsAppComponentsFactory;
    }

    private static function appComponentsFactoryInstance(
        string $appName
    ): AppComponentsFactory
    {
        /** First attempt to read App's stored AppComponentsFactory. */
        $appsStoredAppComponentsFactory =  
            CoreComponents::componentCrud()->readByNameAndType(
                $appName,
                AppComponentsFactory::class,
                App::deriveAppLocationFromRequest(
                    CoreComponents::currentRequest()
                ),
                Factory::CONTAINER
            );
        if(
            $appsStoredAppComponentsFactory::class 
            === 
            AppComponentsFactory::class
        ) {
            /**
             * @var AppComponentsFactory $appsStoredAppComponentsFactory
             */
            return $appsStoredAppComponentsFactory;
        }
        /** 
         * If the App does not have an AppComponentsFactory in storage,
         * return a new AppComponentsFactory instance.
         */
        return new AppComponentsFactory(
            new PrimaryFactory(
                new App(
                    self::currentRequest(),
                    new Switchable()
                ),
            ),
            self::ComponentCrud(),
            new StoredComponentRegistry(
                new Storable('SCR', 'SCR', 'SCR'),
                self::ComponentCrud()
            )
        );
    }
}
