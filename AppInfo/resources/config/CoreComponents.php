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

/**
 * The CoreComponents class provides static methods that will either
 * return a new Component instance of a specific type, or a specific
 * Component from storage.
 *
 * Methods:
 *
 * public static function currentRequest(): Request
 * public static function componentCrud(): ComponentCrud
 * public static function appsAppComponentsFactory(string $appName): AppComponentsFactory
*/
class CoreComponents
{

    private static Request|null $currentRequest = null;
    private static ComponentCrud|null $componentCrud = null;
    private static AppComponentsFactory|null $appsAppComponentsFactory = null;

    /**
     * Return a new Request instance for the current request.
     *
     * @return Request A new Request instance for the current
     *                 request.
     */
    public static function currentRequest(): Request
    {
        self::$currentRequest = (
            self::$currentRequest ?? self::requestInstance()
        );
        return self::$currentRequest;
    }

    /**
     * Return a new ComponentCrud instance that can be used to
     * read stored Components from storage.
     *
     * @return ComponentCrud A new ComponentCrud instance.
     */
    public static function componentCrud(): ComponentCrud
    {
        self::$componentCrud = (
            self::$componentCrud ?? self::componentCrudInstance()
        );
        return self::$componentCrud;
    }

    /**
     * Return the specified App's AppComponentsFactory from storage,
     * or a new AppComponentsFactory instance if the specified App's
     * AppComponentsFactory does not exist in storage.
     *
     * @return AppComponentsFactory The specified App's
     *                              stored AppComponentsFactory,
     *                              or a new AppComponentsFactory
     *                              instance if the specified App's
     *                              AppComponentsFactory does not
     *                              exist in storage.
     */
    public static function appsAppComponentsFactory(string $appName): AppComponentsFactory
    {
        self::$appsAppComponentsFactory = (
            self::$appsAppComponentsFactory
            ??
            self::appComponentsFactoryInstance($appName)
        );
        return self::$appsAppComponentsFactory;
    }

    /**
     * Return a new Request instance for the current request.
     *
     * @return Request A new Request instance for the current
     *                 request.
     */
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

    /**
     * Return a new ComponentCrud instance that can be used to
     * read stored Components from storage.
     *
     * @return ComponentCrud A new ComponentCrud instance.
     */
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

    /**
     * Return the specified App's AppComponentsFactory from storage,
     * or a new AppComponentsFactory instance if the specified App's
     * AppComponentsFactory does not exist in storage.
     *
     * @return AppComponentsFactory The specified App's
     *                              stored AppComponentsFactory,
     *                              or a new AppComponentsFactory
     *                              instance if the specified App's
     *                              AppComponentsFactory does not
     *                              exist in storage.
     */
    private static function appComponentsFactoryInstance(
        string $appName
    ): AppComponentsFactory
    {
        $appsStoredAppComponentsFactory =
            CoreComponents::componentCrud()->readByNameAndType(
                $appName,
                AppComponentsFactory::class,
                App::deriveAppLocationFromRequest(
                    CoreComponents::currentRequest()
                ),
                Factory::CONTAINER
            );
       /**
        *
        * The ComponentCrud->readByNameAndType() method may
        * return a generic Component if the requested Component
        * doesn't exist in storage.
        *
        * As long as the AppComponentsFactory read from storage is
        * in fact a AppComponentsFactory, then it is safe to return
        * the $appsStoredAppComponentsFactory variable, otherwise
        * a new AppComponentsFactory instance must be returned.
        *
        * The following match() expression insures that an
        * AppComponentsFactory instance will still be returned
        * if the ComponentCrud->readByNameAndType() method returned
        * a generic Component, or other Component type.
        *
        * The following var doc is defined to prevent phpstan from
        * complaining that the return type is not correct, it is,
        * the match() expression won't allow anything but a
        * AppComponentsFactory instance to be returned.
        *
        * @var AppComponentsFactory $appsStoredAppComponentsFactory
        *
        */
        return match(
            $appsStoredAppComponentsFactory::class
            ===
            AppComponentsFactory::class
        ) {
            true => $appsStoredAppComponentsFactory,
            default =>
                new AppComponentsFactory(
                    new PrimaryFactory(
                        new App(
                            self::currentRequest(),
                            new Switchable()
                        ),
                    ),
                    self::ComponentCrud(),
                    new StoredComponentRegistry(
                        new Storable(
                            'StoredComponentRegistry',
                            'AppInfoRegistries',
                            'StoredComponentRegistries'
                        ),
                        self::ComponentCrud()
                    )
                ),
        };
    }
}
