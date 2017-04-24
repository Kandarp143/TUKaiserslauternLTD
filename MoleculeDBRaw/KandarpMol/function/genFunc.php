<?php
/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/19/2017
 * Time: 10:45 PM
 */

//contains all general funcation

//1.string contains char / word or not
//2.string trim with white space and print space
//3.make substring from string
//4.
/*
 * Funcation for display molecule in propre manner
 * - all number should be in substring
 * - if string start with R ,then Number after R  should not be in substring
 * - if nuber in () then it should not in substring
 *
 * @param $substance molecule title
 * @return formatted string*/
function toSubstanceTitle($substance)
{
    $left = '';
    $right = '';

    //if string start with R
    if (0 === strpos($substance, 'R')) {
        //getting next char with index
        preg_match('~[a-z]~i', substr($substance, 1), $match, PREG_OFFSET_CAPTURE);

        $left = substr($substance, 0, $match[0][1] + 1);
        $substance = substr($substance, $match[0][1] + 1);
    }
    //if string end with ()
    if (strlen($substance) - 1 === strpos($substance, ')')) {
        //getting next char with index
        $pos = strpos($substance, '(');
        $right = substr($substance, $pos);
        $substance = substr($substance, 0, $pos - 1);
    }
    //make numaric subscript
    $substance = $left . preg_replace('/[0-9]+/', '<sub>$0</sub>', $substance) . $right;


    return $substance;
}

function timeStamp()
{
    $now = new DateTime();
    $now->format('Y-m-d H:i:s');
    return $now->format('d-m-Y H:i:s');
}
