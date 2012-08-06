<?php

// Configuration
$hideDotFiles = true;
$rootDirectory = './'; // Must have trailing slash

// Define the path (via get for web, or command line)
$dir = $_GET['dir'] ? $_GET['dir'] : $argv[1];

// Sanitize user input
$dir = str_replace('..', '', $dir);

// Set up a place to store the output
$results = array();

// Add a trailing slash to the directory (for string concatenation)
if (substr($dir, -1, 1) !== DIRECTORY_SEPARATOR) {
  $dir .= DIRECTORY_SEPARATOR;
}

// Sorting function
function filelistsort($a, $b) {
  if ($a['dir'] == $b['dir']) {
    return strnatcasecmp($a['name'], $b['name']);
  }
  if ($a['dir']) return -1;
  return 1;
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
  usort($results, 'filelistsort');
  echo json_encode($results);
} else {
  // If the parameter is not a directory, die.
  throw new Exception("Invalid directory specified - " . $dir);
}