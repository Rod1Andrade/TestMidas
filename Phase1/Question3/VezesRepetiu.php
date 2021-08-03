<?php
/** *********************************************************************************************
 * Task: Vezes Repetiu 
 * @author Rodrigo Moreira Pires de Andrade
 * ********************************************************************************************* */

/**
 * @param array $array The array wich gonna recive the values
 * @param int $limit The quantity of rand values wich the array is gonna support.
 * @param int $minimumRange The minimum range of random values.
 * @param int $maxRange The max range of random values.
 */
function fillRandValues(array &$array, int $limit = 20, int $minimumRange = 1, int $maxRange = 10): void
{
    for($i = 0; $i < $limit; $i++) {
        $array[] = rand($minimumRange, $maxRange);        
    }
};


/**
 * Times a value repeat inside a give array.
 * 
 * @param int $biggestValueOcurrency The quantity of times this $biggestOcurrency appears.
 * @param int $biggestOcurrency The value which appears more times.
 * @param array $base array with different integer values
 */
function timesRepeat(int &$biggestValueOcurrency, int &$biggestOcurrency, array $base): void
{
    $groupValues = array_count_values($base);
    $biggestOcurrency = max($groupValues);
    $biggestValueOcurrency = array_search($biggestOcurrency, $groupValues);
};

#### Function Executions

# Fill array with rand values
$array = array();
fillRandValues($array);

# Separate the valeu of the biggest ocurrency
$biggestOcurrency = 0;
$biggestValueOcurrency = 0;

timesRepeat($biggestValueOcurrency, $biggestOcurrency, $array);
echo "O número que mais se repete é o {$biggestValueOcurrency}.\nEle se repete {$biggestOcurrency} vezes.";
