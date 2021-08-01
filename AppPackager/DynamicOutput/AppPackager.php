<?php

use roady\interfaces\component\Web\Routing\Response as ResponseInterface;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;
use roady\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use roady\classes\utility\AppBuilder;
use roady\classes\component\Web\App;
use roady\classes\component\Web\Routing\Response;
use roady\classes\component\Web\Routing\GlobalResponse;
use roady\classes\component\Web\Routing\Request;
use roady\classes\component\DynamicOutputComponent;
use roady\classes\component\OutputComponent;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

?>

<?php

/** Vars **/
$currentRequest = new Request(new Storable( 'CurrentRequest', 'Requests', 'AppPackager'), new Switchable());
$appName = ($currentRequest->getPost()['AppToPack'] ?? 'AppPackager');
$appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $currentRequest->getUrl());
$apps = [];
$responses = [];
$requests = [];
$outputComponents = [];
$assignements = [];
$appDirectoryPath = str_replace([basename(__DIR__), 'AppPackager'], '', __DIR__) . DIRECTORY_SEPARATOR . $appName;
$appPackageDirectoryPath = str_replace(basename(__DIR__), '', __DIR__) . 'resources' . DIRECTORY_SEPARATOR . 'AppPackages' . DIRECTORY_SEPARATOR . $appName;


/** Functions **/
$assignOutputComponentsToResponse = function(AppComponentsFactoryInterface $appComponentsFactory, ResponseInterface $response, array &$assignements) {
    foreach($response->getOutputComponentStorageInfo() as $storable) {
        $oc = $appComponentsFactory->getComponentCrud()->read($storable);
        switch($oc->getType()) {
            case OutputComponent::class:
                array_push(
                    $assignements,
                    "rig --assign-to-response " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--response '" . $response->getName() . "' " .
                    "--output-components '" . $storable->getName() . "'"
                );
                break;
            case DynamicOutputComponent::class:
                array_push(
                    $assignements,
                    "rig --assign-to-response " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--response '" . $response->getName() . "' " .
                    "--dynamic-output-components '" . $storable->getName() . "' "
                );
                break;
        }
    }
};

$assignRequestsToResponse = function(AppComponentsFactoryInterface $appComponentsFactory, ResponseInterface $response, array &$assignements) {
    foreach($response->getRequestStorageInfo() as $storable) {
        array_push(
            $assignements,
            "rig --assign-to-response " .
            "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
            "--response '" . $response->getName() . "' " .
            "--requests '" . $storable->getName() . "' "
        );
    }
};

$getAvailableAppNames = function(): array {
    $scan = scandir(str_replace([basename(__DIR__), 'AppPackager'], '', __DIR__));
    $ls = (is_array($scan) ? $scan : []);
    return array_diff($ls, ['.', '..', '.buildLogs', 'README.md']);
};

$generateAvailableAppSelectionOptions = function($selectedApp) use (&$getAvailableAppNames) {
    $availableApps = $getAvailableAppNames();
    foreach($availableApps as $appName) {
            $selected = ($selectedApp === $appName ? 'selected' : '');
            echo "<option $selected class=\"select-option\" value=\"$appName\">$appName</option>";
    }
};

$createDirectory = function($directoryPath) {
    if(!is_dir($directoryPath)) {
        echo "<p class=\"app-packager-message\"><code class=\"app-packager-code-preview\">Created new directory at $directoryPath</code></p>";
        mkdir($directoryPath, 0755, true);
    }
};

$copyAppFilesAndDirectories = function(string $sourceDirectoryPath, string $targetDirectoryPath) use (&$copyAppFilesAndDirectories, &$createDirectory) {
    $sourceDirectoryPath = strval(realpath($sourceDirectoryPath));
    if(!is_dir($sourceDirectoryPath)) {
        echo '<p class="app-packager-error-message">The ' . $sourceDirectoryPath . ' does not exist</p>';
        return;
    }
    $createDirectory($targetDirectoryPath);
    $scan = scandir($sourceDirectoryPath);
    $files = array_diff((is_array($scan) ? $scan : []), ['.', '..']);
    foreach($files as $fileName) {
        $realFilePath = strval(realpath($sourceDirectoryPath . DIRECTORY_SEPARATOR . $fileName));
        $copyPath = $targetDirectoryPath . DIRECTORY_SEPARATOR . $fileName;
        if(!is_dir($realFilePath)) {
            if($fileName === 'Components.php') { continue; }
            echo "<p class=\"app-packager-message\"><code class=\"app-packager-code-preview\">Copied new $realFilePath to $copyPath</code></p>";
            copy($realFilePath, $copyPath);
            continue;
        }
        $ignore = ['AppPackages', 'OutputComponents', 'Requests', 'Responses'];
        if(!in_array(basename($realFilePath), $ignore)) {
            $subDirectoryPath = $targetDirectoryPath . DIRECTORY_SEPARATOR . basename($realFilePath);
            $copyAppFilesAndDirectories($realFilePath, $subDirectoryPath);
        }
    }
};

