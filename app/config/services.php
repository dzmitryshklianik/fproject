<?php
//create object to definite and store default classes behavior
$container = new Framework\Container();

//For DataBase class set connection settings
$container->set(App\Database::class,function(){

    return new App\Database($_ENV["DB_HOST"],$_ENV["DB_NAME"],$_ENV["DB_USER"],$_ENV["DB_PASSWORD"]);

});

//Choose realization for View interface
$container->set(Framework\TemplateViewerInterface::class,function(){

    return new Framework\MVCTemplateViewer();

});

return $container;