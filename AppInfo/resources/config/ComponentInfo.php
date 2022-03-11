<?php

namespace Apps\AppInfo\resources\config;

use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\Sprints;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\DynamicOutputComponent;
use roady\classes\component\OutputComponent;
use roady\classes\component\Web\Routing\GlobalResponse;
use roady\classes\component\Web\Routing\Request;
use roady\classes\component\Web\Routing\Response;
use roady\classes\component\Web\App;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\interfaces\component\Component;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;

/**
 * The ComponentInfo class provides static methods that return
 * html formatted overviews of either an App's configured Components,
 * or a Response or GlobalResponse's assigned Components.
 *
 * Methods:
 *
 * public static function htmlOverviewOfAppsConfiguredComponents(
 *     string $appName,
 *     string $componentType
 * ): string
 *
 * public static function htmlOverviewOfResponsesAssignedComponents(
 *     string $responseName,
 *     string $componentType
 * ): string
 *
 * public static function noConfiguredComponentsMessage(
 *     string $appOrResponseName,
 *     string $componentType,
 *     bool $responseComponentInfo = false
 * ): string
 *
 * public static function requestedAppName(): string
 *
 * public static function requestedResponseName(): string
 *
 */
class ComponentInfo
{
    /**
     * Return an html formatted overview of the specified App's
     * configured Components. Only the Components whose type
     * matches the specified type will be included in the
     * overview.
     *
     * @param string $appName The name of the App whose Components
     *                        should be included in the overview.
     *
     * @param class-string $componentType The type of Component to
     *                                    include in the overview.
     *
     * @return string An html formatted overview of the specified
     *                App's configured Components.
     */
    public static function htmlOverviewOfAppsConfiguredComponents(
        string $appName,
        string $componentType
    ): string
    {
        $generatedHtmlOverviewOfAppsConfiguredComponents =
            self::arrayOfHtmlFormattedComponentInfo(
                $appName,
                $componentType
            );
        return match(
            empty($generatedHtmlOverviewOfAppsConfiguredComponents)
        ) {
            true => ComponentInfo::noConfiguredComponentsMessage(
                $appName,
                $componentType
            ),
            default =>
                self::configuredComponentsHeader(
                    $appName,
                    $componentType
                ) .
                implode(
                    PHP_EOL,
                    $generatedHtmlOverviewOfAppsConfiguredComponents
                )
        };
    }

    /**
     * Return an html formatted overview of the specified Response's
     * configured Components. Only the Components whose type matches
     * the specified type will be included in the overview.
     *
     * @param string $responseName The name of the Response whose
     *                             Components should be included
     *                             in the overview.
     *
     * @param class-string $componentType The type of Component to
     *                                    include in the overview.
     *
     * @return string An html formatted overview of the specified
     *                Response's configured Components.
     */
    public static function htmlOverviewOfResponsesAssignedComponents(
        string $responseName,
        string $componentType
    ): string
    {
        return
            self::configuredComponentsHeader(
                $responseName,
                $componentType,
                true
            ) .
            match($componentType) {
                OutputComponent::class, DynamicOutputComponent::class
                    => self::htmlOverviewOfResponsesConfiguredOutputComponents(
                        $responseName,
                        $componentType
                    ),
                Request::class
                    => self::htmlOverviewOfResponsesConfiguredRequests(
                        $responseName,
                        $componentType
                    ),
            default => '',
        };
    }

    /**
     * Return an html formatted error message to indicate that there
     * are no Components of the specified type configured by the
     * specified App, or assigned to the specified Response.
     *
     * @param string $appOrResponseName The name of the App or
     *                                  Response.
     *
     * @param class-string $componentType The type of Component that
     *                                    was not found.
     *
     * @param bool $responseComponentInfo Set to true if error
     *                                    was for a Response, set
     *                                    to false if error was
     *                                    for an App.
     *
     * @return string An error message indicating that there are
     *                no Components of the specified type configured
     *                by the specified App, or assigned to the
     *                specified Response.
     */
    public static function noConfiguredComponentsMessage(
        string $appOrResponseName,
        string $componentType,
        bool $responseComponentInfo = false
    ): string
    {
        return '
        <p class="roady-message">
            There are no ' . self::getClassName($componentType, true)
            . ' configured for the ' .
            (
                $responseComponentInfo
                ? $appOrResponseName . ' ' .
                self::getClassName(self::requestedResponseType())
                : $appOrResponseName . ' app'
            ) .
        '.</p>
        <p class="roady-note">
            Hint:
            <a href="https://roady.tech/index.php?request=rig">
                rig
            </a>
            can be used to configure various types of Components for
            an App.
        </a>
        ';
    }

