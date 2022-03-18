<?php

namespace Apps\AppInfo\resources\config;

use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Factory\PrimaryFactory;
use roady\classes\component\Registry\Storage\StoredComponentRegistry;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Web\Routing\Request;
use roady\classes\component\Web\Routing\Response;
use roady\classes\component\Web\Routing\GlobalResponse;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\interfaces\component\Factory\Factory;
use Apps\AppInfo\resources\config\ComponentInfo;

/**
 * The CoreComponents class provides static methods that will either
 * return a new Component instance of a specific type, a locally
 * cached instance of a specific type of Component, or a specific
 * Component from storage.
*/
class CoreComponents
{

    private static Request|null $currentRequest = null;
    private static ComponentCrud|null $componentCrud = null;
    private static AppComponentsFactory|null $appsAppComponentsFactory = null;

    /**
     * Return a Request instance for the current request.
     *
     * Note: This method may return a locally cached instance
     * of a Request.
     *
     * @return Request A Request instance for the current
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
     * Return a ComponentCrud instance that can be used to
     * read stored Components from storage.
     *
     * Note: This method may return a locally cached instance
     * of a ComponentCrud.
     *
     * @return ComponentCrud A ComponentCrud instance.
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
     * Note: This method may return a locally cached instance
     * of a AppComponentsFactory.
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
        * the match() expression won't allow anything but an
        * instance of an AppComponentsFactory to be returned.
        *
        * @var AppComponentsFactory $appsStoredAppComponentsFactory
        *
        */
        return match(
            $appsStoredAppComponentsFactory::class
            ===
            AppComponentsFactory::class
        ) {
            true =>
                $appsStoredAppComponentsFactory,
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

   /**
    * Return the specified Response from storage.
    *
    * If the Response does not exist, then a new Response instance
    * will be returned.
    *
    * @param string $responseName The name of the Response.
    *
    * @param class-string $responseType The Response's type.
    *
    * @return ResponseInterface The requested Response or GlobalResponse.
    *
    * Note: If the requested Response or GlobalResponse does not
    * exist, then a new Response instance named UnknownResponse
    * will be returned.
    */
    public static function getStoredResponseByNameAndType(
        string $responseName,
        string $responseType
    ): ResponseInterface
    {
        /** @var ResponseInterface $component */
        $component = self::componentCrud()->readByNameAndType(
            $responseName,
            $responseType,
            ComponentInfo::responseStorageLocation(),
            ComponentInfo::responseStorageContainer(),
        );
        return match($component->getType()) {
            Response::class, GlobalResponse::class => $component,
            default => self::newResponseInstance(),
        };
    }

    /**
     * Return a new Response instance.
     *
     * @return Response A new instance of a Response.
     */
    private static function newResponseInstance(): Response
    {
        return new Response(
            new Storable(
                'UnknownResponse',
                'UnknownResponses',
                'UnknownResponses'
            ),
            new Switchable()
        );
    }
}
