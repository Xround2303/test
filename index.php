<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->IncludeComponent("vendor:test", ".default", [
    "IBLOCK_ID" => 2,
    "CACHE_TIME" => 3600
]);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
