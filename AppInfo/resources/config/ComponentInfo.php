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
 * The ComponentInfo class provides a number of static methods
 * that return html formatted overviews of an App's configured
 * Components.
 *
 * Methods:
 *
 */
class ComponentInfo
{
    /**
     * Return an html formatted overview of the currently specified
     * App's configured Components. Only the Components whose type
     * matches the specified type will be included in the overview.
     *
     * @example:
     *
     * use Apps\AppInfo\resources\config\Sprints;
     * use Apps\AppInfo\resources\config\CoreComponents;
     * use Apps\AppInfo\resources\config\ComponentInfo;
     * use roady\classes\component\DynamicOutputComponent;
     *
     * ComponentInfo::htmlOverviewOfAppsConfiguredComponents(
     *     'AppInfo',
     *     DynamicOutputComponent::class
     * )
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
        return match(empty($generatedHtmlOverviewOfAppsConfiguredComponents)) {
            true => ComponentInfo::noConfiguredComponentsMessage(
                $appName,
                $componentType
            ),
            default =>
                '<h2>' . self::getClassName($componentType, true) .
                ' configured by the ' . $appName . ' App</h2>' .
                implode(
                    PHP_EOL,
                    $generatedHtmlOverviewOfAppsConfiguredComponents
                )
            };
    }

    /**
     * @param class-string $componentType
     */
    public static function htmlOverviewOfResponsesConfiguredComponents(
        string $responseName,
        string $componentType
    ): string
    {
        return match($componentType) {
            OutputComponent::class => self::htmlOverviewOfResponsesConfiguredOutputComponents($responseName, $componentType),
            DynamicOutputComponent::class => self::htmlOverviewOfResponsesConfiguredOutputComponents($responseName, $componentType),
            Request::class => self::htmlOverviewOfResponsesConfiguredRequests($responseName, $componentType),
            default => '',
        };
    }

    /**
     * Return an html formatted error message to indicate that there
     * are no Components of the specified type configured by the
     * specified App or assigned to the specified Response.
     *
     * @param string $appOrResponseName The name of the App or
     *                                  Response.
     *
     * @param class-string $componentType The type of Component that
     *                                    was not found.
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

    public static function requestedAppName(): string
    {
        return CoreComponents::currentRequest()->getGet()['appName'];
    }

    public static function requestedResponseName(): string
    {
        return CoreComponents::currentRequest()->getGet()['responseName'];
    }

    /**
     * @return class-string
     */
    private static function requestedResponseType(): string
    {
        return (
            isset(CoreComponents::currentRequest()->getGet()['global'])
            ? GlobalResponse::class
            : Response::class
        );
    }

    private static function requestedResponseLocation(): string
    {
        return App::deriveAppLocationFromRequest(
            CoreComponents::currentRequest()
        );
    }

    private static function requestedResponseContainer(): string
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
     *                            Components.
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

    private static function outputComponentInfo(OutputComponent $component): string
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

    private static function dynamicOutputComponentInfo(DynamicOutputComponent $component): string
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
     * @return array<int, string>
     */
    private static function generateRequestInfoStrings(
        ResponseInterface $registeredComponent,
        ComponentCrud $componentCrud
    ): array {
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



    private static function responseComponentInfo(
        ResponseInterface $component
    ): string
    {
        return sprintf(
            Sprints::responseInfoSprint(
                ($component->getType() === GlobalResponse::class)
            ),
            $component->getName(),
            $component->getUniqueId(),
            $component->getType(),
            $component->getLocation(),
            $component->getContainer(),
            $component->getPosition(),
            match($component->getType()) {
                GlobalResponse::class =>
                    '<li>Responds To:</li><li>All Requests</li>',
                default => sprintf(
                    Sprints::respondsToSprint(),
                    implode(
                        PHP_EOL,
                        self::generateRequestInfoStrings(
                            $component,
                            CoreComponents::ComponentCrud()
                        )
                    )
                ),
            },
            /** @see Sprints::queryStringSprint() */
            /** Assigned Requests Link */
            self::requestedAppName(),
            $component->getName(),
            /** Assigned OutputComponents Link */
            self::requestedAppName(),
            $component->getName(),
            /** Assigned DynamicOutputComponents Link */
            self::requestedAppName(),
            $component->getName(),
        );
    }

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
    * @param string $responseName
    * @param class-string $responseType
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
            self::requestedResponseLocation(),
            self::requestedResponseContainer(),
        );
        return match($component->getType()) {
            Response::class, GlobalResponse::class => $component,
            default => self::newResponseInstance(),
        };
    }

    private static function newResponseInstance(): Response
    {
        return new Response(new Storable('UnknownResponse', 'UnknownResponses', 'UnknownResponses'), new Switchable());
    }

    /**
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
}
