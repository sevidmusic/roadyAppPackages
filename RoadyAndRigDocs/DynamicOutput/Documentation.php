<?php

use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

$currentRequest = new Request(
    new Storable('CurrentRequest', 'tmp', 'Documentation'),
    new Switchable()
);

$roadyRootDirectoryPath = str_replace(
    'Apps' . DIRECTORY_SEPARATOR .
    'RoadyAndRigDocs' . DIRECTORY_SEPARATOR .
    basename(__DIR__),
    '',
    __DIR__
);

$rigHelpFilesDirectoryPath = strval(
    realpath(
        $roadyRootDirectoryPath . DIRECTORY_SEPARATOR . 'vendor' .
        DIRECTORY_SEPARATOR . 'darling' . DIRECTORY_SEPARATOR . 'rig' .
        DIRECTORY_SEPARATOR . 'helpFiles'
    )
);

$helpFilesListing = array_diff(
    scandir($rigHelpFilesDirectoryPath),
    ['.', '..']
);

$helpFileOutput = htmlspecialchars(
    strval(
        file_get_contents(
            $rigHelpFilesDirectoryPath . DIRECTORY_SEPARATOR .
            ($currentRequest->getGet()['request'] ?? 'help') . '.txt'
        )
    )
);

/** vars */
$cssClasses = [
    'codeClass' => 'rr-docs-code',
    'pathClass' => 'rr-docs-file-path',
    'specialCharClass' => 'rr-docs-special-char',
    'varClass' => 'rr-docs-var',
    'warningClass' => 'rr-docs-warning',
    'multiLineCodeClass' => 'rr-docs-multi-line-code-line',
    'codeIndent1Class' => 'rr-docs-multi-line-code-line-indent1',
    'codeIndent2Class' => 'rr-docs-multi-line-code-line-indent2',
];

?>

