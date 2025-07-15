<?php

// Valid PHP Version?
$minPHPVersion = '8.1';
if (version_compare(PHP_VERSION, $minPHPVersion, '<')) {
    die("Your PHP version must be {$minPHPVersion} or higher to run CodeIgniter. Current version: " . PHP_VERSION);
}
unset($minPHPVersion);

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Location of the Paths config file.
// This is the only line that might need to be changed, depending on your folder structure.
$pathsPath = realpath(FCPATH . '../app/Config/Paths.php');

// Load the framework bootstrap file.
require_once $pathsPath;
$paths = new Config\Paths();
require_once rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'Boot.php';

// Run the application.
exit(CodeIgniter\Boot::bootWeb($paths));
