<?php

namespace Apps\AppInfo\resources\config;

use roady\interfaces\component\Component;
use roady\interfaces\component\DynamicOutputComponent as DynamicOutputComponentInterface;
use roady\classes\component\DynamicOutputComponent;
use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\Sprints;

class Sprints
{

    private static function onlineDocumentationRequestSprint(): string {
        return 'https://roady.tech/index.php?request=';
    }

    public static function outputContainerSprint(): string {
        return '<div class="roady-app-output-container">%s</div>';
    }

    public static function respondsToSprint(): string
    {
        return '
            <li>Responds to:</li>
            <!-- Start REQUEST_LINK_SPRINT -->
            %s
            <!-- End REQUEST_LINK_SPRINT -->
        ';
    }

    public static function requestLinkSprint(): string
    {
        return '<a href="%s">%s</a>';
    }

    public static function listedRequestLinkSprint(): string
    {
        return '<li><a href="%s">%s</a></li>';
    }

    public static function requestInfoSprint(): string
    {
        return '
            <div class="roady-generic-container">
                <h3>%s</h3>
                <ul class="roady-ul-list">
                    <li>Unique Id:</li>
                    <li>%s</li>
                </ul>
                <ul class="roady-ul-list">
                    <li>Type:</li>
                    <li>%s</li>
                </ul>
                <ul class="roady-ul-list">
                    <li>Location:</li>
                    <li>%s</li>
                </ul>
                <ul class="roady-ul-list">
                    <li>Container:</li>
                    <li>%s</li>
                </ul>
                <ul class="roady-ul-list">
                    <li>Url:</li>
                    <li>%s</li>
                </ul>
            </div>';
    }

    public static function outputComponentInfoSprint(): string {
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
                <li>Output:</li>
                <li>%s</li>
            </ul>
        </div>';
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

    public static function responseInfoSprint(bool $global = false): string
    {
        return '
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
            <li>Position</li>
            <li>%s</li>
        </ul>
        <ul class="roady-ul-list">
            <!-- start RESPONDS_TO_SPRINT -->
            %s
            <!-- end RESPONDS_TO_SPRINT -->
        </ul>
        <ul class="roady-ul-list">
            <li>Assigned Components:</li>
            <li>
                <a href="index.php?request=ResponseRequestInfo' .
                self::queryStringSprint($global) . '">Requests</a>
            </li>
            <li>
                <a href="index.php?request=ResponseOutputComponentInfo' .
                self::queryStringSprint($global) .
                '">OutputComponents</a>
            </li>
            <li>
                <a href="index.php?' .
                'request=ResponseDynamicOutputComponentInfo' .
                self::queryStringSprint($global) .
                '">DynamicOutputComponents</a>
            </li>
        </ul>
    </div>
        ';
    }

    private static function queryStringSprint(bool $global): string
    {
        return '&appName=%s' .
            '&responseName=%s' .
            ($global ? '&global' : '');
    }

}
