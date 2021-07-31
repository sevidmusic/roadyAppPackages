<?php

use Apps\Documentation\resources\php\utility\DocumentationUtility;

$output = <<<'EOO'

    <h3>Getting Started</h3>

    <p>
        The first step is to INSTALL_ROADY.
    </p>

    <p>
        Once INSTALLED, it is very important to make sure the `COMMAND_LINE_RIG` command line
        utility is in your `$PATH`.
    </p>

    <p>
        `COMMAND_LINE_RIG` will be used frequently to create and manage EXTERNAL_LINK_GITHUB_ROADY
        APPS, and also for other development tasks.
    </p>

    <p>
        EXTERNAL_LINK_GITHUB_ROADY is designed around the idea of APPS.
    </p>
    <p>
        APPS implement niche features, or related sets of features, that can be made available
        to one or more websites running on the same EXTERNAL_LINK_GITHUB_ROADY installation.
    </p>

    <p>
        APPS define the source code, and provide the resources, necessary to implement
        one or more related features.
    </p>

    <p>
        This may come in the form of
        `.php` files,
        `.css` files,
        `.js` files,
        `.html` files,
        `image` files,
        `audio` files, etc.
    </p>
    <div id="HelloWorld"></div><!-- set here a bit above HelloWorld content on purpose so <h1> is at top -->
    <p>
        Whatever is needed to implement the feature, or related set of features, is provided
        by the A_P_P.
    </p>

    <h2>Hello World</h2>

    <p>
        The following example demonstrates how to create a HELLO_WORLD_APP for the EXTERNAL_LINK_GITHUB_ROADY.
    </p>

    <p>
        In the example, the `COMMAND_LINE_RIG` command line utility is used to
        configure the output
        `'&lt;h1&gt;Hello World&lt;/h1&gt;'`
        for an app named `HelloWorld` so it is available to any website the
        `HelloWorld` A_P_P is built
        for at the relative urls `index.php?request=HelloWorld` and
        `/`:
    </p>

    <p class="documentation-note">
        Note: The example assumes the EXTERNAL_LINK_GITHUB_ROADY is
        already INSTALLED and that `COMMAND_LINE_RIG` is in your
        `$PATH`.
    </p>

    <dl>
        <dt>
            1. Move into the EXTERNAL_LINK_GITHUB_ROADY's directory.
        </dt>
        <dd>`cd /path/to/roady`</dd>
        <dt>
            2. Configure the output via `rig --configure-app-output`:
        </dt>
        <dd>
            `rig --configure-app-output --name HelloWorld --output '&lt;h1&gt;Hello World&lt;/h1&gt;' --for-app HelloWorld --relative-urls '/'`
        </dd>
        <dt>
            3. Build the A_P_P for the domain `EXTERNAL_LINK_LOCALHOST8080` by executing it's
            `Components.php` file
            via `php`:
        </dt>
        <dd>`php ./APPS/HelloWorld/Components.php`</dd>
        <dt>
            4. Start a local development server at
            `EXTERNAL_LINK_LOCALHOST8080` via
            `rig --start-server`:
        </dt>
        <dd>`rig --start-server`</dd>
        <dt>5. Open `EXTERNAL_LINK_LOCALHOST8080` in a web browser.</dt>
        <dd id="HelloWorldDemo">The `HelloWorld` app should now be available to EXTERNAL_LINK_LOCALHOST8080</dd>
    </dl>

    <p class="documentation-note">
        A detailed <a href="index.php?request=GettingStarted#HelloWorldOverview">overview</a>
        of steps performed to build the `HelloWorld` App can be found
        <a href="index.php?request=GettingStarted#HelloWorldOverview">below</a>.
    </p>

    <div>
        <h4 class="documentation-demo-gif-title">Hello World Demo</h4>
        <img
            id="HelloWorldOverview"
            class="documentation-demo-gif"
            src="https://rigdemos.us-east-1.linodeobjects.com/HelloWorld_Take1.gif"
            alt="Hello World Demo"
            style="max-width:100%;"
        >
    </div>

    <h2>Overview</h2>

    <h5>`rig --configure-app-output --name HelloWorld --output '&lt;h1&gt;Hello World&lt;/h1&gt;' --for-app HelloWorld --relative-urls '/'`</h5>

    <dl>
        <dt>
            1. Create the `HelloWorld` A_P_P in the EXTERNAL_LINK_GITHUB_ROADY's
               `APPS` directory if it does not already exist at:
        </dt>
        <dd>
               `roady/APPS/HelloWorld`
        </dd>
        <dt>
            2. Create a file named `HelloWorld.php` whose contents is
               `'&lt;h1&gt;Hello World&lt;/h1&gt;'` in the
               `HelloWorld` A_P_P's
               `DynamicOutput` directory at:
        </dt>
        <dd>
            `roady/APPS/HelloWorld/DynamicOutput/HelloWorld.php`
        </dd>
        <dd class="documentation-note">
            This file is responsible for generating the `'&lt;h1&gt;Hello World&lt;/h1&gt;'`
            output, and can be modified later if the output needs to be changed.
        </dd>
        <dt>
            3. Configure a DYNAMIC_OUTPUT_COMP named `HelloWorld` in a configuration file
               named `HelloWorld.php` at:
        </dt>
        <dd>
            `roady/APPS/HelloWorld/OutputComponents/HelloWorld.php`
        </dd>
        <dt>

            4. Configure a REQUEST named `HelloWorld` in a configuration file
               named `HelloWorld.php` whose assigned relative url is
               `index.php?request=HelloWorld` at:
        </dt>
        <dd>
               `roady/APPS/HelloWorld/RE_QUESTS/HelloWorld.php`
        </dd>
        <dd class="documentation-note">
            Note: `rig --configure-app-output` will always configure at least one REQUEST
            for the output whose assigned relative url is:
            <br>
            `index.php?request={--name}`
        </dd>
        <dt>
            5. Configure a REQUEST named `HelloWorld0` in a configuration file
               named `HelloWorld0.php` whose assigned relative url is
               `/` at:
        </dt>
        <dd>
               `roady/APPS/HelloWorld/RE_QUESTS/HelloWorld0.php`
        </dd>
        <dd class="documentation-note">
            Note: `rig --configure-app-output` will configure a REQUEST for each of
            the specified `--relative-urls`. The name assigned to each REQUEST will
            be the specified `--name` followed by an incrementing integer. In this example
            only one `--relative-url` is specified, so a REQUEST named
            `HelloWorld0` will be configured. If additional
            `--relative-urls` had been specified, their names would have been
            `HelloWorld1`,
            `HelloWorld2`,
            `HelloWorld3`, and so on.
        </dd>
        <dt>
            6. Configure a RESPONSE named `HelloWorld` in a configuration file
               named `HelloWorld.php` at:
        </dt>
        <dd>
               `roady/APPS/HelloWorld/RE_SPONSES/HelloWorld.php`
        </dd>
        <dt>
            7. Assign the `HelloWorld` DYNAMIC_OUTPUT_COMP,
               `HelloWorld` REQUEST,
               and `HelloWorld0` REQUEST
               to the `HelloWorld` RESPONSE.
        </dt>
        <dd class="documentation-note">
               This will make the `'&lt;h1&gt;Hello World&lt;/h1&gt;'` output
               available in RESPONSE to RE_QUESTS to the relative urls assigned
               to the `HelloWorld` and
               `HelloWorld0` RE_QUESTS.
               <br>
               For example, in this example the `HelloWorld` A_P_P is built for the domain
               `EXTERNAL_LINK_LOCALHOST8080`, so the
               `'&lt;h1&gt;Hello World&lt;/h1&gt;'` output will be
               available at the following urls:
               <br>
               `EXTERNAL_LINK_LOCALHOST_HELLO_WORLD`
               <br>
               `EXTERNAL_LINK_LOCALHOST8080/`
        </dd>
    </dl>

    <h5>`php ./APPS/HelloWorld/Components.php`</h5>

    <dl>
        <dt>
            This will build the A_P_P for the domain `EXTERNAL_LINK_LOCALHOST8080` by
            executing the `HelloWorld` A_P_P's
            `Components.php`.
        </dt>
        <dd class="documentation-note">Building the A_P_P will make any of the output it configures
            available to the domain the A_P_P was built for at the appropriate
            relative urls.
            <br>
            Since the `HelloWorld` A_P_P was built for
            `EXTERNAL_LINK_LOCALHOST8080`, and configures two
            RE_QUESTS for the output to show up in RESPONSE
            to, the `'&lt;h1&gt;Hello World&lt;/h1&gt;'` output
            will be available in RESPONSE to RE_QUESTS to the
            following urls:
            <br>
            `EXTERNAL_LINK_LOCALHOST_HELLO_WORLD`
            <br>
            `EXTERNAL_LINK_LOCALHOST8080/`
        </dd>
        <dd class="documentation-note">
            The domain `EXTERNAL_LINK_LOCALHOST8080` is the default domain used when a domain is not
            passed to an A_P_P's `Components.php`. To build the A_P_P for an alternative
            domain simply specify it as the only argument to the A_P_P's `Components.php`
            as follows:<br>
            `php /path/to/roady/APPS/APPNAME/Components.php 'https://desiredDomain.com'`
        </dd>
        <dd class="documentation-important-text">Do not include a trailing `/` at the end of the domain you specify or the A_P_P will fail to build properly.</dd>
    </dl>

    <h5>`rig --start-server`</h5>

    <dl>
        <dt>This will start a local development server at `EXTERNAL_LINK_LOCALHOST8080`</dt>
        <dd>
            `rig --start-server` will start PHP's built in web server, which can
            be used for local development.
        <dd>
            In this example the `HelloWorld` A_P_P configured output for two
            `--relative-urls`,
            one for `index.php?request=HelloWorld`, and
            one for `/`, and the `HelloWorld` A_P_P was built for the domain
            `EXTERNAL_LINK_LOCALHOST8080`.
        </dd>
        <dd>
            So starting PHP's built in web server on `EXTERNAL_LINK_LOCALHOST8080` will
            make the output configured for the `HelloWorld` app available locally at
            the following urls:
            <br>
            `EXTERNAL_LINK_LOCALHOST_HELLO_WORLD`
            <br>
            `EXTERNAL_LINK_LOCALHOST8080`
        </dd>
        <dd class="documentation-note">
            More information is available about PHP's built in web server on
            <a class="documentation-link" href="https://www.php.net/manual/en/features.commandline.webserver.php">php.net</a>
        </dd>
        <dd class="documentation-note">
            Note: `rig --start-server` also accepts a
            `--open-in-browser` flag which will
            cause `rig` to attempt to open the appropriate url in a browser. For instance
            in this example `rig --start-server --open-in-browser` could be used to both
            start a development server on `EXTERNAL_LINK_LOCALHOST8080`, and also open
            `EXTERNAL_LINK_LOCALHOST8080` in your default browser.
        <dd class="documentation-important-text">
            The `--open-in-browser` flag
            uses `EXTERNAL_LINK_ARCHWIKI_XDGOPEN` under the hood, so if your not on Linux, or do not have
            `EXTERNAL_LINK_ARCHWIKI_XDGOPEN`
            installed, the `--open-in-browser` flag will not work.
        </dd>
        <dd class="documentation-note">
            `rig --start-server` also accepts a
            `--port` flag which can be used
            to start a development server on a port other than `8080`. For example,
            to build the `HelloWorld` App locally on port
            `8420` instead of
            `8080`:
            <br>
            `php /path/to/roady/Apps/HelloWorld/Components.php 'http://localhost:8420'`
            <br>
            `rig --start-server --port 8420 --open-in-browser`
        </dd>
    </dl>

EOO;

echo DocumentationUtility::documentationFilterOutput($output);

