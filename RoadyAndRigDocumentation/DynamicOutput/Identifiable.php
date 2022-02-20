<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use roady\classes\primary\Identifiable;
?>
<div class="roady-app-output-container">
    <h1>Identifiable</h1>
    <p>
        The Identifiable interface defines an object that has an
        alphanumeric name, and a unique id.
    </p>
    <pre>
    <code>
<?php
echo htmlspecialchars(
    trim(
        strval(
            file_get_contents(
                str_replace(
                    DIRECTORY_SEPARATOR . 'Apps' . 
                    DIRECTORY_SEPARATOR . 'RoadyAndRigDocumentation' . 
                    DIRECTORY_SEPARATOR . 'DynamicOutput',
                    '',
                    __DIR__
                ) . 
                DIRECTORY_SEPARATOR . 'core' . 
                DIRECTORY_SEPARATOR . 'interfaces' . 
                DIRECTORY_SEPARATOR . 'primary' . 
                DIRECTORY_SEPARATOR . 'Identifiable.php'
            )
        )
    )
);
    ?>
    </code>
    </pre>
    <p>
        The Identifiable class can be used wherever a name and unique id
        are needed.
    </p>
    <p>
        For example:
    </p>
    <pre>
    <code>
&lt;?php

$guitarManufacturers = [
    new Identifiable('Taylor'),
    new Identifiable('Gibson'),
    new Identifiable('Fender'),
    new Identifiable('PRS'),
    new Identifiable('Washburn'),
    new Identifiable('Ibanez'),
];

foreach($guitarManufacturers as $guitarManufacturer) {
    echo '&lt;p&gt;Manufacturer&quot;s Name:' . $guitarManufacturer-&gt;getName() . '&lt;/p&gt;';
    echo '&lt;p&gt;Unique Id:' . $guitarManufacturer-&gt;getUniqueId() . '&lt;/p&gt;';
}
    </code>
    </pre>
    <p>Would output similar to:</p>
    <div class="roady-app-output-example-container">
        <?php
        
        $guitarManufacturers = [
            new Identifiable('Taylor'),
            new Identifiable('Gibson'),
            new Identifiable('Fender'),
            new Identifiable('PRS'),
            new Identifiable('Washburn'),
            new Identifiable('Ibanez'),
        ];
        
        foreach($guitarManufacturers as $guitarManufacturer) {
            echo '<p>Manufacturer&quot;s Name:' . $guitarManufacturer->getName() . '</p>';
            echo '<p>Unique Id:' . $guitarManufacturer->getUniqueId() . '</p>';
        }
        ?>
    </div>
    <!-- close roady-app-output-example-container -->
    <div class="roady-app-output-note-container">
        Note: UniqueIds will be different for each new instance of 
        the Identifiable class.
    </div>
</div>
<!-- close roady-app-output-container -->
