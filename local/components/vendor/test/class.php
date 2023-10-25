<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Loader;
use Bitrix\Main\Data\Cache;

Loader::includeModule("iblock");

class VendorTestComponent extends CBitrixComponent
{
    protected int $iblockId;

    public function onPrepareComponentParams($arParams)
    {
        $this->iblockId = $arParams['IBLOCK_ID'];
        $arParams["CACHE_TIME"] = $arParams['CACHE_TIME'] ?? 3600;

        return $arParams;
    }

    public function executeComponent()
    {
        $this->arResult = $this->cacheBuildTree();
        $this->includeComponentTemplate();
    }


    protected function cacheBuildTree(): array
    {
        $cacheId = md5($this->iblockId);
        $cacheDir = '/mycomponent_cache/';

        $cache = Cache::createInstance();

        if ($cache->initCache($this->arParams["CACHE_TIME"], $cacheId, $cacheDir)) {
            $result = $cache->getVars();
        }
        elseif ($cache->startDataCache()) {
            $result = $this->buildTree();
            $cache->endDataCache($result);
        }

       return $result ?? [];
    }

    protected function buildTree(): array
    {
        // Если дальше углубляться в рефакторинг, вынес бы в репозиторий выборку данных
        // Репозиторий сконфигурировал бы в ServiceLocator и вызывал бы его здесь
        $collectionElements = $this->getAllElements();
        $collectionSections = $this->getAllSections();

        foreach ($collectionSections->getAll() as $section) {
            $rows[$section->getId()] = [
                "ID" => $section->getId(),
                "NAME" => $section->getName(),
                "ELEMENTS" => [],
            ];
        }

        foreach ($collectionElements->getAll() as $element) {

            foreach ($element->getTagsr() as $tag){
                $tags[] = $tag->getValue();
            }

            if (isset($rows[$element->getIblockSectionId()])) {
                $rows[$element->getIblockSectionId()]["ELEMENTS"][] = [
                    "ID" => $element->getId(),
                    "NAME" => $element->getName(),
                    "TAGS" => implode(", ", $tags ?? []),
                ];
            }
        }

        return $rows ?? [];
    }

    protected function getAllSections(): ?\Bitrix\Main\ORM\Objectify\Collection
    {
        $r = \Bitrix\Iblock\SectionTable::getList([
            'filter' => [
                'IBLOCK_ID' => $this->arParams["IBLOCK_ID"],
            ],
            'select' => [
                'ID',
                'IBLOCK_ID',
                'NAME'
            ],
            'order' => [
                'ID' => 'ASC'
            ],
        ]);

        return $r->fetchCollection();
    }

    protected function getAllElements(): ?\Bitrix\Main\ORM\Objectify\Collection
    {
        /** @var DataManager $iblock */
        $entityIblock = \Bitrix\Iblock\Iblock::wakeUp($this->iblockId)->getEntityDataClass();

        $r = $entityIblock::getList([
            "select" => [
                'ID',
                'NAME',
                "IBLOCK_SECTION_ID",
                "TAGSR",
            ],
        ]);

        return $r->fetchCollection();
    }



}