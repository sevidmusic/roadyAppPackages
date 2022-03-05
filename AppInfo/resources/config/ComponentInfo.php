<?php

namespace Apps\AppInfo\resources\config;

use roady\interfaces\component\Component;
use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\Sprints;
use roady\classes\component\DynamicOutputComponent;

class ComponentInfo 
{
    public static function componentInfoHtml(Component $component): string {
        switch($component->getType() ) {
            case DynamicOutputComponent::class:
                /**
                 * @var DynamicOutputComponent $component
                 */
                return self::dynamicOutputComponentInfo($component);
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

    public static function appsConfiguredComponentOverviewHtml(): string 
    {
        $appsConfiguredComponentOverviewHtml = [];
        foreach (
            CoreComponents::appsAppComponentsFactory()
                ->getStoredComponentRegistry()
                ->getRegisteredComponents()
            as
            $registeredComponent
        ) {
            array_push(
                $appsConfiguredComponentOverviewHtml,
                self::componentInfoHtml($registeredComponent)
            );
        }
        return (
            empty($appsConfiguredComponentOverviewHtml) 
            ? '' 
            : implode(PHP_EOL, $appsConfiguredComponentOverviewHtml)
        );
    }

}
