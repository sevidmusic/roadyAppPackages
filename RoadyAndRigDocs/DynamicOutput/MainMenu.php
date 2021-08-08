<?php

use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

# To disable output temporarily:
#if($this->getState() === true) {
#    $this->switchState();
#}

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

?>

<div class="rr-docs-container">
    <div class="rr-docs-output">
        <div class="rr-docs-rig-menu">
        <?php
            /** Menu  */
            $menuLinks = [];
            foreach($helpFilesListing as $listing) {
                $linkName = str_replace('.txt', '', $listing);
                array_push(
                    $menuLinks,
                    '<div class="rr-docs-menu-link"><a href="?request=' . $linkName .
                    '">--' . $linkName . '</a></div>'
                );
            }
            echo PHP_EOL . str_repeat(' ', 8) . '' .
                implode(PHP_EOL . str_repeat(' ', 16), $menuLinks);
        ?>
        </div>
    </div>
</div>
