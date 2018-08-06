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

function test_string_template()
{
    $template = "{last}, {first} ({pid}/{alt})";

    $list = array();
    foreach (range(0, 10) as $i) {
        $list[] = new test_object("Kevin" . $i, "Long" . $i, 10000 + $i, 90000 + $i);
    }

    $st = new string_template($template);

    $result = array();

    foreach ($list as $o) {
        $result[] = $st->apply($o);
    }

    echo implode("\n", $result);
}

test_string_template();
