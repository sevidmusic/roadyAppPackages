<?php

$randFloat = function(): float {
    return floatval(rand(0, 99) . '.' . rand(0,99));
};

$randInt = function(): int {
    return rand(1000, 99999999);
};

$randName = function (): string {
    return 'Foo' . rand(10,100) . 'Bar' . rand(10, 100) . 'Baz';
};

$loremIpsumText = function(): string {
    $handle = curl_init();
    $url = "https://loripsum.net/api/10/short/headers";
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $loremIpsumText = curl_exec($handle);
    curl_close($handle);
    return (is_string($loremIpsumText) ? $loremIpsumText : '');
};

$configAppOutput = function(
    closure $randName,
    closure $loremIpsumText,
    closure $randFloat,
    bool $static = true,
    bool $global = false
): void {
    echo "
rig --configure-app-output \
    --for-app FooBarBaz \
    --name " . $randName() . " \
    --output '
    " . $loremIpsumText() . "
    ' \
    --relative-urls '/' 'index.php' '?" . $randName() . "' \
    --o-position  '" . $randFloat() . "' \
    --r-position '" . $randFloat() . "'" . 
    ($static ? ' \\' : '') .
    ($static ? PHP_EOL . '    --static' : '') .
    ($global ? ' \\' : '') .
    ($global ? PHP_EOL . '    --global' : '') . 
    PHP_EOL;
};

for($i=0; $i < 100; $i++) {
    $configAppOutput(
        $randName,
        $loremIpsumText,
        $randFloat,
        static: boolval(rand(0, 1)),
        global: boolval(rand(0, 1))
    );
}
