<?php

namespace Rodri\Phase2\App\Repositories;

use PDO;
use Rodri\Phase2\App\Database\Connections\MySqlConnection;
use RuntimeException;

/**
 * Repository - AppRepository
 * @author Rodrigo Andrade
 */
class AppRepository
{
    /**
     * Carrega o conteudo de menu de uma imobiliaria.
     *
     * @param int $imobiliariaId
     * @return array
     */
    public function loadMenuContent(int $imobiliariaId): array
    {
        $pdo = MySqlConnection::getConnection()->pdo();
        $statement = $pdo->prepare("select * from conteudo c WHERE c.imobiliariaID = :id ORDER BY c.ID ASC");

        try {
            $statement->bindValue(':id', $imobiliariaId, PDO::PARAM_INT);
            $statement->execute();

            $response = $statement->fetchAll();
            return $this->buildMenuContentRelation($response);
        } catch (\PDOException $e) {
            throw new RuntimeException($e);
        }

    }

    /**
     * Constroi o relacionamento entre menu base e seu elemento relacionado.
     *
     * @param array $array
     * @return array
     */
    private function buildMenuContentRelation(array $array): array
    {
        $treeContentMenu = array();
        $addedValues = array();

        foreach ($array as $item) {
            if (!empty($treeContentMenu)) {
                foreach ($treeContentMenu as $value) {
                    $this->addSubItemMenu($value->sub, $array, $addedValues);
                }
            }

            if (!isset($addedValues[$item->ID])) {
                $treeContentMenu[$item->ID] = new \stdClass();

                $treeContentMenu[$item->ID]->id = $item->ID;
                $treeContentMenu[$item->ID]->title = $item->Titulo;
                $treeContentMenu[$item->ID]->contentID = $item->ConteudoID;

                $this->buildBaseSubItems($item, $addedValues, $array, $treeContentMenu[$item->ID]);
            }
        }

        $this->clearJustComputedKeys($addedValues, $treeContentMenu);

        return $treeContentMenu;
    }

    /**
     * Adiciona os sub items
     *
     * @param array|null $contentMenu Provavel valor com sub item
     * @param array      $array Array com todos os valores
     * @param array      $adds Array de valores ja adicionados
     */
    private function addSubItemMenu(null|array $contentMenu, array $array, array &$adds): void
    {
        if ($contentMenu != null && count($contentMenu) > 0)
            foreach ($contentMenu as $item)
                if (is_array($item->sub))
                    $this->addSubItemMenu($item->sub, $array, $adds);
                else
                    $this->buildBaseSubItems($item, $adds, $array);
    }

    /**
     * Controi o objeto para o sub item e adiciona o valor ao array de controle
     * de valores ja adicionados.
     *
     * @param mixed $item
     * @param array $adds
     * @param array $array
     * @param mixed $base
     */
    private function buildBaseSubItems(mixed $item, array &$adds, array $array, mixed $base = null)
    {
        $subContent = $this->buildSubContent($item, $adds, $array);

        if (empty($base)) {
            $item->sub = $this->removeNullSubItems($subContent);
        } else {
            $base->sub = $this->removeNullSubItems($subContent);
        }
    }

    /**
     * Controi o sub conteudo com std class e adiciona efetivamente o id
     * dos valores ja adiconados em um array de controle
     *
     * @param mixed $item item de comparacao
     * @param array $adds array de controle
     * @param array $array valores de busca
     * @return array sub conteudo do menu
     */
    private function buildSubContent(mixed $item, array &$adds, array $array): array
    {
        return array_map(function ($value) use ($item, &$adds) {
            if ($value->ConteudoID == ($item->id ?? $item->ID)) {

                $adds[$value->ID] = true;

                $sub = new \stdClass();
                $sub->id = $value->ID;
                $sub->title = $value->Titulo;
                $sub->contentID = $value->ConteudoID;
                $sub->sub = null;

                return $sub;
            }
        }, $array);
    }

    /**
     * Remove os elementos nulos normalmente gerados pelo array_map
     *
     * @param array $subContent
     * @return array
     */
    private function removeNullSubItems(array $subContent): array
    {
        return array_filter($subContent, function ($value) {
            return $value != null;
        });
    }

    /**
     * Remove possiveis elementos que sobraram sem estar em um sub item.
     *
     * @param array $addedValues
     * @param array $treeContentMenu
     */
    private function clearJustComputedKeys(array &$addedValues, array &$treeContentMenu): void
    {
        foreach (array_keys($addedValues) as $addedValues) {
            if (array_key_exists($addedValues, $treeContentMenu)) {
                unset($treeContentMenu[$addedValues]);
            }
        }
    }
}