$createMakeFile = function(string $appPackageDirectoryPath, array $components) {
    $makeFile = '#!/bin/bash' . PHP_EOL . '# make.sh' . PHP_EOL . PHP_EOL .'set -o posix' . PHP_EOL . PHP_EOL;
    $makeFileOutput = '';
    $makeFilePath = $appPackageDirectoryPath . DIRECTORY_SEPARATOR . 'make.sh';
    foreach($components as $line) {
        $makeFile .= PHP_EOL . $line . PHP_EOL;
        $makeFileOutput .= '<code class="app-packager-code-preview makeFileOutput">' . htmlspecialchars($line) .'</code>';
    }
    echo "<p class=\"app-packager-message\"><code class=\"app-packager-code-preview\">Created the following make.sh @ $makeFilePath:</code>$makeFileOutput</p>";
    file_put_contents($makeFilePath, $makeFile);
    chmod($makeFilePath, 0755);
};

$generateMakeFile = function(AppComponentsFactoryInterface $appComponentsFactory, array $apps, array $outputComponents, array $requests, array $responses, array $assignements) use (&$assignRequestsToResponse, &$assignOutputComponentsToResponse): array {
    /** rig --new-app call is required or rig will refuse to make app package when rig --make-app-package is called */
    array_push($apps, "rig --new-app --name " . $appComponentsFactory->getApp()->getName() . " --domain '" . $appComponentsFactory->getApp()->getAppDomain()->getUrl() . "'");
    foreach($appComponentsFactory->getStoredComponentRegistry()->getRegisteredComponents() as $component) {
        switch($component->getType()) {
            case DynamicOutputComponent::class:
                /** @var DynamicOutputComponent $component */
                $isShared = str_contains($component->getDynamicFilePath(), 'SharedDynamicOutput');
                array_push(
                    $outputComponents,
                    "rig --new-dynamic-output-component " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--name '" . $component->getName() . "' " .
                    "--container '" . $component->getContainer() . "' " .
                    "--position '" . $component->getPosition() . "' " .
                    ($isShared === true ? '--shared ' : '')
                );
                break;
            case OutputComponent::class:
                /** @var OutputComponent $component */
                array_push(
                    $outputComponents,
                    "rig --new-output-component " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--name '" . $component->getName() . "' " .
                    "--output '" . $component->getOutput() . "' " .
                    "--container '" . $component->getContainer() . "' " .
                    "--position '" . $component->getPosition() . "'"
                );
                break;
            case Request::class:
                /** @var Request $component */
                array_push(
                    $requests,
                    "rig --new-request " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--name '" . $component->getName() . "' " .
                    "--relative-url '" . str_replace([$appComponentsFactory->getApp()->getAppDomain()->getUrl(), "/"], "", $component->getUrl()) . "' " .
                    "--container '" . $component->getContainer() . "'"
                );
                break;
            case Response::class:
                /** @var Response $component */
                array_push(
                    $responses,
                    "rig --new-response " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--name '" . $component->getName() . "' " .
                    "--position '" . $component->getPosition() . "'"
                );
                $assignRequestsToResponse($appComponentsFactory, $component, $assignements);
                $assignOutputComponentsToResponse($appComponentsFactory, $component, $assignements);
                break;
            case GlobalResponse::class:
                /** @var GlobalResponse $component */
                array_push(
                    $responses,
                    "rig --new-global-response " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--name '" . $component->getName() . "' " .
                    "--position '" . $component->getPosition() . "'"
                );
                $assignOutputComponentsToResponse($appComponentsFactory, $component, $assignements);
                break;
        }
    }
    return array_merge($apps, $responses, $requests, $outputComponents, $assignements);
};

?>
<!-- App Packager Output Start -->
<div class="app-packager-app-packager-output-container">
<div class="app-packager-app-packager-output">


<div class="app-packager-content">
    <h3>Welcome to the App Packager App</h3>

    <p>
        The App Pcakager can be used to create app packages from existing Roady
        Apps that were built for the same domain the App Packager was built for.
    </p>

    <p>
        App Packages can be used to save stripped down versions of an App that
        can be re-made into Roady App via <code>`rig --make-app-package`</code>.
    <p>

    <p>
        Instead of defining configuration files, App Packages define a single
        make.sh script that can be used to re-make an actual Roady App.
    </p>

    <p>
        App Packages also can provide any additional resources that may be needed
        by the App, such as stylesheets, scripts, etc.
    </p>
</div>

<form class="app-packager-app-selection-form" action="<?php echo $currentRequest->getUrl(); ?>" method="post">

    <label class="app-packager-select-form-label" for="AppToPackSelector">Select an App to create an App Package from:</label><br/>

    <select id="AppToPackSelector" class="app-packager-select-form" name="AppToPack">
        <?php $generateAvailableAppSelectionOptions($appName); ?>
    </select>

    <input type="hidden" name="MakeAppPackage" value="True">

    <input class="app-packager-submit-button" type="submit">

</form>

<?php if(isset($currentRequest->getPost()['MakeAppPackage']) && $currentRequest->getPost()['MakeAppPackage'] === 'True') { ?>
    <div class="app-packager-make-file-preview">

    <?php
        $createDirectory($appPackageDirectoryPath);
        $createMakeFile($appPackageDirectoryPath, $generateMakeFile($appComponentsFactory, $apps, $outputComponents, $requests, $responses, $assignements));
        $copyAppFilesAndDirectories($appDirectoryPath, $appPackageDirectoryPath);
    ?>

    </div>

<?php } ?>

</div>
<!-- App Packager Output End -->
</div>
<!-- App Packager Output Container End -->
