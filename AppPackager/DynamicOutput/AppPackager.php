<?php

use roady\classes\component\Crud\ComponentCrud;
use roady\classes\component\DynamicOutputComponent;
use roady\classes\component\Factory\App\AppComponentsFactory;
use roady\classes\component\OutputComponent;
use roady\classes\component\Web\App;
use roady\classes\component\Web\Routing\GlobalResponse;
use roady\classes\component\Web\Routing\Request;
use roady\classes\component\Web\Routing\Response;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;
use roady\classes\utility\AppBuilder;
use roady\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;
use roady\interfaces\component\Factory\Factory;
use roady\interfaces\component\Web\Routing\Response as ResponseInterface;

?>

<?php

/** Vars **/
$currentRequest = new Request(new Storable( 'CurrentRequest', 'Requests', 'AppPackager'), new Switchable());
$appName = ($currentRequest->getPost()['AppToPack'] ?? 'AppPackager');
$appComponentsFactory = AppBuilder::getAppsAppComponentsFactory($appName, $currentRequest->getUrl());
// $componentCrud = $appComponentsFactory->getComponentCrud()
$apps = [];
$responses = [];
$requests = [];
$outputComponents = [];
$assignments = [];
$appDirectoryPath = str_replace([basename(__DIR__), 'AppPackager'], '', __DIR__) . DIRECTORY_SEPARATOR . $appName;
$appPackageDirectoryPath = str_replace(basename(__DIR__), '', __DIR__) . 'resources' . DIRECTORY_SEPARATOR . 'AppPackages' . DIRECTORY_SEPARATOR . $appName;


/** Functions **/
$assignOutputComponentsToResponse = function(AppComponentsFactoryInterface $appComponentsFactory, ResponseInterface $response, array &$assignments) {
    foreach($response->getOutputComponentStorageInfo() as $storable) {
        $oc = $appComponentsFactory->getComponentCrud()->read($storable);
        switch($oc->getType()) {
            case OutputComponent::class:
                $assignments[] = "rig --assign-to-response " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--response '" . $response->getName() . "' " .
                    "--output-components '" . $storable->getName() . "'";
                break;
            case DynamicOutputComponent::class:
                $assignments[] = "rig --assign-to-response " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--response '" . $response->getName() . "' " .
                    "--dynamic-output-components '" . $storable->getName() . "' ";
                break;
        }
    }
};

$assignRequestsToResponse = function(AppComponentsFactoryInterface $appComponentsFactory, ResponseInterface $response, array &$assignments) {
    foreach($response->getRequestStorageInfo() as $storable) {
        $assignments[] = "rig --assign-to-response " .
            "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
            "--response '" . $response->getName() . "' " .
            "--requests '" . $storable->getName() . "' ";
    }
};

$getAvailableAppNames = function(Request $currentRequest, ComponentCrud $componentCrud): array {
    $appInfo = [];
    foreach (
            $componentCrud->readAll(
                App::deriveAppLocationFromRequest($currentRequest),
                Factory::CONTAINER
            )
            as
            $factory
    ) {
        /**
         * @var Factory $factory
         */
        if(
            $factory->getType() === AppComponentsFactory::class
            &&
            $factory->getApp()->getName() !== 'roady'
        ) {
            /**
             * @var AppComponentsFactory $factory
             */
            $appInfo[] = $factory->getApp()->getName();
        }
    }
    sort($appInfo);
    return $appInfo;
};

$generateAvailableAppSelectionOptions = function($selectedApp, $currentRequest, $appComponentsFactory) use (&$getAvailableAppNames) {
    $availableApps = $getAvailableAppNames($currentRequest, $appComponentsFactory->getComponentCrud());
    foreach($availableApps as $appName) {
            $selected = ($selectedApp === $appName ? 'selected' : '');
            echo "<option $selected class=\"select-option\" value=\"$appName\">$appName</option>";
    }
};

$createDirectory = function($directoryPath) {
    if(!is_dir($directoryPath)) {
        echo "<p class=\"roady-message\">Created new directory at <code class=\"roady-inline-code\">$directoryPath</code></p>";
        mkdir($directoryPath, 0755, true);
    }
};

