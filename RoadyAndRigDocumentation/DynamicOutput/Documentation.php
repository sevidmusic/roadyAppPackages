<?php

use roady\classes\component\Web\Routing\Request;
use roady\classes\primary\Storable;
use roady\classes\primary\Switchable;

$currentRequest = new Request(
    new Storable('CurrentRequest', 'tmp', 'Documentation'),
    new Switchable()
);

$requestedDocumentation = (
    $currentRequest->getGet()['request'] ?? 'roady'
);

$roadyRootDirectoryPath = str_replace(
    'Apps' . DIRECTORY_SEPARATOR .
    'RoadyAndRigDocumentation' . DIRECTORY_SEPARATOR .
    basename(__DIR__),
    '',
    __DIR__
);

$rigHelpFilesDirectoryPath = strval(
    realpath(
        $roadyRootDirectoryPath . DIRECTORY_SEPARATOR . 
        'vendor' . DIRECTORY_SEPARATOR . 'darling' . 
        DIRECTORY_SEPARATOR . 'rig' . DIRECTORY_SEPARATOR . 
        'helpFiles'
    )
);

$helpFilesDirectoryScan = scandir(
    $rigHelpFilesDirectoryPath
);

$helpFilesListing = array_diff(
    (
        is_array($helpFilesDirectoryScan) 
        ? $helpFilesDirectoryScan 
        : []
    ),
    ['.', '..']
);

$helpFileOutput = 
    ($requestedDocumentation === 'rig')
    ? htmlspecialchars(
        strval(
            file_get_contents(
                $rigHelpFilesDirectoryPath . 
                DIRECTORY_SEPARATOR .
                'help.txt'
            )
        )
    )
    : htmlspecialchars(
        strval(
            @file_get_contents(
                $rigHelpFilesDirectoryPath . 
                DIRECTORY_SEPARATOR .
                $requestedDocumentation . '.txt'
            )
        )
    );

/** Help File Output */
$lines = explode(PHP_EOL, $helpFileOutput);
$dontTrim = [
    'getting-started', 
    'roady', 
    'Apps', 
    'AppPackages',
    'Components.php',
    'css',
    'js',
    'OutputComponents',
    'DynamicOutputComponents',
    'Responses',
    'Requests',
    'GlobalResponses',
];
foreach($lines as $key => $line) {
    $lines[$key] = (
        !in_array(
            $requestedDocumentation,
            $dontTrim
        )
        ? trim($line)
        : $line
    );
}

