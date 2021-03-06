<?php

$app = MABI\App::getSingletonApp();

// Set up 'Models' path for application-specific models and overrides
$app->setModelLoaders(array(new MABI\DirectoryModelLoader(__DIR__ . '/../Models' /*, optional namespace */)));

// Set up 'Middlewares' path for application-specific middlewares and overrides
$app->setMiddlewareDirectories(array_merge($app->getMiddlewareDirectories(), array(__DIR__ . '/../Middleware')));

// Set up 'Controllers' path for application-specific controllers and overrides
$dirControllerLoader = new \MABI\DirectoryControllerLoader(__DIR__ . '/../Controllers', $app /*, optional namespace */);
$app->setControllerLoaders(array(
  $dirControllerLoader,
  new \MABI\GeneratedRESTModelControllerLoader(
    array_diff($app->getExtensionModelClasses(), $dirControllerLoader->getOverriddenModelClasses()), $app)
));

$app->getSlim()->contentType('application/json');
