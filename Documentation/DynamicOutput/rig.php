<?php

use Apps\Documentation\resources\php\utility\DocumentationUtility;

$output = <<<'EOO'

    <dl>
        <dt>EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY</dt>
        <dd>`[--assign-to-response] [--configure-app-output] [--EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY-apps-directory-path]`</dd>
        <dd>`[--debug] [--help] [--make-app-package] [--new-app-package] [--new-app]`</dd>
        <dd>`[--new-dynamic-output-component] [--new-global-response]`</dd>
        <dd>`[--new-output-component] [--new-request] [--start-server]`</dd>
        <dd>`[--view-active-servers]`</dd>
    </dl>

    <dl>
        <dt>Description:</dt>
        <dd>
            EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY is a command line utility designed to aide in the development process
            with Roady. EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY provides a number of flags
            that can be used to perform common development tasks.
        </dd>
    </dl>

    <p>Flags:</p>


    <dl>
        <dt>`[--assign-to-response]`</dt>
        <dd>
            Assign one or more Requests, OutputComponents,
            or DynamicOutputComponents to an existing
            Response or GlobalResponse for an existing
            Roady App.

        </dd>
        <dt>`[--configure-app-output]`</dt>
        <dd>
            Configure output for a specified App to
            show up in response to specified Requests.
            Note: If the specified App does not exist
            it will be created.
        </dd>
        <dt>`[--EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY-apps-directory-path]`</dt>
        <dd>
            The path to Roady Apps
            directory, or an alternative directory.
        </dd>
        <dd>
        If not specified, EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY will attempt to locate
        the Apps directory, if it cannot find it EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY
        will set --EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY-apps-directory-path to the
        path to EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY's tmp directory.
        </dd>
        <dd>
            EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY will look for the Apps directory at
            the following path relative to EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY's root
            directory for an Apps directory:
        </dd>
        <dd>
            `../../../Apps`
        </dd>
        <dd>
            Defaults to EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY's tmp directory's path:
        </dd>
        <dd>
            `/path/to/EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY/tmp`
        </dd>
        <dt>`[--debug]`</dt>
        <dd>
            Show debug information for the current call
            to EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY. This flag is intended to be used in
            conjunction with other flags, not alone.
        </dd>
        <dd>
            The following arguments can be specified to
            control what debug information is shown, at
            least one is expected.
        </dd>
        <dd>
            `flags` :   This will cause EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY to output
            the `flags` passed to EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY and
            their arguments.
        </dd>
        <dd>
            `options` : This will cause EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY to output
            any `options` passed to EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY,
            i.e, the arguments that were
            specified that are not
            associated with a flag.
        </dd>
        <dd>
            Note: The `options` argument is
            provided for future use, at the
            moment EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY does not accept any
            options, only flags and flag
            arguments.

        </dd>
        <dt>`[--help] [FLAG]`</dt>
        <dd>
            Show this help message, or the appropriate
            help message for the specified FLAG.
        </dd>

        <dt>`[--make-app-package]`</dt>
        <dd>
            Make an App Package into a Roady
             App.
        </dd>
        <dt>`[--new-app-package]`</dt>
        <dd>
            Create a new app package.
        </dd>
        <dt>`[--new-app]`</dt>
        <dd>
            Create a new Roady
            App.
        </dd>
        <dt>`[--new-dynamic-output-component]`</dt>
        <dd>
            Create a new DynamicOutputComponent for a
            Roady App.
        </dd>
        <dt>`[--new-global-response]`</dt>
        <dd>
            Create a new GlobalResponse for a Roady
             App.
        </dd>
        <dt>`[--new-output-component]`</dt>
        <dd>
            Create a new OutputComponent for a Roady
             App.
        </dd>
        <dt>`[--new-request]`</dt>
        <dd>
            Create a new Request for a Roady
             App.
        </dd>
        <dt>`[--start-server]`</dt>
        <dd>
            Start a development server.
        </dd>
        <dt>`[--view-active-servers]`</dt>
        <dd>
            Show active development servers.
        </dd>
<dl>


<dl>
    <dt>Notes:</dt>

    <dd>
        To get more detailed information about a specific flag use the --help flag
        and specify one of the available flags.
    </dd>

    <dt>For example:</dt>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --assign-to-response`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --configure-app-output`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY-apps-directory-path`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --debug`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --help`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --make-app-package`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --new-app-package`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --new-app`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --new-dynamic-output-component`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --new-global-response`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --new-output-component`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --new-request`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --start-server`</dd>
    <dd>`EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY --help --view-active-servers`</dd>

    <dt>Documentation for EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY and Roady can be found at:</dt>

    <dd><a href="https://roady.tech">https://roady.tech</a></dd>

    <dt>EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY is on GitHub:</dt>

    <dd><a href="https://github.com/sevidmusic/EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY">https://github.com/sevidmusic/EXTERNAL_LINK_GITHUB_RIG_COMMAND_LINE_UTILITY</a></dd>

    <dt>Roady is on GitHub:</dt>

    <dd><a href="https://github.com/sevidmusic/roady">https://github.com/sevidmusic/roady</a></dd>

EOO;

echo DocumentationUtility::documentationFilterOutput($output);

