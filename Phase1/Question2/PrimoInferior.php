<?php
/** *********************************************************************************************
 * Task: Primo Inferior
 * @author Rodrigo Moreira Pires de Andrade
 * ********************************************************************************************* */
/**
 * @param int $primo
 * @return int o maior primo inferior.
 */
function primoInferior(int $primo)
{
    if ($primo < 0) return 0;

    for ($base = $primo - 1; $base > 1; $base--) {
        $flag = 0;
        for ($i = 2; $i <= $base / 2; $i++) {
            if ($base % $i == 0) {
                $flag = 1;
                break;
            }
        }

        if(!$flag)
            return $base;
    }

    return $primo;
}

# Function Executions
echo "Número 10 = ". primoInferior(10)."\n";
echo "Número 30 = ". primoInferior(30)."\n";
