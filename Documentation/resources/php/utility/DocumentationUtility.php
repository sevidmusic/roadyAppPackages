<?php

namespace Apps\Documentation\resources\php\utility;

class DocumentationUtility {

    public static function documentationFilterLinks(string $output): string {
        /**
         * @var array<string, string> $links
         */
        $links = [
            '$PATH' => '<a href="index.php?request=Installation#AddRIGToYourPATH">$PATH</a>',
            '--configure-app-output' => '<a href="index.php?request=RIGConfigureAppOutput">--configure-app-output</a>',
            '--start-server' => '<a href="index.php?request=RIGStartServer">--start-server</a>',
            '--make-app-package' => '<a href="index.php?request=RIGMakeAppPackage">--make-app-package</a>',
            'APPS' => '<a href="index.php?request=Apps">Apps</a>',
            'APP_PACKAGES' => '<a href="index.php?request=AppPackages">App Packages</a>',
            'A_P_P' => '<a href="index.php?request=Apps">App</a>',
            'COMMAND_LINE_RIG' => '<a href="index.php?request=rig">rig</a>',
            'COMPONENT' => '<a href="index.php?request=Components">Component</a>',
            'EXTERNAL_LINK_GITHUB_ROADY' => '<a href="https://github.com/sevidmusic/roady">Roady</a>',
            'EXTERNAL_LINK_GITHUB_RIG_APP_PKGS' => '<a href="https://github.com/sevidmusic/rigAppPackages">rigAppPackages</a>',
            'EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY' => '<a href="https://github.com/sevidmusic/rig">rig</a>',
            'EXTERNAL_LINK_GITHUB_DOCUMENTATION_APP' => '<a href="https://github.com/sevidmusic/rigAppPackages/tree/rigAppPackages1.7.9/Documentation">Dcoumentation</a>',
            'EXTERNAL_LINK_GITHUB_DOCUMENTATION_DARK_THEME_APP_URL' => '<a href="https://github.com/sevidmusic/rigAppPackages/tree/rigAppPackages1.7.9/DocumentationDarkTheme">DcoumentationDarkTheme</a>',
            'DYNAMICOUTPUTFILES' => '<a href="index.php?request=DynamicOutputFiles">Dynamic Output files</a>',
            'DYNAMIC_OUTPUT_COMP' => '<a href="index.php?request=OutputComponents">DynamicOutputComponent</a>',
            'DYNAMIC_OUT_PUT_COMPS' => '<a href="index.php?request=OutputComponents">DynamicOutputComponents</a>',
            'GETTING_STARTED' => '<a href="index.php?request=GettingStarted">Getting Started</a>',
            'GET_STARTED' => '<a href="index.php?request=GettingStarted">get started</a>',
            'GLOBAL_RESPONSE' => '<a href="index.php?request=Responses">GlobalResponse</a>',
            'GLOBAL_RE_SPONSES' => '<a href="index.php?request=Responses">GlobalResponses</a>',
            'HELLOWORLDAPPDEMO' => '<a href="index.php?request=GettingStarted#HelloWorldDemo">Hello World App Demo</a>',
            'HELLO_WORLD_APP' => '<a href="index.php?request=GettingStarted#HelloWorld">Hello World App</a>',
            'EXTERNAL_LINK_LOCALHOST_HELLO_WORLD' => '<a href="http://localhost:8080/index.php?request=HelloWorld">https://localhost:8080/index.php?request=HelloWorld</a>',
            'INSTALLED' => '<a href="index.php?request=Installation">installed</a>',
            'INSTALLING_ROADY' => '<a href="index.php?request=Installation">installing Roady</a>',
            'INSTALL_ROADY' => '<a href="index.php?request=Installation">install Roady</a>',
            'OUTPUT_COMP' => '<a href="index.php?request=OutputComponents">OutputComponent</a>',
            'OUT_PUT_COMPS' => '<a href="index.php?request=OutputComponents">OutputComponents</a>',
            'REQUEST' => '<a href="index.php?request=Requests">Request</a>',
            'RESPONSE' => '<a href="index.php?request=Responses">Response</a>',
            'RE_QUESTS' => '<a href="index.php?request=Requests">Requests</a>',
            'RE_SPONSES' => '<a href="index.php?request=Responses">Responses</a>',
            'EXTERNAL_LINK_LOCALHOST8080' => '<a href="http://localhost:8080">http://localhost:8080</a>',
            'ROADYTECH_ROOT_URL' => '<a href="/">https://roady.tech</a>',
            'EXTERNAL_LINK_ARCHWIKI_XDGOPEN' => '<a href="https://man.archlinux.org/man/xdg-open.1">xdg-open</a>',
        ];
        return str_replace(array_keys($links), $links, $output);
    }

    public static function documentationFilterCodeSnippets(string $output): string {
        return strval(
            preg_replace(
                ['/`.*`/', '/`/'],
                ['<code>\0</code>', ''],
                $output
            )
        );
    }

    public static function documentationFilterOutput(string $output): string {
        $output = self::documentationFilterLinks($output);
        $output = self::documentationFilterCodeSnippets($output);
        return <<<EOO
        <div class="documentation-output-container documentation-full-height documentation-background-black-blue-black">
            <div class="documentation-output-content-container documentation-full-height">
                $output
            </div><!-- close documentation-output-content-container -->
        </div><!-- close documentation-output-container -->
    EOO;
    }

}
