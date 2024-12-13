<?php
require 'vendor/autoload.php';
use voku\helper\HtmlMin;
use MatthiasMullie\Minify;

function createFolder($folderName){
    if(!is_dir($folderName)){
        //crearlo porque no existe
        $result = mkdir($folderName);
        if($result){
            echo 'Folder created';
        }else{
            echo 'Failed to create folder';
        }
    }else{
        echo 'Folder already exists'. PHP_EOL;
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

createFolder('out');
createFolder('out/css');
createFolder('out/js');
createFolder('out/backend');
copyBackend('backend', 'out/backend');
minifyHtmlFiles(__DIR__,__DIR__.'/out');
minifyJsFiles(__DIR__.'/js', __DIR__.'/out/js');