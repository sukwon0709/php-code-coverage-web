<?php
$current_dir = __DIR__;
$curtime = explode(" ", microtime(false));
$test_name = 'unknown_test_' . date('r', $curtime[1]) . '.' . $curtime[0];
xdebug_start_code_coverage(XDEBUG_CC_UNUSED | XDEBUG_CC_DEAD_CODE);

function end_coverage()
{
    global $test_name;
    global $current_dir;
    $coverageName = $current_dir . '/coverages/coverage-' . $test_name;

    try {
        xdebug_stop_code_coverage(false);
        $codecoverageData = json_encode(xdebug_get_code_coverage());
        file_put_contents($coverageName . '.json', $codecoverageData);
    } catch (Exception $ex) {
        file_put_contents($coverageName . '.ex', $ex);
    }
}

class coverage_dumper
{
    public function __destruct()
    {
        try {
            end_coverage();
        } catch (Exception $ex) {
            echo str($ex);
        }
    }
}

$_coverage_dumper = new coverage_dumper();
