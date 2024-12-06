<?php
require 'vendor/autoload.php';

use voku\helper\HtmlMin;
use MatthiasMullie\Minify;

function createFolder($folderName)
{

    // Check if the folder already exists
    if (!is_dir($folderName)) {
        // Create the folder
        if (mkdir($folderName)) {
            echo "Folder '$folderName' created successfully." . PHP_EOL;
        } else {
            echo "Failed to create folder '$folderName'.";
        }
    } else {
        echo "Folder '$folderName' already exists." . PHP_EOL;
    }
}

function copyBackend($source, $destination) {
    // Scan the source folder
    $items = array_diff(scandir($source), ['.', '..']);

    foreach ($items as $item) {
        $sourcePath = $source . DIRECTORY_SEPARATOR . $item;
        $destinationPath = $destination . DIRECTORY_SEPARATOR . $item;

        if (is_dir($sourcePath)) {
            // Recursively copy subdirectories
            if (!copyBackend($sourcePath, $destinationPath)) {
                return false;
            }
        } else {
            // Copy files
            if (!copy($sourcePath, $destinationPath)) {
                echo "Failed to copy file '$sourcePath' to '$destinationPath'.\n";
                return false;
            }
        }
    }

    echo "Backend copied \n";
    return true;
}


function minifyHtmlFiles($inputDirectory, $outputDirectory)
{
    $htmlMin = new HtmlMin();
    $processedCount = 0;

    // Scan the input directory for all HTML files
    $files = glob($inputDirectory . '/*.html');

    foreach ($files as $file) {
        // Read, minify, and write the file
        $originalContent = file_get_contents($file);
        $minifiedContent = $htmlMin->minify($originalContent);

        // Save the minified file with the same name in the output directory
        $outputFileName = $outputDirectory . '/' . basename($file);
        if (file_put_contents($outputFileName, $minifiedContent)) {
            // echo "Minified: $file -> $outputFileName\n";
            $processedCount++;
        } else {
            echo "Failed to minify: $file\n";
        }
    }

    echo "* HTML succesfully minified. Processed $processedCount files.\n";
}

function miniyCss()
{
    // CSS Minification and Combination
    $cssFiles = ['css/styles.css'];
    $combinedCss = '';

    foreach ($cssFiles as $file) {
        $combinedCss .= file_get_contents($file) . "\n";
    }

    $cssMinifier = new Minify\CSS();
    $cssMinifier->add($combinedCss);
    $cssMinifier->minify('out/css/styles.css');
    echo '* CSS minified' . PHP_EOL;
}

function minifyJsFiles($inputFolder, $outputFolder) {
    $processedCount = 0;

    // Scan the input folder for all JavaScript files
    $jsFiles = glob($inputFolder . '/*.js');

    foreach ($jsFiles as $file) {
        // Read the content of each JavaScript file
        $fileContent = file_get_contents($file);

        // Minify the content
        $jsMinifier = new Minify\JS();
        $jsMinifier->add($fileContent);
        $minifiedContent = $jsMinifier->minify();

        // Determine the output file path
        $outputFile = $outputFolder . '/' . basename($file);

        // Write the minified content to the output file
        if (file_put_contents($outputFile, $minifiedContent)) {
            $processedCount++;
        } else {
            echo "Failed to write minified file: $outputFile\n";
        }
    }

    echo "* ". $processedCount. " JavaScript files have been processed.\n";
}


//Create required files:
createFolder('out');
createFolder('out/css');
createFolder('out/js');
createFolder('out/backend');
//copy backend
copyBackend('backend','out/backend');
// input and output directories
$inputDirectory = __DIR__;
$outputDirectory = __DIR__ . '/out'; // Directory to store minified files

minifyHtmlFiles($inputDirectory, $outputDirectory);
miniyCss();
minifyJsFiles($inputDirectory.'/js', $outputDirectory.'/js');


