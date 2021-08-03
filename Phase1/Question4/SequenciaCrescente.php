<?php

/** *********************************************************************************************
 * Task: Sequencia Crescente
 * @author Rodrigo Moreira Pires de Andrade
 * ********************************************************************************************* */

 /**
  * Check if gived array is on sequence
  * @param array $array
  * @return bool true if are is sequence and false otherwise.
  */
function isSequence(array $array): bool
{   
    for($i = 0; $i < count($array) - 1; $i++) {
        if($array[$i] >= $array[$i + 1])
            return false;
    }

    return true;
}

/**
 * Check if is possible have a squence remove an element.
 * @param  array $array
 * @return true if is possible has a sequence and false otherwise.
 */
function isSequenceIfRemoveOne(array $array): bool
{
    if(isSequence($array)) return true;

    for($i = 0; $i < count($array); $i++) {
        $copy = $array;
        unset($copy[$i]);

        if(isSequence(array_values($copy))) {
            return true;
        }
    }

    return false;
}

# Funtios Execution
// Teste cases
// [1, 3, 2, 1]  false
var_dump(false == isSequenceIfRemoveOne([1, 3, 2, 1]));

// [1, 3, 2]  true
var_dump(true == isSequenceIfRemoveOne([1, 3, 2]));

// [1, 2, 1, 2]  false
var_dump(false == isSequenceIfRemoveOne([1, 2, 1, 2]));

// [3, 6, 5, 8, 10, 20, 15] false
var_dump(false == isSequenceIfRemoveOne([3, 6, 5, 8, 10, 20, 15]));

// [1, 1, 2, 3, 4, 4] false
var_dump(false == isSequenceIfRemoveOne([1, 1, 2, 3, 4, 4]));

// [1, 4, 10, 4, 2] false
var_dump(false == isSequenceIfRemoveOne([1, 4, 10, 4, 2]));

// [10, 1, 2, 3, 4, 5] true
var_dump(true == isSequenceIfRemoveOne([10, 1, 2, 3, 4, 5]));

// [1, 1, 1, 2, 3] false
var_dump(false == isSequenceIfRemoveOne([1, 1, 1, 2, 3]));

// [0, -2, 5, 6] true
var_dump(true == isSequenceIfRemoveOne([0, -2, 5, 6]));

// [1, 2, 3, 4, 5, 3, 5, 6] false
var_dump(false == isSequenceIfRemoveOne([1, 2, 3, 4, 5, 3, 5, 6]));

// [40, 50, 60, 10, 20, 30] false
var_dump(false == isSequenceIfRemoveOne([40, 50, 60, 10, 20, 30]));

// [1, 1] true
var_dump(true == isSequenceIfRemoveOne([1, 1]));

// [1, 2, 5, 3, 5] true
var_dump(true == isSequenceIfRemoveOne([1, 2, 5, 3, 5]));

// [1, 2, 5, 5, 5] false
var_dump(false == isSequenceIfRemoveOne([1, 2, 5, 5, 5]));

// [10, 1, 2, 3, 4, 5, 6, 1] false
var_dump(false == isSequenceIfRemoveOne([10, 1, 2, 3, 4, 5, 6, 1]));

// [1, 2, 3, 4, 3, 6] true
var_dump(true == isSequenceIfRemoveOne([1, 2, 3, 4, 3, 6]));

// [1, 2, 3, 4, 99, 5, 6] true
var_dump(true == isSequenceIfRemoveOne([1, 2, 3, 4, 99, 5, 6]));

// [123, -17, -5, 1, 2, 3, 12, 43, 45] true
var_dump(true == isSequenceIfRemoveOne([123, -17, -5, 1, 2, 3, 12, 43, 45]));

// [3, 5, 67, 98, 3] true
var_dump(true == isSequenceIfRemoveOne([3, 5, 67, 98, 3]));
