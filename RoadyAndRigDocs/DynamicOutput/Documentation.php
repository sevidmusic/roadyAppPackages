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

$output = htmlspecialchars(
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
            $codeClass = 'rr-docs-code';
            $lines = explode(PHP_EOL, $output);
            foreach($lines as $key => $line) {
                $lines[$key] = '<p>' . trim($line) . '</p>';
            }
            $output = str_replace('<p></p>', '',implode(PHP_EOL, $lines));
            foreach($helpFilesListing as $listing) {
                echo '<div><a href="?request=' . str_replace('.txt', '', $listing) . '">' . $listing . '</a></div>';
            }
            echo preg_replace(
                [
                    '/\[.*]/m', # Match similar to [--flag] [--flag] [--flag]
                    '#((\.\/)\w+/).*(\w+/)(\w+.*[.]\w+)|((\/)\w+/).*(\w+/)(\w+)|((\.\/)\w+/).*(\w+/)(\w+)#',
                    '/((--)\w+).*[ ](\w+)[ ][\\\]/m',
                    '/rig --.*</m',
                    '/export PATH=&quot;\${PATH}:\${HOME}<code class="rr-docs-file-path">/',
                    '/bin<\/code>&quot;/',
                    '/~\/(\w+)/',
                    '/[ ]\$PATH[ ]/',
                    '/rig  <code class="rr-docs-code">/',
                ],
                [
                    '<code class="' . $codeClass . '">${0}</code>',
                    '<code class="rr-docs-file-path">${0}</code>',
                    '<code class="' . $codeClass . '">${0}</code>',
                    '<code class="' . $codeClass . '">${0}/code><',
                    '<code class="rr-docs-file-path">export PATH=&quot;${PATH}:${HOME}',
                    'bin&quot;</code>',
                    '<code class="' . $codeClass . '">${0}</code>',
                    '<code class="' . $codeClass . '">$PATH</code>',
                    '<code class="rr-docs-code">rig ',
                ],
                $output
            );
        ?>
    </div>
</div>
