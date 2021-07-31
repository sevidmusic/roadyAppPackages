<?php

use Apps\Documentation\resources\php\utility\DocumentationUtility;

$output = <<<'EOO'

    <dl>
        <dt>`COMMAND_LINE_RIG --configure-app-output`</dt>
        <dd>
            `--for-app` `--name` `--output` `--output-source-file`
        </dd>
        <dd>
            `[--global]` `[--output-position]` `[--relative-urls]` `[--response-position]`
        </dd>
        <dd>
            `[--static]`
        </dd>
    </dl>

    <dl>

        <dt>Description:</dt>

        <dd>
            Configure output for a specified App to show up in response to specified Requests.
        </dd>
        <dd class="documentation-note">
            Note: If the specified App does not exist it will be created.
        </dd>

    </dl>

    <p>Flags:</p>

    <dl>
        <dt>`--for-app`</dt>
        <dd>The name of the App to configure the output for.</dd>
        <dt>`--name`</dt>
        <dd>
            The name used to determine the names to assign to the
            components that will be configured for the output.
        </dd>

        <dd class="documentation-important-text">
            WARNING: The specified `--name` MUST be unique. If any of the
            names that would be assigned to the one of the Components
            to be configured for the output would conflict with the
            name of an existing Component then the output will not be
            configured. This is to prevent existing Components from
            being replaced by mistake.
        <dd>

        <dt>`--output`</dt>
        <dd>
            The output to assign. This flag is required unless the
            `--output-source-file` flag is specified.
        </dd>

        <dd class="documentation-important-text">
            WARNING: This flag will be ignored if specified in
            conjunction with the `--output-source-file` flag.
        </dd>

        <dt>`--output-source-file`</dt>
        <dd>
            The path to the file whose contents will be assigned as the
            output. This flag is requried unless the `--output` flag is
            specified.
        </dd>

        <dd class="documentation-important-text">
            WARNING: If both the `--output` and `--output-source-file`
            flags are specified the `--output-source-file`'s contents
            will be assigned as the output, and the --output flag will
            be ignored.
        </dd>

        <dt>`[--global]`</dt>
        <dd>
            If specifed, the output will served in response to all
            Requests to any domain the App is built for. This causes
            COMMAND_LINE_RIG to configure a
            GlobalResponse to serve the output instead of a Response.
        </dd>

        <dt>`[--output-position]`</dt>
        <dd>
            The position to assign to the DynamicOutputComponent or
            OutputComponent that will be configured for the output.
            This position will be used to sort the output relative to
            other output that is being served by the same Response
            or GlobalResponse.
        </dd>

        <dt>`[--relative-urls]`</dt>
        <dd>
            The relative urls the output should be served in response
            to. Thes urls are defined relative to a domain.
        </dd>

        <dd>
            For example, to configure the output to show up in response
            to requests to the domain's root, the relative url `/`
            could be specified.
        </dd>

        <dd>
            Another example, to configure the output to be served in
            response to a request named "Homepage" the relative url
            `?request=Homepage` or `index.php?request=Homepage` could
            be defined.
        </dd>

        <dt>`[--response-position]`</dt>
        <dd>
            The position to assign to the Response or GlobalResponse
            that will be configured for the output. This position is
            used to sort the Response or GlobalResponse configured for
            the output relative to other Responses and GlobalResponses
            that respond to the same Request.
        </dd>

        <dt>`[--static]`</dt>

        <dd>
            If specified, an OutputComponent will be configured for the
            output instead of a DynamicOutputComponent.
        </dd>

        <dd>
            This means the output will be defined in a OutputComponent
            configuration file in the App's OutputComponents directory
            instead of in a file in the App's DynamicOutput directory.
        </dd>
    </dl>

    <dl>

        <dt>Examples:</dt>

        <dd>`COMMAND_LINE_RIG --configure-app-output \`</dd>
        <dd>`--for-app Foo \`</dd>
        <dd>`--name Bar \`</dd>
        <dd>`--output '&lt;p&gt;Hello Universe&lt;/p&gt;' \`</dd>
        <dd>`--relative-urls './' 'index.php' 'index.php?request=BarBaz' \`</dd>
        <dd>`--static`</dd>

        <dd>`COMMAND_LINE_RIG --configure-app-output \`</dd>
        <dd>`--for-app Foo \`</dd>
        <dd>`--name Bar \`</dd>
        <dd>`--output-source-file /path/to/output/source/file \`</dd>
        <dd>`--global`</dd>

    </dl>

EOO;

echo DocumentationUtility::documentationFilterOutput($output);

