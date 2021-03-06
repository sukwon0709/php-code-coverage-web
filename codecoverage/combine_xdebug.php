<?php

include_once("vendor/autoload.php");

#increase the memory in multiples of 512M in case of memory error
ini_set('memory_limit', '512M');

$final_coverage = new SebastianBergmann\CodeCoverage\CodeCoverage;
$final_coverage->filter()->addDirectoryToWhitelist("/home/soh/git/uc-php/dependencies/ucphp_php_apps");
$final_coverage->filter()->addDirectoryToWhitelist("/home/soh/git/uc-php/dependencies/ucphp_php_apps", '.inc', '');

$new_coverage_files = glob("coverages/*.json");
$count = count($new_coverage_files);
$i = 0;

foreach ($new_coverage_files as $coverage_file)
{
    $i++;
    echo "Processing coverage ($i/$count) from $coverage_file". PHP_EOL;
    $codecoverageData = json_decode(file_get_contents($coverage_file), JSON_OBJECT_AS_ARRAY);
    $test_name = str_ireplace("coverage-", "", basename($coverage_file,".json"));
    $final_coverage->append($codecoverageData, $test_name);
}

echo "Generating final report..." . PHP_EOL;
$report = new \SebastianBergmann\CodeCoverage\Report\Html\Facade;
$report->process($final_coverage,"reports");
echo "Report generated succesfully". PHP_EOL;

echo "\n";

?>