$copyAppFilesAndDirectories = function(string $sourceDirectoryPath, string $targetDirectoryPath) use (&$copyAppFilesAndDirectories, &$createDirectory) {
    $sourceDirectoryPath = strval(realpath($sourceDirectoryPath));
    if(!is_dir($sourceDirectoryPath)) {
        echo '<p class="roady-error-message">The <code class="roady-inline-code">' . $sourceDirectoryPath . '</code> does not exist</p>';
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
            echo "<p class=\"roady-message\">Copied new <code class=\"roady-inline-code\">$realFilePath</code> to <code class=\"roady-inline-code\">$copyPath</code></p>";
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
    $makeFileOutput = '<pre class="roady-multi-line-code-container"><code class="roady-multi-line-code">';
    $makeFilePath = $appPackageDirectoryPath . DIRECTORY_SEPARATOR . 'make.sh';
    foreach($components as $line) {
        $makeFile .= PHP_EOL . $line . PHP_EOL;
        $makeFileOutput .= htmlspecialchars($line) . PHP_EOL;
    }
    $makeFileOutput .= '</code></pre>';
    echo '<p class="roady-message">Created the following make.sh at <code class="roady-inline-code">' . $makeFilePath . '</code>:</p>' . $makeFileOutput;
    file_put_contents($makeFilePath, $makeFile);
    chmod($makeFilePath, 0755);
};

$generateMakeFile = function(AppComponentsFactoryInterface $appComponentsFactory, array $apps, array $outputComponents, array $requests, array $responses, array $assignments) use (&$assignRequestsToResponse, &$assignOutputComponentsToResponse): array {
    /** rig --new-app call is required or rig will refuse to make app package when rig --make-app-package is called */
    $apps[] = "rig --new-app --name " . $appComponentsFactory->getApp()->getName() . " --domain '" . $appComponentsFactory->getApp()->getAppDomain()->getUrl() . "'";
    foreach($appComponentsFactory->getStoredComponentRegistry()->getRegisteredComponents() as $component) {
        switch($component->getType()) {
            case DynamicOutputComponent::class:
                /** @var DynamicOutputComponent $component */
                $isShared = str_contains($component->getDynamicFilePath(), 'SharedDynamicOutput');
                $outputComponents[] = "rig --new-dynamic-output-component " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--name '" . $component->getName() . "' " .
                    "--container '" . $component->getContainer() . "' " .
                    "--position '" . $component->getPosition() . "' " .
                    ($isShared === true ? '--shared ' : '');
                break;
            case OutputComponent::class:
                /** @var OutputComponent $component */
                $outputComponents[] = "rig --new-output-component " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--name '" . $component->getName() . "' " .
                    "--output '" . $component->getOutput() . "' " .
                    "--container '" . $component->getContainer() . "' " .
                    "--position '" . $component->getPosition() . "'";
                break;
            case Request::class:
                /** @var Request $component */
                $requests[] = "rig --new-request " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--name '" . $component->getName() . "' " .
                    "--relative-url '" . str_replace([$appComponentsFactory->getApp()->getAppDomain()->getUrl(), "/"], "", $component->getUrl()) . "' " .
                    "--container '" . $component->getContainer() . "'";
                break;
            case Response::class:
                /** @var Response $component */
                $responses[] = "rig --new-response " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--name '" . $component->getName() . "' " .
                    "--position '" . $component->getPosition() . "'";
                $assignRequestsToResponse($appComponentsFactory, $component, $assignments);
                $assignOutputComponentsToResponse($appComponentsFactory, $component, $assignments);
                break;
            case GlobalResponse::class:
                /** @var GlobalResponse $component */
                $responses[] = "rig --new-global-response " .
                    "--for-app '" . $appComponentsFactory->getApp()->getName() . "' " .
                    "--name '" . $component->getName() . "' " .
                    "--position '" . $component->getPosition() . "'";
                $assignOutputComponentsToResponse($appComponentsFactory, $component, $assignments);
                break;
        }
    }
    return array_merge($apps, $responses, $requests, $outputComponents, $assignments);
};

?>
<!-- App Packager Output Start -->
<div class="roady-app-output-container">
    <p><a href="/">Go Home</a></p>
    <h3>Welcome to the App Packager App</h3>

    <p>
        The App Packager can be used to convert existing roady
        Apps into roady App Packages.
    </p>

    <p>
        To convert an App into an App Package, select it from the list
        below, and click the Submit button.
    </p>

    <p>
        Note: The App to be converted must have been built for the domain
        <?php
            $parsedUrl = parse_url($currentRequest->getUrl());
            $root = strstr(
                $currentRequest->getUrl(),
                (
                    is_array($parsedUrl) && isset($parsedUrl['path'])
                    ? $parsedUrl['path']
                    : ''
                ),
                true
            );
            echo $root;
        ?>
        for the conversion to be successful.
    </p>

    <p>
        Note: The resulting App Package will be located at the
        following path relative to the App Packager App's root
        directory:
    </p>
    <p>
        resources/AppPackages
    </p>

    <p>
        For example, if roady is installed at ~/, then the new
        App Packages will be located at:
    </p>
    <p>
        ~/roady/Apps/AppPackager/resources/AppPackages
    </p>

    <form class="roady-form" action="<?php echo $currentRequest->getUrl(); ?>" method="post">
    
        <label class="roady-form-input-label" for="AppToPackSelector">Select an App to convert into an App Package:</label><br/>
    
        <select id="AppToPackSelector" class="roady-form-input" name="AppToPack">
            <?php $generateAvailableAppSelectionOptions($appName, $currentRequest, $appComponentsFactory); ?>
        </select>
    
        <input type="hidden" name="MakeAppPackage" value="True">
    
        <input class="roady-form-input" type="submit">
    
    </form>
    
    <?php if(isset($currentRequest->getPost()['MakeAppPackage']) && $currentRequest->getPost()['MakeAppPackage'] === 'True') { ?>
    
        <?php
            $createDirectory($appPackageDirectoryPath);
            $createMakeFile($appPackageDirectoryPath, $generateMakeFile($appComponentsFactory, $apps, $outputComponents, $requests, $responses, $assignments));
            $copyAppFilesAndDirectories($appDirectoryPath, $appPackageDirectoryPath);
        ?>
    
    <?php } ?>

</div>
<!-- End roady-app-output-container -->
