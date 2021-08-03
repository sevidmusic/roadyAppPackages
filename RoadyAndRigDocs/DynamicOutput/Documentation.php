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
            $pathClass = 'rr-docs-file-path';
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
                    # Match similar to [--flag] [--flag] [--flag]
                    '/\[.*]/',
                    # Match paths (./path/.../word OR /path/.../word)
                    '#((\.\/)\w+/).*(\w+/)(\w+.*[.]\w+)|((\/)\w+/).*(\w+/)(\w+)|((\.\/)\w+/).*(\w+/)(\w+)#',
                    # Match --word... word \
                    '/((--)\w+).*[ ](\w+)[ ][\\\]/',
                    # Match rig --word...<
                    '/rig --.*</',
                    # Match --word... word<
                    '/((--)\w+).*[ ](\w+)</',
                    # Match export PATH=&quot;${PATH}:${HOME}<code class="rr-docs-file-path">
                    '/export PATH=&quot;\${PATH}:\${HOME}<code class="rr-docs-file-path">/',
                    # Match bin</code>&quot;
                    '/bin<\/code>&quot;/',
                    # Match ~/word
                    '/~\/(\w+)/',
                    # Match $PATH (with one space on each side)
                    '/[ ]\$PATH[ ]/',
                    # Match rig  <code class="rr-docs-code">
                    '/rig  <code class="rr-docs-code">/',
                ],
                [
                    # Match similar to [--flag] [--flag] [--flag]
                    '<code class="' . $codeClass . '">${0}</code>',
                    # Match paths (./path/.../word OR /path/.../word)
                    '<code class="' . $pathClass . '">${0}</code>',
                    # Match --flag... word \
                    '<code class="' . $codeClass . '">${0}</code>',
                    # Match --word... word<
                    '<code class="' . $codeClass . '">${0}/code><',
                    # Match rig --flag ...word<
                    '<code class="' . $codeClass . '">${0}/code><',
                    # Match export PATH=&quot;${PATH}:${HOME}<code class="rr-docs-file-path">
                    '<code class="' . $codeClass . '">export PATH=&quot;${PATH}:${HOME}',
                    # Match bin</code>&quot;
                    'bin&quot;</code>',
                    # Match ~/word
                    '<code class="' . $pathClass . '">${0}</code>',
                    # Match $PATH (with one space on each side)
                    '<code class="' . $codeClass . '">$PATH</code>',
                    # Match rig  <code class="rr-docs-code">
                    '<code class="rr-docs-code">rig ',
                ],
                $output
            );
        ?>
    </div>
</div>
