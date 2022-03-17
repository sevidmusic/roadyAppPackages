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
 *
 * Methods:
 *
 * public static function outputContainerSprint(): string
 *
 * public static function respondsToSprint(): string
 *
 * public static function requestLinkSprint(): string
 *
 * public static function listedRequestLinkSprint(): string
 *
 * public static function requestInfoSprint(): string
 *
 * public static function outputComponentInfoSprint(): string
 *
 * public static function dynamicOutputComponentInfoSprint(): string {
 *
 * public static function responseInfoSprint(
 *     bool $global = false
 * ): string
 *
 * public static function noConfiguredComponentsMessageSprint(): string
 *
 */
class Sprints
{

    /**
     * Return a sprint for a div that is assigned the css class:
     *
     *     roady-app-output-container
     *
     * @example
     *
     * printf(
     *     Sprints::outputContainerSprint(),
     *     '<p>Content to be wrapped in a div that is assigned the' .
     *     'css class:</p><p>roady-app-output-container</p>'
     *  );
     *
     * @return string A sprint for a div that is assigned the
     *                css class roady-app-output-container.
     */
    public static function outputContainerSprint(): string
    {
        return '<div class="roady-app-output-container">%s</div>';
    }

    /**
     * Returns a sprint for the html that will surround a list of
     * links that correspond to the Requests assigned to a Response.
     *
     * @example
     *
     * printf(
     *     Sprints::responseInfoSprint(),
     *     '<ul>
     *          <li>
     *              <a href="http://localhost:8080">
     *                  http://localhost:8080
     *              </a>
     *          </li>
     *          <li>
     *              <a href="http://localhost:8080?request=RequestName">
     *                  http://localhost:8080?request=RequestName
     *              </a>
     *          </li>
     *      </ul>'
     *  );
     *
     *  @return string A sprint for the html that will surround a
     *                 list of links that correspond to the Requests
     *                 assigned to a Response.
     */
    public static function respondsToSprint(): string
    {
        return '
            <li>Responds to:</li>
            %s
        ';
    }

    /**
     * Returns a srpint for an html link.
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
     * Returns a srpint for an html link that is an item in an html
     * list, i.e. a sprint for an html link that is wrapped in
     * a li tag.
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
     * Return a sprint for the html that structures an overview
     * of a single Request.
     *
     * @example
     *
     * printf(
     *     Sprints::requestInfoSprint(),
     *     $request->getName(),
     *     $request->getUniqueId(),
     *     $request->getType(),
     *     $request->getLocation(),
     *     $request->getContainer(),
     *     sprintf(
     *         Sprints::requestLinkSprint(),
     *         $request->getUrl(),
     *         $request->getUrl(),
     *     ),
     * );
     *
     * A sprint for the html that structures an overview
     * of a single Request.
     */
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

    public static function noConfiguredComponentsMessageSprint(): string
    {
        return '
        <div class="roady-generic-container">
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

    private static function queryStringSprint(bool $global): string
    {
        return '&appName=%s' .
            '&responseName=%s' .
            ($global ? '&global' : '');
    }

    /**
     * Return the url to be used as a prefix for a link to the
     * online documentation on https://roady.tech.
     *
     * @return string The url to be used as a prefix for a link to
     *                the online documentation on https://roady.tech.
     */
    private static function onlineDocumentationRequestUrlPrefix(): string {
        return 'https://roady.tech/index.php?request=';
    }
}
