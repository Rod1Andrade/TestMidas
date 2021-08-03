<?php
/** *********************************************************************************************
 * Task: Seculo Ano
 * @author Rodrigo Moreira Pires de Andrade
 * ********************************************************************************************* */

/**
 * Calcula o seculo dado um ano
 * @param int $ano
 */
function seculoAno(int $ano)
{
    return $ano % 100 ? intval($ano / 100)  + 1: intval($ano / 100);
};


# Function Executions
echo "Ano 1905 = século ". seculoAno(1905)."\n";
echo "Ano 1700 = século ". seculoAno(1700)."\n";
