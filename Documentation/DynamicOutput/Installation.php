<?php

use Apps\Documentation\resources\php\utility\DocumentationUtility;

$output = <<<'EOO'

    <h3>Installation and setup:</h3>

        <p class="documentation-note">
            The following guide assumes the EXTERNAL_LINK_GITHUB_ROADY
            will be installed in `~/`. Please make sure to adjust the paths used in the examples
            accordingly if you choose to install the EXTERNAL_LINK_GITHUB_ROADY
            at a different location,

        </p>

    <dl>
        <dt>
            1. Move into the directory where you want to install the
               EXTERNAL_LINK_GITHUB_ROADY.
        </dt>
        <dt>For Example:</dt>
        <dd>`cd ~/`</dd>
        <dt>2. Download the EXTERNAL_LINK_GITHUB_ROADY via `git`:</dt>
        <dd>`git clone https://github.com/sevidmusic/roady.git`</dd>
        <!-- id for AddRIGToYourPATH set here on purpose so #AddRIGToYourPATH content shows up at top  -->
        <dt id="AddRIGToYourPATH">3. Move into the EXTERNAL_LINK_GITHUB_ROADY directory:<br>
        <dd>`cd ~/roady`</dd>
        <dt>4. Setup via
            <a class="documentation-link" href="https://getcomposer.org/">composer</a>:
        </dt>
        <dd>`composer update`</dd>
        <dd class="documentation-note">
            This will install the COMMAND_LINE_RIG command line utility, and
            EXTERNAL_LINK_GITHUB_RIG_APP_PKGS, a collection of APP_PACKAGES that can
            be made into EXTERNAL_LINK_GITHUB_ROADY APPS via
            `COMMAND_LINE_RIG --make-app-package`.
        </dd>
        <dd class="documentation-note">The COMMAND_LINE_RIG command line utility's executable will be located in the EXTERNAL_LINK_GITHUB_ROADY's vendor directory at `vendor/darling/rig/bin/rig`</dd>
        <dd class="documentation-note">EXTERNAL_LINK_GITHUB_RIG_APP_PKGS will be located in the EXTERNAL_LINK_GITHUB_ROADY's vendor directory at `vendor/darling/rig-app-packages/`</dd>
        <dt>
            5. Add `COMMAND_LINE_RIG`
            to your `$PATH`:
        </dt>
        <dd>`echo 'PATH="$PATH:${HOME}/roady/vendor/darling/rig/bin"' >> ~/.profile`</dd>
        <dd>`source ~/.profile`</dd>
        <dd class="documentation-important-text">
            Remember to adjust the path to
            `${HOME}/roady` accordingly if you installed the
            EXTERNAL_LINK_GITHUB_ROADY somewhere other
            than `~/`.
        </dd>
        <dd class="documentation-important-text">
            Note, in this example the `$PATH` is set in
            `.profile`. Depending on what shell you are using and how you have
            your system configured, you may need to set the
            `$PATH` in a different file, for example in
            `.bash_profile`, or
            `.zshenv`.
        </dd>
        <dd class="documentation-important-text">
            This step is very important!
            If you do not add `COMMAND_LINE_RIG` to your path and instead decide to
            run it directly from `vendor/darling/rig/bin` you will have issues.
            If the example above does not work for you for some reason,
            please search online for the steps specific to your shell
            for adding a path to your `$PATH`.
        </dd>
    </dl>

    <p>
        If everything was setup correctly, running `COMMAND_LINE_RIG --help` should show
        a help message.
    </p>

    <div>
        <h4 class="documentation-demo-gif-title">Installation &amp; Setup</h4>
        <img class="documentation-demo-gif" src="https://rigdemos.us-east-1.linodeobjects.com/InstallAndSetup.gif" alt="Installation And Setup">
    </div>

EOO;

echo DocumentationUtility::documentationFilterOutput($output);

