<?php

namespace Apps\AppInfo\resources\config;

use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\Sprints;
use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\DynamicOutputComponent;
use roady\classes\component\OutputComponent;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;
use roady\classes\component\Web\Routing\GlobalResponse;
use roady\classes\component\Web\Routing\Response;
use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\interfaces\component\Component;

/**
 * Provides a number of static methods that return html formatted 
 * overviews of an App's configured Components.
 *
 * Methods:
 * public static function htmlOverviewOfAppsConfiguredComponents(
 *     string $componentType
 * ): string
 *
 * public static function noConfiguredComponentsMessage(
 *     string $componentType, 
 *     string $commandHint
 * ): string
 *
 * public static function generateRequestInfoStrings(
 *     ResponseInterface $registeredComponent, 
 *     ComponentCrud $componentCrud
 * ): string
 */
class ComponentInfo 
{

    /**
     * Return an html formatted overview of the currently requested 
     * App's configured Components. Only the Components whose type 
     * matches the specified type will be included in the overview.
     *
     * If there aren't any Components of the specified type 
     * configured by the requested App, then an empty string will 
     * be returned.
     *
     * @example:
     *     ComponentInfo::htmlOverviewOfAppsConfiguredComponents(
     *         DynamicOutputComponent::class
     *     );
     *
     * @param class-string $componentType The type of Component to 
     *                                    include in the overview.
     */
    public static function htmlOverviewOfAppsConfiguredComponents(
        string $appName,
        string $componentType
    ): string 
    {
        $generatedHtmlOverviewOfAppsConfiguredComponents = 
            self::generateHtmlOverviewOfAppsConfiguredComponents(
                $appName,
                $componentType
            );
        return (
            empty($generatedHtmlOverviewOfAppsConfiguredComponents) 
            ? ComponentInfo::noConfiguredComponentsMessage(
                $componentType
            )
            : '<h2>' . self::getClassName($componentType) . 's configured by the ' . 
            (
                CoreComponents::currentRequest()->getGet()['appName'] 
                ?? 
                'roady'
            ) . ' App</h2>' . 
            implode(
                PHP_EOL, 
                $generatedHtmlOverviewOfAppsConfiguredComponents
            )
        );
    }

    /**
     * @param class-string $class
     * @return string The classes name, excluding the class's namespace.
     */
    private static function getClassName(string $class): string
    {
        $reflection = new \ReflectionClass($class);
        return $reflection->getShortName();
    }

    /**
     * @param class-string $componentType The type of Component to 
     *                                    include in the overview.
     * @return array<int, string>
     */
    private static function generateHtmlOverviewOfAppsConfiguredComponents(
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
     * @param class-string $componentType
     */
    public static function noConfiguredComponentsMessage(
        string $componentType, 
        bool $responseComponentInfo = false
    ): string
    {
        $appName = (
            CoreComponents::currentRequest()->getGet()['appName'] 
            ?? 
            'roady'
        );
        return "
        <p class='roady-message'>
            There are no " . self::getClassName($componentType) . "s configured for the " .
            (
                $responseComponentInfo 
                ? self::requestedResponse()->getName() . ' ' .
                self::getClassName(self::requestedResponse()::class) 
                : $appName . ' app'
            ) . 
            ".
        </p>
        <p class=\"roady-note\">
            Hint: <a href=\"https://roady.tech/index.php?request=rig\">
                rig
            </a>
            can be used to configure various types of Components for
            an App.
        </a>
        ";
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
                (
                    CoreComponents::currentRequest()
                        ->getGet()['appName']  
                    ?? 
                    ''
                )
                ===
                'AppInfo'
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
    public static function generateRequestInfoStrings(
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
            (
                ($component->getType() === GlobalResponse::class)
                ? '<li>Responds To:</li><li>All Requests</li>'
                : sprintf(
                    Sprints::respondsToSprint(),
                    implode(
                        PHP_EOL,
                        self::generateRequestInfoStrings(
                            $component,
                            CoreComponents::ComponentCrud()
                        )
                    )
                )
            ),
            (CoreComponents::currentRequest()->getGet()['appName'] ?? 'roady'),
            $component->getName(),
            $component->getUniqueId(),
            $component->getLocation(),
            $component->getContainer(),
            (CoreComponents::currentRequest()->getGet()['appName'] ?? 'roady'),
            $component->getName(),
            $component->getUniqueId(),
            $component->getLocation(),
            $component->getContainer(),
            (CoreComponents::currentRequest()->getGet()['appName'] ?? 'roady'),
            $component->getName(),
            $component->getUniqueId(),
            $component->getLocation(),
            $component->getContainer(),
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
    * @return ResponseInterface The requested Response or GlobalResponse.
    *
    * Note: If the requested Response or GlobalResponse does not
    * exist, then a new Response instance named UnknownResponse 
    * will be returned.
    */
    private static function requestedResponse(): ResponseInterface
    {
        $component = CoreComponents::componentCrud()->readByNameAndType(
            (
                CoreComponents::currentRequest()->getGet()['responseName']
                ?? 
                'unknown'
            ),
            (
                isset(CoreComponents::currentRequest()->getGet()['global'])
                ? GlobalResponse::class
                : Response::class
            ),
            (
                CoreComponents::currentRequest()->getGet()['responseLocation']
                ??
                'unknown'
            ),
            (
                CoreComponents::currentRequest()->getGet()['responseContainer']
                ??
                'unknown'
            ),
        );
        if(
            $component->getType() === Response::class 
            || 
            $component->getType() === GlobalResponse::class
        ) {
            /**
             * @var Response|GlobalResponse $component 
             */
            return $component;
        }
        return new Response(
            new Storable('UnknownResponse', 'UnknownResponses', 'UnknownResponses'),
            new Switchable()
        );
    }

    /**
     * @param class-string $componentType
     */
    public static function htmlOverviewOfResponsesConfiguredComponents(string $componentType): string
    {
        switch($componentType) {
            case OutputComponent::class:
            case DynamicOutputComponent::class:
                $htmlOverview = self::htmlOverviewOfResponsesConfiguredOutputComponents($componentType);
        }
        return (
            isset($htmlOverview) && !empty($htmlOverview) 
            ? $htmlOverview
            : self::noConfiguredComponentsMessage($componentType, true)
        ); 
    }

    /**
     * @param class-string $componentType
     */
    private static function htmlOverviewOfResponsesConfiguredOutputComponents(string $componentType): string
    {
        $htmlOverview = [];
        foreach(
            self::requestedResponse()->getOutputComponentStorageInfo() 
            as 
            $component
        ) {
            $storedComponent = CoreComponents::componentCrud()->read($component);
            if($storedComponent->getType() === $componentType) {
                array_push(
                    $htmlOverview,
                    self::componentInfoHtml($storedComponent)
                );
            }
        }
        return implode(PHP_EOL, $htmlOverview);
    }

}
