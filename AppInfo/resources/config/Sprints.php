<?php

namespace Apps\AppInfo\resources\config;

class Sprints
{

    public static function onlineDocumentationRequestSprint(): string {
        return 'https://roady.tech/index.php?request=';
    } 

    public static function outputContainerSprint(): string {
        return '<div class="roady-app-output-container">%s</div>';
    }

    public static function appsConfiguredDynamicOutputComponentSprint(): string
    {
        return '
            <h2>DynamicOutputComponents configured by the %s App:</h2>
            %s
        ';
    }

    public static function dynamicOutputComponentInfoSprint(): string {
        return '
        <div class="roady-generic-container">
            <h3>%s</h3>
            <ul class="roady-ul-list">
                <li>Unique Id:</li>
                <li> %s</li>
            </ul>
            <ul class="roady-ul-list">
                <li>Type:</li>
                <li> %s</li>
            </ul>
            <ul class="roady-ul-list">
                <li>Location:</li>
                <li> %s</li>
            </ul>
            <ul class="roady-ul-list">
                <li>Container:</li>
                <li> %s</li>
            </ul>
            <ul class="roady-ul-list">
                <li>Position:</li>
                <li> %s</li>
            </ul>
            <ul class="roady-ul-list">
                <li>State:</li>
                <li> %s</li>
            </ul>
            <ul class="roady-ul-list">
                <li>DynamicOutput file:</li>
                <li> %s</li>
            </ul>
            <ul class="roady-ul-list">
                <li>Output:</li>
                <li>%s</li>
            </ul>
        </div>';
    }

}
