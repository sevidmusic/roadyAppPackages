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

if(($currentRequest->getGet()['request'] ?? '') === 'rig') {
    $helpFileOutput = htmlspecialchars(
        strval(
            file_get_contents(
                $rigHelpFilesDirectoryPath . DIRECTORY_SEPARATOR .
                'help.txt'
            )
        )
    );
} else {
    $helpFileOutput = htmlspecialchars(
        strval(
            file_get_contents(
                $rigHelpFilesDirectoryPath . DIRECTORY_SEPARATOR .
                ($currentRequest->getGet()['request'] ?? 'roady') . '.txt'
            )
        )
    );
}


/** vars */
$cssClasses = [
    'codeClass' => 'rr-docs-code',
    'pathClass' => 'rr-docs-file-path',
    'specialCharClass' => 'rr-docs-special-char',
    'varClass' => 'rr-docs-var',
    'warningClass' => 'rr-docs-warning',
    'noteClass' => 'rr-docs-note',
    'multiLineCodeClass' => 'rr-docs-multi-line-code-line',
    'codeIndent1Class' => 'rr-docs-multi-line-code-line-indent1',
    'codeIndent2Class' => 'rr-docs-multi-line-code-line-indent2',
];

/** Help File Output */
$lines = explode(PHP_EOL, $helpFileOutput);
foreach($lines as $key => $line) {
    $lines[$key] = trim($line);
}
$output = preg_replace(
    [
        /** Match within ``` and ``` */
        '#`{3}(\s?)([^`]+)(\s?)`{3}#',
        /** Match occurences of ``` */
        '#`{3}#',
        /** Match within ` and ` */
        '#`{1}(\s?)([^`]+)(\s?)`{1}#',
        /** Match occurences of ` */
        '#`{1}#',
        /** Match links */
        '#http(s?):/(/[a-zA-Z0-9_.:?=-]+)+[a-zA-Z0-9/]#',
        /** Match ~~~~~ for replacement */
        '#~{5}#',
        /** Match ~~~~~ for removal */
        '#~{5}#',
        /** Match ~~~ for replacement */
        '#~{3}#',
        /** Match ~~~ for removal */
        '#~{3}#',
    ],
    [
        /** Replace within ``` and ``` */
        '<pre>${0}</pre>',
        /** Remove occurences of ``` */
        '',
        /** Replace within ` and ` */
        '<code class="rr-docs-code">${0}</code>',
        /** Remove occurences of ` */
        '',
        /** Replace links with <a href="${0}">${0}</a> */
        '<a href="${0}">${0}</a>',
        /** Replace ~~~~~ */
        PHP_EOL . '</div>' . PHP_EOL . '<!-- Close rr-docs-plaintext -->' . PHP_EOL,
        /** Remove ~~~~~ */
        '',
        /** Replace ~~~ */
        PHP_EOL . '<div class="rr-docs-plaintext">' . PHP_EOL,
        /** Remove ~~~ */
        '',
    ],
    implode(PHP_EOL, $lines)
);

?>

<div class="rr-docs-container">
    <div class="rr-docs-output">
    <?php
        if(empty($output) && (($currentRequest->getGet()['request'] ?? '') !== 'GettingStarted')) {
    ?>
            <p>Sorry, documentation for <code class="<?php echo ($cssClasses['codeClass'] ?? ''); ?>">
            <?php echo ($currentRequest->getGet()['request'] ?? 'help'); ?></code> is not available yet.</p>
            <video class="rr-docs-video" controls autoplay>
                <source src="https://roadydemos.us-east-1.linodeobjects.com/roadyInstallAndHelloWorldTake3-2021-07-31_14.06.34.webm" type="video/webm">
                Sorry, the video failed to load.
            </video>
            <p><a href="index.php">Return to Homepage</a></p>
    <?php
        } else {
            if(($currentRequest->getGet()['request'] ?? 'roady') !== 'installation-and-setup') {
                echo $output;
            }
        }
    ?>
    </div>
</div>