<div class="rr-docs-container">
    <div class="rr-docs-output">
        <?php
            if(($currentRequest->getGet()['request'] ?? '') !== 'README') {
                echo '<h1>rig</h1>';
            }
            /** Help File Output */
            $lines = explode(PHP_EOL, $helpFileOutput);
            foreach($lines as $key => $line) {
                if(!str_contains($line, 'http')) {
                    $lines[$key] = preg_replace(
                        '#((/|~/|../|./)[a-zA-Z0-9_.-]+)+[a-zA-Z0-9/]#',
                        '<code class="' . ($cssClasses['pathClass'] ?? '') . '">${0}</code>',
                        trim($line)
                    );
                    continue;
                }
                $lines[$key] = trim($line);
            }
            $helpFileOutput = preg_replace(
                [
                    '#<p></p>#',
                    '#[ ]+#',
                    '#[`]#',
                    '#http(s?):/(/[a-zA-Z0-9_.-:]+)+[a-zA-Z0-9/]#',
                    '#((--)(\w+)[a-z\-]*)#',
                    '#([[]|[]])#',
                    '#(([Ff]oo)|([Bb]ar)|([Bb]azzer)|([Bb]az))#',
                    '#\\\\#',
                    "#[ ]['](.*)['][ ]#",
                    '#export(.*)&quot;#',
                    '#\$PATH#',
                    '#([ ]rig|rig)[ ]#',
                    '#WARNING:#',
                    '#[ ](\w+-)(.*)(-\w+)|[ ](\w+-\w+)#',
                    '#[ ](debug)|(FLAG)#',
                    '#(\#!/bin/bash)|(set -o posix)#',
                    '#^&lt;\?php$#m',
                    '#^\);$#m',
                    '#(^use roady.*$)|(^\);)|(^\$\w+.*build.*\($)#m',
                    '#(^\w+::class.*$)|(^\'.*(\',|\')$)|(^\),$)|(^\$\w+.*(read|getLocation).*(\(\),|\()$)|(^([0-9]|[0-9][.][0-9]),$)|(^[0-9]$)|(^\',$)|(^\'.*Hello World.*$)|(^\$\w+.*getApp.*,$)#m',
                    '#^[a-zA-Z].*$#m',
                ],
                [
                    '', # '#<p></p>#',
                    ' ', # '#[ ]+#',
                    '', # '#[`]#',
                    '<a href="${0}">${0}</a>', # #http(s?):/(/[a-zA-Z0-9_.-]+)+#
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '">${0}</code>', # '#((--)(\w+)[a-z\-]*)#',
                    '<code class="' .  ($cssClasses['specialCharClass'] ?? '') . '">${0}</code>', # '#([[]|[]])#',
                    '<code class="' .  ($cssClasses['varClass'] ?? '') . '">${0}</code>', # '#(([Ff]oo)|([Bb]ar)|([Bb]azzer)|([Bb]az))#',
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '">${0}</code>', # '#\\\\#',
                    '<code class="' .  ($cssClasses['varClass'] ?? '') . '">${0}</code>', # "#[ ]['](.*)['][ ]#",
                    '<code class="' .  ($cssClasses['pathClass'] ?? '') . '">${0}</code>', # '#export(.*)&quot;#',
                    '<code class="' .  ($cssClasses['pathClass'] ?? '') . '">${0}</code>', # '#\$PATH#',
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '"><a href="index.php?request=help">${0}</a></code>', # '#([ ]rig|rig)[ ]#',
                    '<span class="' .  ($cssClasses['warningClass'] ?? '') . '">${0}</span>', # '#WARNING:#',
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '">${0}</code>', # '#[ ](\w+-)(.*)(-\w+)|[ ](\w+-\w+)#',
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '">${0}</code>', # '#[ ](debug)|(FLAG)#',
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '">${0}</code>', # '#(\#!/bin/bash)|(set -o posix)#',
                    '<pre><code class="' .  ($cssClasses['codeClass'] ?? '') . '">${0}', # '#^&lt;\?php$#m',
                    '${0}</code></pre>', # '#^\);$#m',
                    '<span class="' .  ($cssClasses['codeIndent1Class'] ?? '') . '">${0} </span>', # '#(^use roady.*$)|(^\);)|(^\$\w+.*build.*\($)#m',
                    '<span class="' .  ($cssClasses['codeIndent2Class'] ?? '') . '">${0}</span>', # '#(^\w+::class.*$)|(^\'.*(\',|\')$)|(^\),$)|(^\$\w+.*(read|getLocation).*(\(\),|\()$)|(^([0-9]|[0-9][.][0-9]),$)#m',
                    '<p>${0}</p>', # '#^[a-zA-Z].*$#m',
                ],
                implode(PHP_EOL, $lines)
            );
                    echo PHP_EOL . str_replace(
                        [
                            '--assign-to-response',
                            '--configure-app-output',
                            '--path-to-apps-directory',
                            '--debug',
                            '--help',
                            '--make-app-package',
                            '--new-dynamic-output-component',
                            '--new-global-response',
                            '--new-output-component',
                            '--new-request',
                            '--new-response',
                            '--start-server',
                            '--view-active-servers',
#                            '--new-app-package',# (help file is not defined yet)
                            '--new-app',
                            '<code class="rr-docs-code"><a href="index.php?request=help">rig </a></code>',
                            '>\</code>',
                        ],
                        [
                            '<a href="index.php?request=assign-to-response">--assign-to-response</a>',
                            '<a href="index.php?request=configure-app-output">--configure-app-output</a>',
                            '<a href="index.php?request=path-to-apps-directory">--path-to-apps-directory</a>',
                            '<a href="index.php?request=debug">--debug</a>',
                            '<a href="index.php?request=help">--help</a>',
                            '<a href="index.php?request=make-app-package">--make-app-package</a>',
                            '<a href="index.php?request=new-dynamic-output-component">--new-dynamic-output-component</a>',
                            '<a href="index.php?request=new-global-response">--new-global-response</a>',
                            '<a href="index.php?request=new-output-component">--new-output-component</a>',
                            '<a href="index.php?request=new-request">--new-request</a>',
                            '<a href="index.php?request=new-response">--new-response</a>',
                            '<a href="index.php?request=start-server">--start-server</a>',
                            '<a href="index.php?request=view-active-servers">--view-active-servers</a>',
#                            '<a href="index.php?request=new-app-package">--new-app-package</a>',
                            '<a href="index.php?request=new-app">--new-app</a>',
                            '<br><code class="rr-docs-code"><a href="index.php?request=help">rig </a></code>',
                            '>\</code><br>',
                        ],
                        $helpFileOutput
                    ) . PHP_EOL;
        ?>
    </div>
</div>
