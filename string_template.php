<?php


class string_template
{

    private $template;

    function __construct($template)
    {
        $this->template = $template;
    }

    public function apply($o)
    {
        $output = array();
        $t = &$this->template;
        $in_key = false;
        $key = array();

        foreach (range(0, strlen($t) - 1) as $i) {

            $c = $t[$i];

            if (!$in_key) {

                if ($c == '{') {
                    $in_key = true;
                } else {
                    $output[] = $c;
                }

            } else {

                if ($c == '}') {
                    $k = implode('', $key);
                    $key = array();

                    $in_key = false;


                    if (is_object($o) && property_exists(get_class($o), $k)) {
                        $v = $o->$k;
                        $output[] = $v;
                    } else if (is_array($o) && key_exists($o, $k)) {
                        $v = $o->$k;
                        $output[] = $v;
                    } else {
                        $output[] = "\$$k";
                    }

                } else {
                    $key[] = $c;
                }
            }

        }


        return implode("", $output);
    }
}