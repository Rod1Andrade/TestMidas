<?php

# Database connection
$pdo = new PDO(
    'mysql:host=testephp.infoideias.com.br;dbname=phalcont_teste01',
    'phalcont_teste01',
    'Ph01al98!@#',
    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ]
);

/**
 * Gera sub menus de forma recursiva
 * para garantir uma arvore com possiblidade n-enesima.
 * @param array $subItems
 */
function buildSubMenu(array &$subItems)
{
    foreach ($subItems as $menuItem) {
        if(is_array($menuItem->sub)) {
            buildSubMenu($menuItem->sub);
        } else {
            $menuItem->sub = array_filter($subItems, function($value) use($menuItem) {
                return $value->ConteudoID == $menuItem->ID;
            });
        }
    }
}

/**
 * Conteudo do menu
 * @param int $imobiliariaId
 * @param PDO $pdo
 * @return array
 */
function contentMenu(int $imobiliariaId, PDO $pdo): array
{
    $statement = $pdo->prepare("
            select * from conteudo c WHERE c.imobiliariaID = :id order by c.ConteudoID asc ");
    try {
        $statement->bindValue(':id', $imobiliariaId, PDO::PARAM_INT);
        $statement->execute();

        $response = $statement->fetchAll();

        $menu = array();
        foreach ($response as $item) {
            $item->sub = array_filter($response, function($value) use($item) {
                return $value->ConteudoID == $item->ID;
            });

            # Build sub menu item if alredy have one
            if(!empty($item->sub)) {
                foreach ($item->sub as $itemSub) {
                    if(is_array($itemSub->sub)) {
                        buildSubMenu($itemSub->sub);
                    }
                }
            }

            # Add base on menu array
            if($item->ConteudoID == 0) {
                $menu[] = $item;
            }
        }

        return $menu;
    } catch (PDOException $e) {
        var_dump($e);
        die();
    }
}

/**
 * Constroi HTML
 * @param array $menuArray
 */
function buildMenuHTML(array $menuArray): void
{
    echo "<ul>";
    foreach ($menuArray as $menuItem) {
        echo "<li>{$menuItem->Titulo}</li>";
        if(is_array($menuItem->sub)) {
            buildMenuHTML($menuItem->sub);
        }
    }
    echo "</ul>";
}

# Require statement
$contentMenu = contentMenu(99901, $pdo);

# Build html
buildMenuHTML($contentMenu);
