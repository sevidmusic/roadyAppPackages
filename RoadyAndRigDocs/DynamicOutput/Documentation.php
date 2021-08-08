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

?>

<div class="rr-docs-container">
    <div class="rr-docs-output">
        <h1>rig</h1>
        <?php
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
            /** Help File Output */
            $lines = explode(PHP_EOL, $helpFileOutput);
            foreach($lines as $key => $line) {
                $lines[$key] = trim($line);
            }
            $helpFileOutput = preg_replace(
                [
                    '#<p></p>#',
                    '#[ ]+#',
                    '#[`]#',
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
            echo PHP_EOL . $helpFileOutput . PHP_EOL;
        ?>
    </div>
</div>
