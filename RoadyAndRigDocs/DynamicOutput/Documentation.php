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

$rigHelpFilesDirectoryPath = strval(realpath($roadyRootDirectoryPath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'darling' . DIRECTORY_SEPARATOR . 'rig' . DIRECTORY_SEPARATOR . 'helpFiles'));

$helpFilesListing = array_diff(
    scandir($rigHelpFilesDirectoryPath),
    ['.', '..']
);

foreach($helpFilesListing as $listing) {
    echo '<div><a href="?request=' . str_replace('.txt', '', $listing) . '">' . $listing . '</a></div>';
}

if(empty($currentRequest->getGet())) {
    $output = strval(file_get_contents($rigHelpFilesDirectoryPath . DIRECTORY_SEPARATOR . 'help.txt'));
}

if(!empty($currentRequest->getGet())) {
    $output = strval(file_get_contents($rigHelpFilesDirectoryPath . DIRECTORY_SEPARATOR . ($currentRequest->getGet()['request'] ?? 'help') . '.txt'));
}

?>

<div class="roady-and-rig-docs-output-container">

<?php

    $lines = explode(PHP_EOL, $output);
    foreach($lines as $key => $line) {
        $lines[$key] = '<p>' . trim($line) . '</p>';
    }
    $output = str_replace('<p></p>', '',implode(PHP_EOL, $lines));
    echo $output;
?>

</div>
