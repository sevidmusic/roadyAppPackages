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
                ],
                [
                    '',
                    ' ',
                    '',
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '">${0}</code>',
                    '<code class="' .  ($cssClasses['specialCharClass'] ?? '') . '">${0}</code>',
                    '<code class="' .  ($cssClasses['varClass'] ?? '') . '">${0}</code>',
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '">${0}</code>',
                    '<code class="' .  ($cssClasses['varClass'] ?? '') . '">${0}</code>',
                    '<code class="' .  ($cssClasses['pathClass'] ?? '') . '">${0}</code>',
                    '<code class="' .  ($cssClasses['pathClass'] ?? '') . '">${0}</code>',
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '"><a href="index.php?request=help">${0}</a></code>',
                    '<span class="' .  ($cssClasses['warningClass'] ?? '') . '">${0}</span>',
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '">${0}</code>',
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '">${0}</code>',
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '">${0}</code>',
                ],
                implode(PHP_EOL, $lines)
            );
            echo PHP_EOL . $helpFileOutput . PHP_EOL;
        ?>
    </div>
</div>
