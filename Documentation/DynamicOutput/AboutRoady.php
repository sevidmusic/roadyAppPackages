<?php

use Apps\Documentation\resources\php\utility\DocumentationUtility;

$output = <<<'EOO'

    <p>
        EXTERNAL_LINK_GITHUB_ROADY is a tool designed to aide in the
        development of websites.
    </p>

    <p>
        Its design allows the features of a website to be implemented as
        smaller niche applications called APPS.
    </p>

    <p>
        EXTERNAL_LINK_GITHUB_ROADY APPS are responsible for implementing one or
        more related features.
    </p>

    <p>
        The features of an App can be made available to multiple websites running on
        a single installation of the EXTERNAL_LINK_GITHUB_ROADY.
    </p>

    <p>
        APPS can configure output to show up in response to appropriate requests to
        a website, and can also provide stylesheets, scripts, and other resources
        necessary to implement the specific features they provide.
    </p>

    <p>
        The following is a quick demo of INSTALLING_ROADY
        and creating a HELLO_WORLD_APP.
    </p>

    <div>
        <h4 class="documentation-demo-gif-title">Installaton &amp; Hello World</h4>
        <img class="documentation-demo-gif" src="https://rigdemos.us-east-1.linodeobjects.com/InstallSetupAndHelloWorld.gif" alt="HelloWorldDemo">
    </div>

    <p>
        To GET_STARTED developing with the
        EXTERNAL_LINK_GITHUB_ROADY, INSTALL_ROADY,
        and then visit the GETTING_STARTED documentation.
    </p>

EOO;

echo DocumentationUtility::documentationFilterOutput($output);