    /**
     * Return the name of the requested App, i.e., the value
     * of $_GET['appName'].
     *
     * @return string The requested App's name.
     */
    public static function requestedAppName(): string
    {
        return CoreComponents::currentRequest()->getGet()['appName'];
    }

    /**
     * Return the name of the requested Response, i.e., the value
     * of $_GET['responseName'].
     *
     * @return string The requested Response's name.
     */
    public static function requestedResponseName(): string
    {
        return CoreComponents::currentRequest()
               ->getGet()['responseName'];
    }

    /**
     * Returns an html header for the configured Component overviews,
     * The html h2 header's content will follow the following format:
     *
     * <h2>
     *     $componentType's configured by the
     *     $appOrResponseName {App|Response|GlobalResponse}
     * </h2>
     *
     * @param string $appOrResponseName The name of the App
     *                                  or Response.
     *
     * @param class-string $componentType The type of Component.
     *
     * @param bool $response Set to true if header is for a Response
     *                       overview.
     *
     * @return string A html header for configured Component
     *                overviews.
     */
    private static function configuredComponentsHeader(
        string $appOrResponseName,
        string $componentType,
        bool $response = false
    ): string
    {
        return '<h2>' .
            self::getClassName($componentType, true) .
            ' configured by the ' . $appOrResponseName . ' ' .
            (
                $response
                ? self::getClassName(self::requestedResponseType())
                : 'App'
            ) .
        '</h2>';
    }

    /**
     * Return the requested Response's type.
     *
     * If $_GET['global'] is set, then GlobalResponse::class will
     * be returned, otherwise Response::class will be returned.
     *
     * @return class-string The requested Response's type.
     */
    private static function requestedResponseType(): string
    {
        return (
            isset(CoreComponents::currentRequest()->getGet()['global'])
            ? GlobalResponse::class
            : Response::class
        );
    }

    /**
     * Return the name of the storage location where the App's
     * Responses are expected to be located.
     *
     * @return string The name of the storage location where the
     *                App's Response's are expected to be located.
     */
    private static function responseStorageLocation(): string
    {
        return App::deriveAppLocationFromRequest(
            CoreComponents::currentRequest()
        );
    }

    /**
     * Return the name of the storage container where the App's
     * Responses are expected to be located.
     *
     * @return string The name of the storage container where the
     *                App's Response's are expected to be located.
     */
    private static function responseStorageContainer(): string
    {
        return ResponseInterface::RESPONSE_CONTAINER;
    }

    /**
     * Return the short class name of the specified class,
     * excluding the namespace.
     *
     * @param class-string $class The class whose name should be
     *                            returned.
     *
     * @param bool $plural Set to true to pluralize the class name.
     *
     * @return string The classes name, excluding the class's
     *                namespace.
     */
    private static function getClassName(
        string $class,
        bool $plural = false
    ): string
    {
        $reflection = new \ReflectionClass($class);
        return $reflection->getShortName() . ($plural ? 's' : '');
    }

    /**
     * Returns an array of html formatted strings that provide an
     * overview of each of the specified App's configured Components
     * whose type matches the specified $componentType.
     *
     * Note: The html formatted overviews of each Components info
     *       are generated by the ComponentInfo::componentInfoHtml()
     *       method.
     *
     * @param string $appName The name of the App the Component's
     *                        were configured by.
     *
     * @param class-string $componentType The type of Component to
     *                                    include in the overview.
     *
     * @return array<int, string> An array of html formatted strings
     *                            that provide an overview of each
     *                            of the specified App's configured
     *                            Components whose type matches the
     *                            specifed $componentType.
     */
    private static function arrayOfHtmlFormattedComponentInfo(
        string $appName,
        string $componentType
    ): array
    {
        $htmlOverviewOfAppsConfiguredComponents = [];
        foreach (
            CoreComponents::appsAppComponentsFactory($appName)
                ->getStoredComponentRegistry()
                ->getRegisteredComponents()
            as
            $registeredComponent
        ) {
            if($registeredComponent::class === $componentType) {
                array_push(
                    $htmlOverviewOfAppsConfiguredComponents,
                    self::componentInfoHtml($registeredComponent)
                );
            }
        }
        return $htmlOverviewOfAppsConfiguredComponents;
    }

