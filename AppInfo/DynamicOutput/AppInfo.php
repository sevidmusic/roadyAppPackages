<?php

use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\Web\App;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\component\Driver\Storage\StorageDriver;
use roady\interfaces\component\Factory\Factory;

const OUTPUT_CONTAINER_SPRINT = '
    <div class="roady-app-output-container">%s</div>
';
const REQUEST_LINK_SPRINT = "<a href=\"%s\">%s</a>";
const APP_INFO_SPRINT = '
    <!-- App name -->
    <div class="roady-generic-container">
        <h3>%s</h3>
        <ul class="roady-ul-list">
            <li>Unique Id:</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Type</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Location</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Container</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>State</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <li>Configured Components:</li>
            <li>
                <a href="index.php?request=AppResponseInfo&appName=%s">
                    Responses
                </a>
            </li>
            <li>
                <a href="index.php?request=AppGlobalResponseInfo&appName=%s">
                    GlobalResponses
                </a>
            </li>
            <li>
                <a href="index.php?request=AppRequestInfo&appName=%s">
                    Requests
                </a>
            </li>
            <li>
                <a href="index.php?request=AppOutputComponentInfo&appName=%s">
                    OutputComponents
                </a>
            </li>
            <li>
                <a href="index.php?request=AppDynamicOutputComponentInfo&appName=%s">
                    DynamicOutputComponents
                </a>
            </li>
        </ul>
    </div>
';

$currentRequest = new Request(
    new Storable(
        'CurrentRequest',
        'AppInfoRequests',
        'CurrentRequests'
    ),
    new Switchable()
);

$parsedDomain = parse_url(
        $currentRequest->getUrl(), PHP_URL_SCHEME
    ) .
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
                ($factory->getApp()->getState() ? 'true' : 'false'),
                $factory->getApp()->getName(),
                $factory->getApp()->getName(),
                $factory->getApp()->getName(),
                $factory->getApp()->getName(),
                $factory->getApp()->getName(),
            )
        );
    }
}

printf(
    OUTPUT_CONTAINER_SPRINT,
    (
    empty($appInfo)
    ? '<p class="roady-error-message">Unable to determine which ' .
        'Apps are running on ' . $domain . '</p>' . PHP_EOL
    : '<h2>The following Apps are running on ' .
        $domain . ':</h2>' . PHP_EOL . implode(PHP_EOL, $appInfo)
    )
);

