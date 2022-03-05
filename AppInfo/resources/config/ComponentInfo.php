<?php

namespace Apps\AppInfo\resources\config;

use roady\interfaces\component\Component;
use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\Sprints;
use roady\classes\component\DynamicOutputComponent;
use roady\classes\component\OutputComponent;

/**
 *
 * Methods:
 * public static function htmlOverviewOfAppsConfiguredComponents(string $componentType): string
 * public static function noConfiguredComponentsMessage(
 *     string $componentType, 
 *     string $commandHint
 * ): string
 */
class ComponentInfo 
{

    /**
     * Return html formatted overview of the currently requested App's
     * configured Components. Only the Components whose type matches
     * the specified type will be included in the overview.
     *
     * If there aren't any Components of the specified type configured
     * by the requested App, then an empty string will be returned.
     *
     * @example:
     *     ComponentInfo::htmlOverviewOfAppsConfiguredComponents(DynamicOutputComponent::class);
     *
     * @param class-string $componentType The type of Component to 
     *                                    include in the overview.
     */
    public static function htmlOverviewOfAppsConfiguredComponents(string $componentType): string 
    {
        $generateHtmlOverviewOfAppsConfiguredComponents = self::generateHtmlOverviewOfAppsConfiguredComponents($componentType);
        return (
            empty($generateHtmlOverviewOfAppsConfiguredComponents) 
            ? ComponentInfo::noConfiguredComponentsMessage($componentType)
            : implode(PHP_EOL, $generateHtmlOverviewOfAppsConfiguredComponents)
        );
    }

    /**
     * @param class-string $componentType The type of Component to 
     *                                    include in the overview.
     * @return array<int, string>
     */
    private static function generateHtmlOverviewOfAppsConfiguredComponents(string $componentType): array 
    {
        $htmlOverviewOfAppsConfiguredComponents = [];
        foreach (
            CoreComponents::appsAppComponentsFactory()
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

    public static function noConfiguredComponentsMessage(
        string $componentType, 
    ): string
    {
        $appName = (
            CoreComponents::currentRequest()->getGet()['appName'] 
            ?? 
            'roady'
        );
        return "
        <p class='roady-message'>
            There are no $componentType's configured for the 
            $appName app.
        </p>
        <p class=\"roady-note\">
            Hint: <a href=\"https://roady.tech/index.php?request=rig\">rig</a>
            can be used to configure various types of Components for
            an App.
        </a>
        ";
    }

    private static function componentInfoHtml(Component $component): string {
        switch($component->getType() ) {
            case DynamicOutputComponent::class:
                /**
                 * @var DynamicOutputComponent $component
                 */
                return self::dynamicOutputComponentInfo($component);
            case OutputComponent::class:
                /**
                 * @var OutputComponent $component
                 */
                return self::outputComponentInfo($component);
            default: return '';
        }
    }

    private static function dynamicOutputComponentInfo(DynamicOutputComponent $component): string
    {
        return sprintf(
            Sprints::dynamicOutputComponentInfoSprint(),
            (CoreComponents::currentRequest()->getGet()['appName'] ?? 'roady'),
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

    private static function outputComponentInfo(OutputComponent $component): string
    {
        return 'OC OC OC';
    }

}
