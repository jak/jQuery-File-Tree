<?php

// Configuration
$hideDotFiles = true;
$rootDirectory = './'; // Must have trailing slash

// Define the path
$dir = $_GET['dir'] ? $_GET['dir'] : $argv[1];

// Sanitize user input
$dir = str_replace('..', '', $dir);

// Set up a place to store the output
$results = array();

// Add a trailing slash to the directory (for string concatenation)
if (substr($dir, -1, 1) !== DIRECTORY_SEPARATOR) {
  $dir .= DIRECTORY_SEPARATOR;
}

$dir = $rootDirectory . $dir;

if (is_dir($dir)) {
  foreach (scandir($dir) as $name) {
    // Skip the relative directories
    if ($name == '.' || $name == '..') continue;
    // Skip dotfiles if not wanted
    if ($hideDotFiles && substr($name, 0, 1) == '.') continue;

    $entry = array(
      'name' => $name,
      'dir' => is_dir($dir . $name)
      );

    $results[] = $entry;
  }
  echo json_encode($results);
} else {
  // If the parameter is not a directory, die.
  throw new Exception("Invalid directory specified - " . $dir);
}