$formattedOutput = preg_replace(
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
        '#http(s?)://([a-zA-Z0-9_.:?=/-]+(&amp;)?)+[a-zA-Z0-9/]#',
        /** Match ~~~~~ for replacement */
        '#~{5}#',
        /** Match ~~~~~ for removal */
        '#~{5}#',
        /** Match ~~~ for replacement */
        '#~{3}#',
        /** Match ~~~ for removal */
        '#~{3}#',
        /** Match text prefixed with ### for replacement */
        '/#{3}(\s).*$/m',
        /** Match ### for removal */
        '/#{3}(\s)/m',
        /** Match text prefixed with # for replacement */
        '/#{1}(\s).*$/m',
        /** Match # for removal */
        '/#{1}(\s)/m',
        /** Match first 2 spaces at beginning of line */
        '#^  #m',
        /** Match WARNING: */
        '#WARNING:#i',
        /** Match NOTE: */
        '#NOTE:#i',
        /** Match rig */
        '#(\s)rig#i',
        /** Match rig */
        '#>rig#i',
        /** Match [Rr]equest(s) */
        '#\s[Rr]equest(s?)#',
        /** Match GlobalResponse(s) */
        '#(\s)GlobalResponse(s?)#',
        /** Match [Rr]esponse(s) */
        '#(\s)[Rr]esponse(s?)#',
        /** Match DynamicOutputComponent(s) */
        '#(\s)DynamicOutputComponent(s?)#',
        /** Match OutputComponent(s) */
        '#(\s)OutputComponent(s?)#',
        /** Match App(s) */
        '#(\s)App(s?)#',
        /** Match roady */
        '#(\s)roady#i',
        /** Match --configure-app-output or configure-app-output  */
        '#(--)?configure-app-output#',
        /** Match --new-app or new-app*/
        '#(--)?new-app#',
        /** 
         * Pattern conflict fix | 
         * Match:
         *   <a href="index.php?request=new-app">--new-app</a>-package
         */
        '#<a href="index.php[?]request=new-app">--new-app</a>-package#',
        /** Pattern conflict fix | Match <a href="index.php?request=new-app">new-app</a>-package */
        '#<a href="index.php[?]request=new-app">new-app</a>-package#',
        /** Match --assign-to-response or assign-to-response */
        '#(--)?assign-to-response#',
        /** Match --make-app-package or make-app-package */
        '#(--)?make-app-package#',
        /** Match --name */
        '#--name#',
        /** Match --path-to-apps-directory or path-to-apps-directory */
        '#(--)?path-to-apps-directory#',
        /** Match https://roadydemos\.us-east-1\.linodeobjects\.com/(.*)\.webm */
        '#<a href="https://roadydemos\.us-east-1\.linodeobjects\.com/(.*)\.webm">https://roadydemos\.us-east-1\.linodeobjects\.com/(.*)\.webm</a>#',
        /** Match --start-server or start-server */
        '#(--)?start-server#',
        /** Match --view-active-servers or view-active-servers */
        '#(--)?view-active-servers#',
        /** Match --debug or debug */
        '#(--)?debug#',
        /** Match --help or help */
        '#(--)?help#',
        /** Match --new-response or new-response */
        '#(--)?new-response#',
        /** Match --new-global-response or new-global-response */
        '#(--)?new-global-response#',
        /** Match --new-request or new-request */
        '#(--)?new-request#',
        /** Match --new-output-component or new-output-component */
        '#(--)?new-output-component#',
        /** Match --new-dynamic-output-component or new-dynamic-output-component */
        '#(--)?new-dynamic-output-component#',
        /** Match links to Apps followed by the word Package */
        '#<a href="index.php\?request=Apps">(\s)?App</a>(\s)[pP]ackage#',
        /** Match <a href="index.php?request=App"> App</a>[pP]ackager */
        '#<a href="index.php\?request=App"> App</a>[pP]ackager#',
        /** Match getting(-|\s)started */
        '#(\s)getting(-|\s)started#',
        /** Match <a href="index.php?request=roady"> roady</a>AppPackages */
        '#<a href="index.php\?request=roady"> roady</a>AppPackages#',
        /** Match HelloWorld */
        '#\sHelloWorld\s?#',
        /** Match Components.php */
        '#Components[.]php#',
        /** Match <div class="rr-docs-plaintext">(\s)+<span class="rr-docs-note-icon">NOTE: */
        '#<div class="rr-docs-plaintext">(\s)+<span class="rr-docs-note-icon">NOTE:#',
        /** Match css or Css */
        '#\s[Cc]ss\s#',
        /** Match Stylesheet(s) or stylesheet(s) */
        '#[Ss]tylesheet(s)?#',
        /** Match Script(s) or script(s) */
        '#\s[Ss]cript(s)?#',
        /** Match DynamicOutput or Dynamic Output */
        '#\sDynamic(\s)?Output\s#',
        /** Match >DynamicOutput< or >Dynamic Output< */
        '#[>]Dynamic(\s)?Output[<]#',
        /** Match Symphony */
        '#[Ss]ymphony#',
        /** Match Laravel */
        '#[Ll]aravel#',
        /** Match composer */
        '#\s[Cc]omposer#',
        /** Match Apps"> App</a>Packages */
        '#Apps"[>](\s)?App[<]/a[>]Packages#',
    ],
    [
        /** Replace within ``` and ``` */
        '<pre class="rr-docs-code-ml-container"><code class="rr-docs-code rr-docs-code-ml">${0}</code></pre>',
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
        /** Replace ### */
        '<h3>${0}</h3>',
        /** Remove ### */
        '',
        /** Replace # */
        '<h1>${0}</h1>',
        /** Remove # */
        '',
        /** Remove first 2 spaces at beginning of line */
        '',
        /** Replace WARNING: */
        '<span class="rr-docs-warning">WARNING:</span>',
        /** Replace NOTE: */
        '<span class="rr-docs-note-icon">NOTE:</span><br>',
        /** Replace rig */
        '<a href="index.php?request=rig">${0}</a>',
        /** Match rig */
        '><a href="index.php?request=rig">rig</a>',
        /** Replace [Rr]equest(s?) */
        '<a href="index.php?request=Requests">${0}</a>',
        /** Replace GlobalResponse(s?) */
        '<a href="index.php?request=GlobalResponses">${0}</a>',
        /** Replace [Rr]esponse(s?) */
        '<a href="index.php?request=Responses">${0}</a>',
        /** Replace DynamicOutputComponent(s?) */
        '<a href="index.php?request=DynamicOutputComponents">${0}</a>',
        /** Replace OutputComponent(s?) */
        '<a href="index.php?request=OutputComponents">${0}</a>',
        /** Replace App(s?) */
        '<a href="index.php?request=Apps">${0}</a>',
        /** Replace roady */
        '<a href="index.php?request=roady">${0}</a>',
        /** Replace --configure-app-output or configure-app-output */
        '<a href="index.php?request=configure-app-output">${0}</a>',
        /** Replace --new-app or new-app */
        '<a href="index.php?request=new-app">${0}</a>',
        /** Pattern conflict fix | Replace <a href="index.php?request=new-app">--new-app</a>-package */
        '<a href="index.php?request=new-app-package">--new-app-package</a>',
        /** Pattern conflict fix | Replace <a href="index.php?request=new-app">new-app</a>-package */
        '<a href="index.php?request=new-app-package">new-app-package</a>',
        /** Replace --assign-to-response or assign-to-response */
        '<a href="index.php?request=assign-to-response">${0}</a>',
        /** Replace --make-app-package or make-app-package */
        '<a href="index.php?request=make-app-package">${0}</a>',
        /** Replace --name */
        '<code class="rr-docs-code">${0}</code>',
        /** Replace --path-to-apps-directory or path-to-apps-directory */
        '<a href="index.php?request=path-to-apps-directory">${0}</a>',
        /** Replace https://roadydemos\.us-east-1\.linodeobjects\.com/(.*)\.webm */
        '
<video class="rr-docs-video" controls>
    <source src="https://roadydemos.us-east-1.linodeobjects.com/${1}.webm" type="video/webm">
    Sorry, the video failed to load.
</video>
        ',
        /** Replace --start-server or start-server */
        '<a href="index.php?request=start-server">${0}</a>',
        /** Replace --view-active-servers or view-active-servers */
        '<a href="index.php?request=view-active-servers">${0}</a>',
        /** Replace --debug or debug */
        '<a href="index.php?request=debug">${0}</a>',
        /** Replace --help or help */
        '<a href="index.php?request=rig">${0}</a>',
        /** Replace --new-response or new-response */
        '<a href="index.php?request=new-response">${0}</a>',
        /** Replace --new-global-response or new-global-response */
        '<a href="index.php?request=new-global-response">${0}</a>',
        /** Replace --new-request or new-request */
        '<a href="index.php?request=new-request">${0}</a>',
        /** Replace --new-output-component or new-output-component */
        '<a href="index.php?request=new-output-component">${0}</a>',
        /** Replace --new-dynamic-output-component or new-dynamic-output-component */
        '<a href="index.php?request=new-dynamic-output-component">${0}</a>',
        /** Replace <a href="index.php?request=App"> App</a> Packages */
        ' <a href="index.php?request=AppPackages">App Package</a>',
        /** Replace <a href="index.php?request=App"> App</a>[pP]ackager */
        ' <a href="https://github.com/sevidmusic/roadyAppPackages">AppPackager</a>',
        /** Replace getting(-\s)started */
        '<a href="index.php?request=getting-started">${0}</a>',
        /** Replace <a href="index.php?request=roady"> roady</a>AppPackages */
        ' <a href="https://github.com/sevidmusic/roadyAppPackages">roadyAppPackages</a>',
        /** Replace HelloWorld */
        '<a href="https://github.com/sevidmusic/roadyAppPackages/tree/main/HelloWorld">${0}</a>',
        /** Replace Components.php */
        '<a href="index.php?request=Components.php">Components.php</a>',
        /** Replace <div class="rr-docs-plaintext">(\s)+<span class="rr-docs-note-icon">NOTE: */
        '<div class="rr-docs-plaintext rr-docs-note-container"><span class="rr-docs-note-icon">&raquo;',
        /** Replace Css or css */
        '<a href="index.php?request=css">${0}</a>',
        /** Replace Stylesheet(s) or stylesheet(s) */
        '<a href="index.php?request=css">${0}</a>',
        /** Replace Script(s) or script(s) */
        '<a href="index.php?request=js">${0}</a>',
        /** Replace DynamicOutput */
        '<a href="index.php?request=DynamicOutput">${0}</a>',
        /** Replace >DynamicOutput< or >Dynamic Output< */
        '><a href="index.php?request=DynamicOutput"${0}/a><',
        /** Replace Symphony */
        '<a href="https://symfony.com">${0}</a>',
        /** Replace Laravel */
        '<a href="https://laravel.com">${0}</a>',
        /** Replace composer */
        '<a href="https://getcomposer.org">${0}</a>',
        /** Replace Apps"> App</a>Packages */
        'AppPackages"> AppPackages</a>',
    ],
    implode(PHP_EOL, $lines)
);

if(!empty($formattedOutput)) {
?>

<div class="roady-app-output-container rr-docs-container">
    <div class="rr-docs-output">
    <?php echo $formattedOutput; ?>
    </div>
</div>
<?php
}