    /**
     * Return a html formatted overview of the specified Component's
     * info.
     *
     * @param Component $component The Component whose info should
     *                             be included in the overview.
     *
     * @return string An html formatted overview of the specified
     *                Component's info.
     */
    private static function componentInfoHtml(
        Component $component
    ): string {
        switch($component->getType() ) {
            case OutputComponent::class:
                /**
                 * @var OutputComponent $component
                 */
                return self::outputComponentInfo($component);
            case DynamicOutputComponent::class:
                /**
                 * @var DynamicOutputComponent $component
                 */
                return self::dynamicOutputComponentInfo($component);
            case GlobalResponse::class:
                /**
                 * @var GlobalResponse $component
                 */
                return self::responseComponentInfo($component);
            case Response::class:
                /**
                 * @var Response $component
                 */
                return self::responseComponentInfo($component);
            case Request::class:
                /**
                 * @var Request $component
                 */
                return self::requestComponentInfo($component);
            default: return '';
        }
    }


    /**
     * Return an html formatted overview of the specified
     * OutputComponent's info.
     *
     * @param OutputComponent $component The OutputComponent.
     *
     * @return string An html formatted overview of the
     *                specified OutputComponent's info.
     */
     private static function outputComponentInfo(
         OutputComponent $component
     ): string
    {
        return sprintf(
            Sprints::outputComponentInfoSprint(),
            $component->getName(),
            $component->getUniqueId(),
            $component->getType(),
            $component->getLocation(),
            $component->getContainer(),
            $component->getPosition(),
            (
                $component->getState()
                ? 'true'
                : 'false'
            ),
            $component->getOutput()
        );
    }

    /**
     * Return an html formatted overview of the specified
     * DynamicOutputComponent's info.
     *
     * @param DynamicOutputComponent $component The DynamicOutputComponent.
     *
     * @return string An html formatted overview of the
     *                specified DynamicOutputComponent's info.
     */
    private static function dynamicOutputComponentInfo(
        DynamicOutputComponent $component
    ): string
    {
        return sprintf(
            Sprints::dynamicOutputComponentInfoSprint(),
            $component->getName(),
            $component->getUniqueId(),
            $component->getType(),
            $component->getLocation(),
            $component->getContainer(),
            $component->getPosition(),
            (
                $component->getState()
                ? 'true'
                : 'false'
            ),
            $component->getDynamicFilePath(),
            (
                self::requestedAppName() === 'AppInfo'
                ? '<span class="roady-error-message">' .
                'The App Info App\'s DynamicOutput ' .
                'cannot be previewed.</span>'
                : $component->getOutput()
            )
        );
    }

    /**
     * Return an html formatted overview of the specified
     * Response's info.
     *
     * @param ResponseInterface $response The Response.
     *
     * @return string An html formatted overview of the
     *                specified Response's info.
     */
    private static function responseComponentInfo(
        ResponseInterface $response
    ): string
    {
        return sprintf(
            Sprints::responseInfoSprint(
                ($response->getType() === GlobalResponse::class)
            ),
            $response->getName(),
            $response->getUniqueId(),
            $response->getType(),
            $response->getLocation(),
            $response->getContainer(),
            $response->getPosition(),
            match($response->getType()) {
                GlobalResponse::class =>
                    '<li>Responds To:</li><li>All Requests</li>',
                default => sprintf(
                    Sprints::respondsToSprint(),
                    implode(
                        PHP_EOL,
                        self::assignedRequestLinks(
                            $response,
                            CoreComponents::ComponentCrud()
                        )
                    )
                ),
            },
            /** @see Sprints::queryStringSprint() */
            /** Assigned Requests Link */
            self::requestedAppName(),
            $response->getName(),
            /** Assigned OutputComponents Link */
            self::requestedAppName(),
            $response->getName(),
            /** Assigned DynamicOutputComponents Link */
            self::requestedAppName(),
            $response->getName(),
        );
    }

