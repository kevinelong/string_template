<?php
require_once("string_template.php");

class test_object
{

    public $first;
    public $last;
    public $pid;
    public $alt;

    function __construct($first, $last, $pid = '', $alt = '')
    {
        $this->first = $first;
        $this->last = $last;
        $this->pid = $pid;
        $this->alt = $alt;
    }
}

function test_string_template($times=1)
{
    $template = "{last}, {first} ({pid}/{alt})";

    $list = array();
    foreach (range(0, $times) as $i) {
        $list[] = new test_object("Kevin" . $i, "Long" . $i, 10000 + $i, 90000 + $i);
    }

    $st = new string_template($template);

    $result = array();

    $start = microtime(true );

    foreach ($list as $o) {
        $result[] = $st->apply($o);
    }

    $stop = microtime(true);
    $elapsed = $stop - $start;

    echo implode("\n", $result);

    echo "\n\nStarted: $start\nEnded: $stop\n";
    echo "\nApplied $times times in $elapsed seconds.\n";
}

test_string_template(10000);

/***
 * Example result:

Long10000, Kevin10000 (20000/100000)

Started: 0.21327100 1533596047
Ended: 0.98657300 1533596047

Applied 10000 times in 0.773302 seconds.

***/