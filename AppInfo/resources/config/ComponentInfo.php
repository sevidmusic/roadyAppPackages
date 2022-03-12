<?php

namespace Apps\AppInfo\resources\config;

use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\Sprints;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\DynamicOutputComponent;
use roady\classes\component\OutputComponent;
use roady\classes\component\Web\App;
use roady\classes\component\Web\Routing\GlobalResponse;
use roady\classes\component\Web\Routing\Request;
use roady\classes\component\Web\Routing\Response;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\interfaces\component\Component;
use roady\interfaces\component\SwitchableComponent;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;

/**
 * The ComponentInfo class provides static methods that return
 * html formatted overviews of either an App's configured Components,
 * or a Response's assigned Components.
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
     * assigned Components. Only the Components whose type matches
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
     *                Response's assigned Components.
     */
    public static function htmlOverviewOfResponsesAssignedComponents(
        string $responseName,
        string $componentType
    ): string
    {
        return match($componentType) {
            OutputComponent::class, DynamicOutputComponent::class
                => self::htmlOverviewOfResponsesConfiguredOutputComponents(
                    $responseName,
                    $componentType
                ),
            Request::class
                => self::htmlOverviewOfResponsesConfiguredRequests(
                    $responseName
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
        return sprintf(
            Sprints::noConfiguredComponentsMessageSprint(),
            self::getClassName($componentType, true),
            match($responseComponentInfo) {
                true => 'assigned to',
                default => 'configured for'
            },
            match($responseComponentInfo) {
                true =>
                    $appOrResponseName . ' ' .
                    self::getClassName(self::requestedResponseType()),
                default => $appOrResponseName . ' app'
            }
        );
    }

    /**
     * Return the name of the requested App.
     *
     * This will be the value assigned to $_GET['appName'].
     *
     * @return string The requested App's name.
     */
    public static function requestedAppName(): string
    {
        return CoreComponents::currentRequest()->getGet()['appName'];
    }

    /**
     * Return the name of the requested Response.
     *
     * This will be the value assigned to $_GET['responseName'].
     *
     * @return string The requested Response's name.
     */
    public static function requestedResponseName(): string
    {
        return CoreComponents::currentRequest()
               ->getGet()['responseName'];
    }

    /**
     * Returns an html header for an App's configured Component
     * overview, or a Response's assigned Component overview.
     *
     * The html header's content will conform to the following
     * format:
     *
     * <h2>
     *     $componentType's configured by the
     *     $appOrResponseName {App|Response|GlobalResponse}
     * </h2>
     *
     * @param string $appOrResponseName The name of the App
     *                                  the Components were
     *                                  configured by, or the
     *                                  name of the Response
     *                                  the Components are
     *                                  assigned to.
     *
     * @param class-string $componentType The type of Component.
     *
     * @param bool $forResponsesAssignedComponentOverview Set to true
     *                                                    if html
     *                                                    header is
     *                                                    for a
     *                                                    Response's
     *                                                    assigned
     *                                                    Components
     *                                                    overview.
     *                                                    Set to
     *                                                    false if
     *                                                    header is
     *                                                    for an
     *                                                    App's
     *                                                    configured
     *                                                    Components
     *                                                    overview.
     *
     * @return string Returns an html header for a configured
     *                Component overview.
     *
     */
    private static function configuredComponentsHeader(
        string $appOrResponseName,
        string $componentType,
        bool   $forResponsesAssignedComponentOverview = false
    ): string
    {
        return '<h2>' .
            self::getClassName($componentType, true) .
            match($forResponsesAssignedComponentOverview) {
                true => ' assigned to',
                default => ' configured by',
            } .
            ' the ' . $appOrResponseName . ' ' .
            match($forResponsesAssignedComponentOverview) {
                true =>
                    self::getClassName(
                        self::requestedResponseType()
                    ),
                default => 'App'
            } .
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
        return match(
            isset(
                CoreComponents::currentRequest()->getGet()['global']
            )
        ) {
            true => GlobalResponse::class,
            default => Response::class
        };
    }

    /**
     * Return the name of the storage location where an App's
     * Responses are expected to be located.
     *
     * @return string The name of the storage location where an
     *                App's Response's are expected to be located.
     */
    private static function responseStorageLocation(): string
    {
        return App::deriveAppLocationFromRequest(
            CoreComponents::currentRequest()
        );
    }

    /**
     * Return the name of the storage container where an App's
     * Responses are expected to be stored.
     *
     * @return string The name of the storage container where an
     *                App's Response's are expected to be stored.
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
     * @return string The class's name, excluding the class's
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
     * @note: The html formatted overviews of each Component's info
     *        are generated by the ComponentInfo::componentInfoHtml()
     *        method.
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
     *                            specified $componentType.
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
        switch($component->getType()) {
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
     * @param OutputComponent $outputComponent The OutputComponent.
     *
     * @return string An html formatted overview of the
     *                specified OutputComponent's info.
     */
     private static function outputComponentInfo(
         OutputComponent $outputComponent
     ): string
    {
        return sprintf(
            Sprints::outputComponentInfoSprint(),
            $outputComponent->getName(),
            $outputComponent->getUniqueId(),
            $outputComponent->getType(),
            $outputComponent->getLocation(),
            $outputComponent->getContainer(),
            $outputComponent->getPosition(),
            self::switchableComponentState($outputComponent),
            $outputComponent->getOutput()
        );
    }

    /**
     * Return an html formatted overview of the specified
     * DynamicOutputComponent's info.
     *
     * @param DynamicOutputComponent $dynamicOutputComponent
     *                                   The DynamicOutputComponent.
     *
     * @return string An html formatted overview of the
     *                specified DynamicOutputComponent's info.
     */
    private static function dynamicOutputComponentInfo(
        DynamicOutputComponent $dynamicOutputComponent
    ): string
    {
        return sprintf(
            Sprints::dynamicOutputComponentInfoSprint(),
            $dynamicOutputComponent->getName(),
            $dynamicOutputComponent->getUniqueId(),
            $dynamicOutputComponent->getType(),
            $dynamicOutputComponent->getLocation(),
            $dynamicOutputComponent->getContainer(),
            $dynamicOutputComponent->getPosition(),
            self::switchableComponentState($dynamicOutputComponent),
            $dynamicOutputComponent->getDynamicFilePath(),
            (
                self::requestedAppName() === 'AppInfo'
                ? '<span class="roady-error-message">' .
                'The App Info App\'s DynamicOutput ' .
                'cannot be previewed.</span>'
                : $dynamicOutputComponent->getOutput()
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
     * @param ResponseInterface $response The Response the Requests
     *                                    are assigned to.
     *
     * @param ComponentCrud $componentCrud A ComponentCrud instance.
     *
     * @return array<int, string> An array of html formatted links
     *                            for the specified Response's
     *                            assigned Requests.
     */
    private static function assignedRequestLinks(
        ResponseInterface $response,
        ComponentCrud $componentCrud
    ): array
    {
        $responseRequestInfo = [];
        foreach(
            $response->getRequestStorageInfo()
            as
            $requestStorageInfo
        )
        {
            /**
             * @var Request $request
             */
            $request = $componentCrud->read($requestStorageInfo);
            array_push(
                $responseRequestInfo,
                sprintf(
                    Sprints::listedRequestLinkSprint(),
                    $request->getUrl(),
                    $request->getUrl()
                )
            );
        }
        return $responseRequestInfo;
    }

    /**
     * Return an html formatted overview of the specified
     * Request's info.
     *
     * @param Request $request The Request.
     *
     * @return string An html formatted overview of the
     *                specified Request's info.
     */
    private static function requestComponentInfo(
        Request $request
    ): string
    {
        return sprintf(
            Sprints::requestInfoSprint(),
            $request->getName(),
            $request->getUniqueId(),
            $request->getType(),
            $request->getLocation(),
            $request->getContainer(),
            sprintf(
                Sprints::requestLinkSprint(),
                $request->getUrl(),
                $request->getUrl(),
            ),
        );
    }

    /**
     * Return an html formatted overview of the specified Response's
     * assigned OutputComponents or DynamicOutputComponents.
     *
     * @param string $responseName The name of the Response the
     *                             Component's are assigned to.
     *
     * @param class-string $outputComponentType The type of
     *                                          OutputComponent to
     *                                          include.
     *
     * @return string Return an html formatted overview of the
     *                specified Response's assigned OutputComponents
     *                or DynamicOutputComponents.
     */
    private static function htmlOverviewOfResponsesConfiguredOutputComponents(
        string $responseName,
        string $outputComponentType
    ): string
    {
        $htmlOverview = [];
        foreach(
            self::getStoredResponseByNameAndType(
                $responseName,
                self::requestedResponseType()
            )->getOutputComponentStorageInfo() as $component
        ) {
            $storedComponent = CoreComponents::componentCrud()->read(
                $component
            );
            if(
                $storedComponent->getType() === $outputComponentType
                &&
                self::isAnOutputComponentImplementation(
                    $storedComponent
                )
            ) {
                array_push(
                    $htmlOverview,
                    self::componentInfoHtml($storedComponent)
                );
            }
        }
        return match(empty($htmlOverview)) {
            true =>
                self::noConfiguredComponentsMessage(
                    self::getStoredResponseByNameAndType(
                        $responseName,
                        self::requestedResponseType()
                    )->getName(),
                    $outputComponentType,
                    true
                ),
            default =>
                self::configuredComponentsHeader(
                    $responseName,
                    $outputComponentType,
                    true
                ) . implode(PHP_EOL, $htmlOverview)
        };
    }

    /**
     * Returns true if the specified $component is a
     * OutputComponent or a DynamicOutputComponent, otherwise
     * return false.
     *
     * @param Component $component The Component to test.
     *
     * @return bool True if the $component is a OutputComponent,
     *              or a DynamicOutputComponent, false otherwise.
     *
     */
    private static function isAnOutputComponentImplementation(
        Component $component
    ) : bool
    {
        return (
            $component->getType() === OutputComponent::class
            ||
            $component->getType() === DynamicOutputComponent::class
        );
    }

    /**
     * Return an html formatted overview of the specified Response's
     * assigned Requests.
     *
     * @param string $responseName The name of the Response the
     *                             Component's are assigned to.
     *
     * @return string An html formatted overview of the specified
     *                Response's assigned Requests.
     *
     */
    private static function htmlOverviewOfResponsesConfiguredRequests(
        string $responseName
    ): string
    {

        $htmlOverview = [];
        foreach(
            self::getStoredResponseByNameAndType(
                $responseName,
                self::requestedResponseType()
            )->getRequestStorageInfo() as $component
        ) {
            $storedComponent = CoreComponents::componentCrud()->read(
                $component
            );
            if($storedComponent->getType() === Request::class) {
                array_push(
                    $htmlOverview,
                    self::componentInfoHtml($storedComponent)
                );
            }
        }
        return match(empty($htmlOverview)) {
            true => self::noConfiguredComponentsMessage(
                self::getStoredResponseByNameAndType(
                    $responseName,
                    self::requestedResponseType()
                )->getName(),
                Request::class,
                true
            ),
            default => self::configuredComponentsHeader(
                $responseName,
                Request::class,
                true
            ) . implode(PHP_EOL, $htmlOverview)
        };
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
        return new Response(
            new Storable(
                'UnknownResponse',
                'UnknownResponses',
                'UnknownResponses'
            ),
            new Switchable()
        );
    }

    /**
     * Return the string form of the specified SwitchableComponent's
     * state.
     *
     * @param SwitchableComponent $switchableComponent The SwitchableComponent.
     *
     * @return string The string form of the specified
     *                SwitchableComponent's state.
     */
    private static function switchableComponentState(
        SwitchableComponent $switchableComponent
    ): string
    {
        return match($switchableComponent->getState()) {
            true => 'true',
            default => 'false'
        };
    }
}