    /**
     * Returns an array of html formatted links for the specified
     * Response's assigned Requests.
     *
     * @return array<int, string> An array of html formatted links
     *                            for the specified Response's
     *                            assigned Requests.
     */
    private static function assignedRequestLinks(
        ResponseInterface $registeredComponent,
        ComponentCrud $componentCrud
    ): array
    {
        $globalResponseRequestInfo = [];
        foreach(
            $registeredComponent->getRequestStorageInfo()
            as
            $requestStorageInfo
        )
        {
            /**
             * @var Request $request
             */
            $request = $componentCrud->read($requestStorageInfo);
            array_push(
                $globalResponseRequestInfo,
                sprintf(
                    Sprints::listedRequestLinkSprint(),
                    $request->getUrl(),
                    $request->getUrl()
                )
            );
        }
        return $globalResponseRequestInfo;
    }

    /**
     * Return an html formatted overview of the specified
     * Request's info.
     *
     * @param Request $component The Response.
     *
     * @return string An html formatted overview of the
     *                specified Request's info.
     */
    private static function requestComponentInfo(Request $component): string
    {
        return sprintf(
            Sprints::requestInfoSprint(),
            $component->getName(),
            $component->getUniqueId(),
            $component->getType(),
            $component->getLocation(),
            $component->getContainer(),
            sprintf(
                Sprints::requestLinkSprint(),
                $component->getUrl(),
                $component->getUrl(),
            ),
        );
    }

    /**
     * Return an html formatted overview of the specified Response's
     * assigned OutputComponents.
     *
     * @param class-string $componentType
     */
    private static function htmlOverviewOfResponsesConfiguredOutputComponents(
        string $responseName,
        string $componentType
    ): string
    {
        $htmlOverview = [];
        foreach(
            self::getStoredResponseByNameAndType(
                $responseName,
                self::requestedResponseType()
            )->getOutputComponentStorageInfo() as $component
        ) {
            $storedComponent = CoreComponents::componentCrud()->read($component);
            if(
                $storedComponent->getType() === $componentType
            ) {
                array_push(
                    $htmlOverview,
                    self::componentInfoHtml($storedComponent)
                );
            }
        }
        return (
            empty($htmlOverview)
            ? self::noConfiguredComponentsMessage(
                self::getStoredResponseByNameAndType(
                    $responseName,
                    self::requestedResponseType()
                )->getName(),
                $componentType,
                true
            )
            : implode(PHP_EOL, $htmlOverview)
        );
    }

    /**
     * @param class-string $componentType
     */
    private static function htmlOverviewOfResponsesConfiguredRequests(
        string $responseName,
        string $componentType
    ): string
    {

        $htmlOverview = [];
        foreach(
            self::getStoredResponseByNameAndType(
                $responseName,
                self::requestedResponseType()
            )->getRequestStorageInfo() as $component
        ) {
            $storedComponent = CoreComponents::componentCrud()->read($component);
            if($storedComponent->getType() === Request::class) {
                array_push(
                    $htmlOverview,
                    self::componentInfoHtml($storedComponent)
                );
            }
        }
        return (
            empty($htmlOverview)
            ? self::noConfiguredComponentsMessage(
                self::getStoredResponseByNameAndType(
                    $responseName,
                    self::requestedResponseType()
                )->getName(),
                $componentType,
                true
            )
            : implode(PHP_EOL, $htmlOverview)
        );
    }

   /**
    * Return the specified Response from storage.
    * If the Response does not exist, then a new
    * Response instance will be returned.
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
    private static function getStoredResponseByNameAndType(
        string $responseName,
        string $responseType
    ): ResponseInterface
    {
        /** @var ResponseInterface $component */
        $component = CoreComponents::componentCrud()->readByNameAndType(
            $responseName,
            self::requestedResponseType(),
            self::responseStorageLocation(),
            self::responseStorageContainer(),
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
        return new Response(new Storable('UnknownResponse', 'UnknownResponses', 'UnknownResponses'), new Switchable());
    }
}
