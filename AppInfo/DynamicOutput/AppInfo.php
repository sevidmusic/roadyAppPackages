<?php

use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\interfaces\component\Factory\Factory;

/** Constants & Vars */

const OUTPUT_CONTAINER_SPRINT = '<div class="roady-app-output-container">%s</div>';
const REQUEST_LINK_SPRINT = "<a href=\"%s\">%s</a>";
const APP_INFO_SPRINT = '
    <h2>%s</h2>
    <p>Unique Id: %s</p>
    <p>Type: %s</p>
    <p>Location: %s</p>
    <p>Container: %s</p>
    <h3>Component Information</h3>
    <nav>
        <a href="index.php?request=AppResponseInfo&appName=%s">
            Responses
        </a>
        <a href="index.php?request=AppGlobalResponseInfo&appName=%s">
            GlobalResponses
        </a>
        <a href="index.php?request=AppRequestInfo&appName=%s">
            Requests
        </a>
        <a href="index.php?request=AppOutputComponentInfo&appName=%s">
            OutputComponents
        </a>
        <a href="index.php?request=AppDynamicOutputComponentInfo&appName=%s">
            DynamicOutputComponents
        </a>
    </nav>
    <div style="border-bottom: .3rem double purple; margin-top: 1rem; margin-bottom: 2rem;"></div>
';

$currentRequest = new Request(
    new Storable(
        'CurrentRequest',
        'AppInfoRequests',
        'CurrentRequests'
    ),
    new Switchable()
);

$parsedDomain = parse_url($currentRequest->getUrl(), PHP_URL_SCHEME) . 
    '://' .
    parse_url($currentRequest->getUrl(), PHP_URL_HOST) .
    ':' . parse_url($currentRequest->getUrl(), PHP_URL_PORT) . 
    '/';

$domain = sprintf(
    REQUEST_LINK_SPRINT,
    $parsedDomain,
    $parsedDomain
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

/** Logic */

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

printf(
    OUTPUT_CONTAINER_SPRINT,
    (
    empty($appInfo)
        ? '<h1>There are no Apps running ' . $domain . '.</h1>'
        : '<h1>The following Apps are running on ' . $domain . ':</h1>' . 
        implode(PHP_EOL, $appInfo)
    )
);

