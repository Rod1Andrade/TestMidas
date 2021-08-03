<?php

/**
 * Calcula o seculo dado um ano
 * @param int $ano
 */
function seculoAno(int $ano) {
    return $ano % 100 ? intval($ano / 100)  + 1: intval($ano / 100);
};