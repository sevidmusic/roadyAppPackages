<?php

namespace Apps\AppInfo\resources\config;

use roady\interfaces\component\Component;
use roady\interfaces\component\DynamicOutputComponent as DynamicOutputComponentInterface;
use roady\classes\component\DynamicOutputComponent;
use Apps\AppInfo\resources\config\CoreComponents;
use Apps\AppInfo\resources\config\Sprints;

/**
 * The Sprints class provides a number of methods that return
 * appropriate sprints for the html formatted overviews provided
 * by the AppInfo App.
 */
class Sprints
{

    /**
     * Return a sprint for the html that structures an overview
     * of a single DynamicOutputComponent.
     *
     * @example
     *
     * printf(
     *     Sprints::dynamicOutputComponentInfoSprint(),
     *     'DynamicOutputComponentName',
     *     'UniqueId',
     *     'Type',
     *     'Location',
     *     'Container',
     *     'Position',
     *     'State',
     *     '/Dynamic/Output/File/Path',
     *     'Output'
     * );
     *
     * @return string A sprint for the html that structures an
     *                overview of a single DynamicOutputComponent.
     */
    public static function dynamicOutputComponentInfoSprint(): string {
        return '
        <div class="roady-3-column-grid-item roady-generic-container">
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

    /**
     * Returns a sprint for an html link that is an item in an html
     * list, i.e. a sprint for an html link that is wrapped in
     * a <li> tag.
     *
     * @example
     *
     * printf(
     *     self::requestLinkSprint(),
     *     'https://url-to-assign-to-href-attribute',
     *     'Link Text'
     * );
     *
     * @return string A sprint for an html link that is an item
     *                in an html list.
     */
    public static function listedRequestLinkSprint(): string
    {
        return '<li><a href="%s">%s</a></li>';
    }

    /**
     * Return a sprint for an error message used to indicate
     * that an App has no configured Components, or that a
     * Response is not assigned any Components.
     *
     * @example
     *
     * printf(
     *     Springs::noConfiguredComponentsMessageSprint(),
     *     'ComponentType',
     *     'configured by|assigned to',
     *     'AppName|ResponseName',
     * );
     *
     * @returns string A sprint for the error message used to
     *                 indicate that an App has no configured
     *                 Components, or that a Response is not
     *                 assigned any Components.
     */
    public static function noConfiguredComponentsMessageSprint(): string
    {
        return '
        <div class="roady-3-column-grid-item roady-generic-container">
            <p class="roady-message">
                There are no %s %s the %s.
            </p>
            <p class="roady-note">
                Hint:
                <a href="https://roady.tech/index.php?request=rig">
                    rig
                </a>
                can be used to configure various types of Components for
                an App.
            </p>
        </div>
        ';
    }

    /**
     * Return a sprint for the html that structures an overview
     * of a single OutputComponent.
     *
     * @example
     *
     * printf(
     *     Sprints::outputComponentInfoSprint(),
     *     'OutputComponentName',
     *     'UniqueId',
     *     'Type',
     *     'Location',
     *     'Container',
     *     'Position',
     *     'State',
     *     'Output'
     * );
     *
     * @return string A sprint for the html that structures an
     *                overview of a single OutputComponent.
     */
    public static function outputComponentInfoSprint(): string {
        return '
        <div class="roady-3-column-grid-item roady-generic-container">
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

    /**
     * Return a sprint for a div that is assigned the css class:
     *
     *     roady-app-output-container
     *
     * @example
     *
     * printf(
     *     Sprints::outputContainerSprint(),
     *     '<p>Content to place within the div.</p>'
     * );
     *
     *
     * @return string A sprint for a div that is assigned the
     *                css class roady-app-output-container.
     */
    public static function outputContainerSprint(): string
    {
        return '<div class="roady-app-output-container">%s</div>';
    }

    /**
     * Return a sprint for the html that structures an overview
     * of a single Request.
     *
     * @example
     *
     * printf(
     *     Sprints::requestInfoSprint(),
     *     'RequestName',
     *     'UniqueId',
     *     'Type',
     *     'Location',
     *     'Container',
     *     'Url',
     * );
     *
     * @return string A sprint for the html that structures an
     *                overview of a single Request.
     */
    public static function requestInfoSprint(): string
    {
        return '
            <div class="roady-3-column-grid-item roady-generic-container">
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

    /**
     * Returns a sprint for an html link.
     *
     * @example
     *
     * printf(
     *     self::requestLinkSprint(),
     *     'https://url-to-assign-to-href-attribute',
     *     'Link Text'
     * );
     *
     * @return string A sprint for an html link.
     */
    public static function requestLinkSprint(): string
    {
        return '<a href="%s">%s</a>';
    }

    /**
     * Return a sprint for the html that structures an overview
     * of a single Response.
     *
     * @example
     *
     * printf(
     *     Sprints::responseInfoSprint(),
     *     'ResponseName',
     *     'UniqueId',
     *     'Type',
     *     'Location',
     *     'Container',
     *     'Position',
     *     'RespondsTo',
     *     'AssignedComponents'
     * );
     *
     * @return string A sprint for the html that structures an
     *                overview of a single Response.
     */
    public static function responseInfoSprint(bool $global = false): string
    {
        return '
    <div class="roady-3-column-grid-item roady-generic-container">
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
            <li>Responds To:</li>
            %s
        </ul>
        <ul class="roady-ul-list">
            <li>Assigned Components:</li>
            %s
        </ul>
    </div>
        ';
    }

}

