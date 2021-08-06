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
        <?php
            /** vars */
            $cssClasses = [
                'codeClass' => 'rr-docs-code',
                'pathClass' => 'rr-docs-file-path',
            ];
            /** Menu  */
            $menuLinks = [];
            foreach($helpFilesListing as $listing) {
                array_push(
                    $menuLinks,
                    '<a href="?request=' . str_replace('.txt', '', $listing) .
                    '">' . $listing . '</a>'
                );
            }
            /** Help File Output */
            $lines = explode(PHP_EOL, $helpFileOutput);
            foreach($lines as $key => $line) {
                $lines[$key] = '<p>' . trim($line) . '</p>';
            }
            $helpFileOutput = preg_replace(
                [
                    '#<p></p>#',
                    '#[ ]+#',
                    '#(((--)|(\[--)|(rig --)|(rig \[--))(.*)((])|(-(\w+))|([ ]\\\\))|(--\w+))#',
                ],
                [
                    '',
                    ' ',
                    '<code class="' .  ($cssClasses['codeClass'] ?? '') . '">${0}</code>',
                ],
                implode(PHP_EOL, $lines)
            );
            echo PHP_EOL . str_repeat(' ', 8) . '<div class="rr-docs-rig-menu">' .
                implode(PHP_EOL . str_repeat(' ', 16), $menuLinks) .
                PHP_EOL . str_repeat(' ', 8) . '</div>' . str_repeat(PHP_EOL, 2) .
                $helpFileOutput . PHP_EOL;
        ?>
    </div>
</div>
