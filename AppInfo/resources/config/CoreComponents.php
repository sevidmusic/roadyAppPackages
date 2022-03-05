<?php

namespace Apps\AppInfo\resources\config;

use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Driver\Storage\StorageDriver;

class CoreComponents
{

    private static Request|null $currentRequest = null;
    private static ComponentCrud|null $componentCrud = null;

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
}
