<?php
if( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();
use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;

class SynchCurrency extends CBitrixComponent
{
    public $MessageError = array();
    public $MessageSend = array();


    #Перезаписываем $this->arParams (Удаляем не нужное)
    public function onPrepareComponentParams($params)
    {
        $result = array(
            "CACHE_TIME"             => $params['CACHE_TIME'],
            "OFFICE_IBLOCK_ID"       => $params['OFFICE_IBLOCK_ID'],
            "CBR_IBLOCK_ID"          => $params['CBR_IBLOCK_ID'],
        );
        return $result;
    }

    #Проверяет подключение необходиимых модулей
    protected function checkModules()
    {
        if (!Loader::includeModule('iblock')){
            throw new Main\LoaderException('Ошибка модуля iblock');
        }
    }

    protected function load_kurs_cbr()
    {

        $kurs_file=$_SERVER['DOCUMENT_ROOT'].$this->GetPath().'/log/kurs.txt';
        $lastModified=filemtime($kurs_file);

		//Проверяем курсы ЦБ не чаще 10 сек.
        if (date("Y-m-d H:i:s",$lastModified) > date("Y-m-d H:i:s",time()-10)) {
            return false;
        }

        //Если на сегодня нет, то за послединй день
        define("tsKurs","00:00:00");        # Время смены курса центральным банком
        $arCur = array();

        // Проверяем наличие курcа на сегодняшний день
        $rsElementToday = CIBlockElement::GetList(
            Array("SORT"=>"ASC"),
            Array("IBLOCK_ID"=>$this->arParams['CBR_IBLOCK_ID'], ">DATE_CREATE"=>ConvertTimeStamp(time())),
            false,
            false,
            Array("IBLOCK_ID", "ID", "NAME", "DATE_CREATE")
        );
        while ($arElementToday = $rsElementToday->Fetch()) {
            $arElementTodayId = $arElementToday['ID'];
        }


        if (!$arElementTodayId && (date("H:i:s")>tsKurs)){
            $content = $this->get_content();
            if (!$content) return;
            $pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i";
            preg_match_all($pattern, $content, $out1, PREG_SET_ORDER);
            $el = new CIBlockElement;
            $PROP = array();
            foreach($out1 as $cur1)
            {
                if($cur1[2] == 840) $PROP['ATT_USD'] = str_replace(",",".",$cur1[4]);
                if($cur1[2] == 978) $PROP['ATT_EUR'] = str_replace(",",".",$cur1[4]);
                if($cur1[2] == 826) $PROP['ATT_GBP'] = str_replace(",",".",$cur1[4]);
                if($cur1[2] == 756) $PROP['ATT_CHF'] = str_replace(",",".",$cur1[4]);
                if($cur1[2] == 392) $PROP['ATT_JPY'] = str_replace(",",".",$cur1[4]);
                if($cur1[2] == 156) $PROP['ATT_CNY'] = str_replace(",",".",$cur1[4]);
                /*if($cur1[2] == 392) $JPY    = str_replace(",",".",$cur1[4]);
                $PROP['ATT_JPY'] = $JPY / 100;*/
            }

            //Записываем курсы в файл
            $curForFile = $PROP['ATT_USD'].'|'.$PROP['ATT_EUR'].'|'.$PROP['ATT_GBP'].'|'.$PROP['ATT_CHF'].'|'.$PROP['ATT_JPY'].'|'.$PROP['ATT_CNY'];
            file_put_contents($kurs_file, $curForFile);

            //сравниваем занчения для статуса
            $rsOldCurrency = CIBlockElement::GetList(
                Array("TIMESTAMP_X"=>"DESC"),
                Array("IBLOCK_ID"=> $this->arParams['CBR_IBLOCK_ID']),
                false,
                Array("nPageSize"=>1),
                Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_GBP", "PROPERTY_ATT_USD", "PROPERTY_ATT_EUR", "PROPERTY_ATT_CHF", "PROPERTY_ATT_JPY", "PROPERTY_ATT_CNY", "PROPERTY_ATT_STATUS_USD", "PROPERTY_ATT_STATUS_EUR", "PROPERTY_ATT_STATUS_GBP", "PROPERTY_ATT_STATUS_CHF", "PROPERTY_ATT_STATUS_JPY", "PROPERTY_ATT_STATUS_CNY")   
                );
            while ($arOldCurrency = $rsOldCurrency->Fetch()){
                $oldCurrency[] = $arOldCurrency;
            }

                $PROP['ATT_STATUS_USD'] = ($oldCurrency['0']['PROPERTY_ATT_USD_VALUE'] < $PROP['ATT_USD'])?'>':'<';           
                $PROP['ATT_STATUS_EUR'] = ($oldCurrency['0']['PROPERTY_ATT_EUR_VALUE'] < $PROP['ATT_EUR'])?'>':'<';
                $PROP['ATT_STATUS_GBP'] = ($oldCurrency['0']['PROPERTY_ATT_GBP_VALUE'] < $PROP['ATT_GBP'])?'>':'<';
                $PROP['ATT_STATUS_CHF'] = ($oldCurrency['0']['PROPERTY_ATT_CHF_VALUE'] < $PROP['ATT_CHF'])?'>':'<';
                $PROP['ATT_STATUS_JPY'] = ($oldCurrency['0']['PROPERTY_ATT_JPY_VALUE'] < $PROP['ATT_JPY'])?'>':'<';
                $PROP['ATT_STATUS_CNY'] = ($oldCurrency['0']['PROPERTY_ATT_CNY_VALUE'] < $PROP['ATT_CNY'])?'>':'<';

            $arLoadProductArray = Array(
              "IBLOCK_SECTION_ID" => false,          
              "IBLOCK_ID"      => $this->arParams['CBR_IBLOCK_ID'],
              "PROPERTY_VALUES"=> $PROP,
              "NAME"           => date("Y-m-d",time()),
              // "DATE_ACTIVE_FROM"=> date('d-m-Y H:i:s',time()),
              "ACTIVE"         => "Y",            
              "PREVIEW_TEXT"   => "",
              "DETAIL_TEXT"    => ""
              );
            if($PRODUCT_ID = $el->Add($arLoadProductArray));

        }

        $rsCurrency = CIBlockElement::GetList(
            Array("TIMESTAMP_X"=>"DESC"),
            Array("IBLOCK_ID"=> $this->arParams['CBR_IBLOCK_ID']),
            false,
            Array("nPageSize"=>1),
            Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_GBP", "PROPERTY_ATT_USD", "PROPERTY_ATT_EUR", "PROPERTY_ATT_CHF", "PROPERTY_ATT_JPY", "PROPERTY_ATT_CNY", "PROPERTY_ATT_STATUS_USD", "PROPERTY_ATT_STATUS_EUR", "PROPERTY_ATT_STATUS_GBP", "PROPERTY_ATT_STATUS_CHF", "PROPERTY_ATT_STATUS_JPY", "PROPERTY_ATT_STATUS_CNY")
        );

        while ($arCurrency = $rsCurrency->Fetch()) {
            $arCur['USD'] = array('VALUE'=>$arCurrency['PROPERTY_ATT_USD_VALUE'],"STATUS"=>$arCurrency['PROPERTY_ATT_STATUS_USD_VALUE']);
            $arCur['EUR'] = array('VALUE'=>$arCurrency['PROPERTY_ATT_EUR_VALUE'],"STATUS"=>$arCurrency['PROPERTY_ATT_STATUS_EUR_VALUE']);
            $arCur['GBP'] = array('VALUE'=>$arCurrency['PROPERTY_ATT_GBP_VALUE'],"STATUS"=>$arCurrency['PROPERTY_ATT_STATUS_GBP_VALUE']);
            $arCur['CHF'] = array('VALUE'=>$arCurrency['PROPERTY_ATT_CHF_VALUE'],"STATUS"=>$arCurrency['PROPERTY_ATT_STATUS_CHF_VALUE']);
            $arCur['JPY'] = array('VALUE'=>$arCurrency['PROPERTY_ATT_JPY_VALUE'],"STATUS"=>$arCurrency['PROPERTY_ATT_STATUS_JPY_VALUE']);
            $arCur['CNY'] = array('VALUE'=>$arCurrency['PROPERTY_ATT_CNY_VALUE'],"STATUS"=>$arCurrency['PROPERTY_ATT_STATUS_CNY_VALUE']);
        }

        return $arCur;
        
    }

    protected function get_content()
    {
        // Формируем сегодняшнюю дату
        $date = date("d/m/Y");
        // Формируем ссылку
        $link = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=".$date;
        // Загружаем HTML-страницу
        $fd = @fopen($link, "r");
        $text="";
        if (!$fd){
            array_push($this->MessageError, "<h3>Сервер ЦБ не отвечает!</h3>");
            $text = false;
        } 
        else
        {
          // Чтение содержимого файла в переменную $text
          while (!feof ($fd)) $text .= @fgets($fd, 4096);
          // Закрыть открытый файловый дескриптор
          @fclose ($fd);
        }
        return $text;
    }



    protected function getCsv($file)
    {
        $arCurrency = array();
        $row = 1;
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                if ($num == 6){
                        $row++;
                    for ($c=0; $c < $num; $c++) {
                        $arCurrency[$data['0']]["CODE"] = $data['0'];
                        $arCurrency[$data['0']]["NAME"] = $data['1'];
                        $arCurrency[$data['0']]["DATE"] = $data['2'];
                        $arCurrency[$data['0']][$data['3']]["BUY"] = $data['4'];
                        $arCurrency[$data['0']][$data['3']]["SELL"] = $data['5'];
                        $arCurrency[$data['0']]["CODE"] = $data['0'];
                    }
                }                
            }
            fclose($handle);
        }
        return $arCurrency;
    }


    protected function csvToIblock()
    {
        //Дата изменения файла
        $file = $_SERVER['DOCUMENT_ROOT']."/currency/cur.csv";
        $fileModify = filectime($file);
        $this->arResult['MODIFY_DATE_FILE'] = $fileModify;

        //Дата изменения элементов
        $rsOffices = CIBlockElement::GetList(
            Array("TIMESTAMP_X"=>"DESC"),
            Array("IBLOCK_ID"=>$this->arParams['OFFICE_IBLOCK_ID'], 'ACTIVE'=>'Y'),
            false,
            Array("nPageSize"=>1),
            Array("IBLOCK_ID", "ID", "NAME", "TIMESTAMP_X")
        );
        while($arOffices = $rsOffices->Fetch()){
            $arOffice = $arOffices;
        }
        $iblockModified = strtotime($arOffice['TIMESTAMP_X']) ;

        // Если изменились элементы, создаем html таблицу с курсами
        $table = $_SERVER['DOCUMENT_ROOT']."/currency_rates_table.html";
        $tableModify = filectime($table);

        if ($tableModify < $iblockModified && $tableModify < time()-10) {
            $this->createHtml($table);
        }

        //Проверяем изменение курса
        $logFile = $_SERVER['DOCUMENT_ROOT']."/currency/last_modify.txt";
        $handle = @fopen($logFile, "r");
        $fileLastModify = fgets($handle);
        fclose($handle);

        if ($fileModify == $fileLastModify) return;

        file_put_contents($logFile, $fileModify);

        $arCurrency = $this->getCsv($file);
        $el = new CIBlockElement;
        
        if(!empty($arCurrency)){
            foreach ($arCurrency as $arItem) {
                $elementId = 0;
                $rsElement = CIBlockElement::GetList(
                    Array("SORT"=>"ASC"),
                    Array("IBLOCK_ID"=> $this->arParams['OFFICE_IBLOCK_ID'], "NAME"=>$arItem['NAME']),
                    false,
                    false,
                    Array("IBLOCK_ID", "ID", "NAME")
                );

                while($arElement = $rsElement->Fetch()){
                    $elementId = $arElement['ID'];
                }

                $PROP = array();
                $PROP['ATT_BUY_USD'] = $arItem['USD']['BUY'];
                $PROP['ATT_SELL_USD'] = $arItem['USD']['SELL'];
                $PROP['ATT_BUY_EUR'] = $arItem['EUR']['BUY'];
                $PROP['ATT_SELL_EUR'] = $arItem['EUR']['SELL'];
                $PROP['ATT_BUY_GBP'] = $arItem['GBP']['BUY'];
                $PROP['ATT_SELL_GBP'] = $arItem['GBP']['SELL'];
                $PROP['ATT_BUY_CHF'] = $arItem['CHF']['BUY'];
                $PROP['ATT_SELL_CHF'] = $arItem['CHF']['SELL'];
                $PROP['ATT_BUY_JPY'] = $arItem['JPY']['BUY'];
                $PROP['ATT_SELL_JPY'] = $arItem['JPY']['SELL'];
                $PROP['ATT_BUY_CNY'] = $arItem['CNY']['BUY'];
                $PROP['ATT_SELL_CNY'] = $arItem['CNY']['SELL'];
                $PROP['ATT_CODE'] = $arItem['CODE'];
                $PROP['ATT_DATE'] = $arItem['DATE'];
                if($elementId){
                    //добавляем статусы
                    $rsOldElement = CIBlockElement::GetList(
                        Array("SORT"=>"ASC"),
                        Array("IBLOCK_ID"=> $this->arParams['OFFICE_IBLOCK_ID'], "ID"=>$elementId),
                        false,
                        false,
                        Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_BUY_GBP", "PROPERTY_ATT_BUY_USD", "PROPERTY_ATT_BUY_EUR", "PROPERTY_ATT_BUY_CHF", "PROPERTY_ATT_BUY_JPY", "PROPERTY_ATT_BUY_CNY", "PROPERTY_ATT_STATUS_USD", "PROPERTY_ATT_STATUS_EUR", "PROPERTY_ATT_STATUS_GBP", "PROPERTY_ATT_STATUS_CHF", "PROPERTY_ATT_STATUS_JPY", "PROPERTY_ATT_STATUS_CNY", "PROPERTY_ATT_ADDRESS", "PROPERTY_ATT_PHONE","PROPERTY_EN_OFFICE_NAME")
                    );
                    while($arOldElement = $rsOldElement->Fetch()){
                        if($PROP['ATT_BUY_USD'] != $arOldElement['PROPERTY_ATT_BUY_USD_VALUE']){
                            $PROP['ATT_STATUS_USD'] = ($PROP['ATT_BUY_USD'] < $arOldElement['PROPERTY_ATT_BUY_USD_VALUE'])?'>':'<';
                        } else {$PROP['ATT_STATUS_USD'] = $arOldElement['PROPERTY_ATT_STATUS_USD_VALUE'];}
                        if($PROP['ATT_BUY_EUR'] != $arOldElement['PROPERTY_ATT_BUY_EUR_VALUE']){
                            $PROP['ATT_STATUS_EUR'] = ($PROP['ATT_BUY_EUR'] < $arOldElement['PROPERTY_ATT_BUY_EUR_VALUE'])?'>':'<';
                        } else {$PROP['ATT_STATUS_EUR'] = $arOldElement['PROPERTY_ATT_STATUS_EUR_VALUE'];}
                        if($PROP['ATT_BUY_GBP'] != $arOldElement['PROPERTY_ATT_BUY_GBP_VALUE']){
                            $PROP['ATT_STATUS_GBP'] = ($PROP['ATT_BUY_GBP'] < $arOldElement['PROPERTY_ATT_BUY_GBP_VALUE'])?'>':'<';
                        } else {$PROP['ATT_STATUS_GBP'] = $arOldElement['PROPERTY_ATT_STATUS_GBP_VALUE'];}
                        if($PROP['ATT_BUY_CHF'] != $arOldElement['PROPERTY_ATT_BUY_CHF_VALUE']){
                            $PROP['ATT_STATUS_CHF'] = ($PROP['ATT_BUY_CHF'] < $arOldElement['PROPERTY_ATT_BUY_CHF_VALUE'])?'>':'<';
                        } else {$PROP['ATT_STATUS_CHF'] = $arOldElement['PROPERTY_ATT_STATUS_CHF_VALUE'];}
                        if($PROP['ATT_BUY_JPY'] != $arOldElement['PROPERTY_ATT_BUY_JPY_VALUE']){
                            $PROP['ATT_STATUS_JPY'] = ($PROP['ATT_BUY_JPY'] < $arOldElement['PROPERTY_ATT_BUY_JPY_VALUE'])?'>':'<';
                        } else {$PROP['ATT_STATUS_JPY'] = $arOldElement['PROPERTY_ATT_STATUS_JPY_VALUE'];}
                        if($PROP['ATT_BUY_CNY'] != $arOldElement['PROPERTY_ATT_BUY_CNY_VALUE']){
                            $PROP['ATT_STATUS_CNY'] = ($PROP['ATT_BUY_CNY'] < $arOldElement['PROPERTY_ATT_BUY_CNY_VALUE'])?'>':'<';
                        } else {$PROP['ATT_STATUS_CNY'] = $arOldElement['PROPERTY_ATT_STATUS_CNY_VALUE'];}

                        $PROP['ATT_ADDRESS'] = $arOldElement['PROPERTY_ATT_ADDRESS_VALUE'];
                        $PROP['ATT_PHONE'] = $arOldElement['PROPERTY_ATT_PHONE_VALUE'];
						$PROP['EN_OFFICE_NAME'] = $arOldElement['PROPERTY_EN_OFFICE_NAME_VALUE'];
                    }
                    $arLoadProductArray = Array(
                      "IBLOCK_SECTION_ID" => false,          
                      "IBLOCK_ID"      => $this->arParams['OFFICE_IBLOCK_ID'],
                      "PROPERTY_VALUES"=> $PROP,
                      "NAME"           => $arItem['NAME'],
                      "ACTIVE"         => "Y",            
                      "PREVIEW_TEXT"   => "",
                      "DETAIL_TEXT"    => ""
                      );
                    if($PRODUCT_ID = $el->Update($elementId, $arLoadProductArray));

                } else {
                    $arLoadProductArray = Array(
                      "IBLOCK_SECTION_ID" => false,          
                      "IBLOCK_ID"      => $this->arParams['OFFICE_IBLOCK_ID'],
                      "PROPERTY_VALUES"=> $PROP,
                      "NAME"           => $arItem['NAME'],
                      "ACTIVE"         => "Y",            
                      "PREVIEW_TEXT"   => "",
                      "DETAIL_TEXT"    => ""
                      );
                    if($PRODUCT_ID = $el->Add($arLoadProductArray));

                }
                

            }

        }

    }

    protected function createHtml($file) {
        $curCsv = $_SERVER['DOCUMENT_ROOT']."/currency/cur.csv";
        $ts = filectime($curCsv);
        $dateTime = new DateTime("@$ts");
        $date = $dateTime->format('d.m.y');
        $content = <<<HEADER
<!DOCTYPE html>
<html>
<head>
    <title>Курсы обмена наличной иностранной валюты, установленные банком на $date</title>
    <style type="text/css">
        table {border-collapse: collapse;}
        td, th {padding: 5px 10px; border-bottom: 1px #999 solid;}
        th {text-align: left; border-width: 2px;}
        tr:hover td {background-color: #F3F3F3; border-color: #555;}
    </style>
</head>
<body>
HEADER;

        $iblockId = 114;
        $rsCities = CIBlockElement::GetList(
            array(),
            Array('IBLOCK_ID'=>$iblockId, 'ACTIVE'=>'Y'),
            false,
            false,
            Array('ID', 'NAME')
        );
        while ($arCity = $rsCities->Fetch()) {
            $cities[] = $arCity;
        }

        foreach ($cities as $city) {

            $name = $city['NAME'];
            $content = $content.<<<CITY

<h2>$name</h2>
<table>
<thead>
<tr><th>код</th><th>единиц</th><th>название валюты</th><th>покупка</th><th>продажа</th></tr>
</thead>
CITY;
            $arCur = $this->load_kurs_csv($city['ID'], true);
            foreach ($arCur as $var => $cur) {
                if ($cur['BUY'] > 0) {
                    $buy = str_replace('.', ',', $cur['BUY']);
                    $sell = str_replace('.', ',', $cur['SELL']);
                    $name = $cur['NAME'];
                    $count = $cur['COUNT'];
                    $content = $content.<<<CUR

<tr><td>$var</td><td>$count</td><td>$name</td><td>$buy</td><td>$sell</td></tr>
CUR;
                }
            }

            $content = $content.<<<ENDTABLE

</table>
ENDTABLE;

        }

        $content = $content.<<<FOOTER

</body>
</html>
FOOTER;

        file_put_contents($file, $content);

    }

    protected function load_kurs_csv($selectCity, $isCreateHtml)
    {
        if (!isset($isCreateHtml)) {
            $ofId = \GarbageStorage::get('OfficeId');
        }
        if(!empty($ofId)){
            $rsOffices = CIBlockElement::GetList(
                Array("SORT"=>"ASC"),
                Array("IBLOCK_ID"=>$this->arParams['OFFICE_IBLOCK_ID'], "ID"=>$ofId),
                false,
                false,
                Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_BUY_GBP", "PROPERTY_ATT_BUY_USD", "PROPERTY_ATT_BUY_EUR", "PROPERTY_ATT_BUY_CHF", "PROPERTY_ATT_BUY_JPY", "PROPERTY_ATT_BUY_CNY", "PROPERTY_ATT_SELL_USD", "PROPERTY_ATT_SELL_EUR", "PROPERTY_ATT_SELL_GBP", "PROPERTY_ATT_SELL_CHF", "PROPERTY_ATT_SELL_JPY", "PROPERTY_ATT_SELL_CNY", "PROPERTY_ATT_STATUS_USD", "PROPERTY_ATT_STATUS_EUR", "PROPERTY_ATT_STATUS_GBP", "PROPERTY_ATT_STATUS_CHF", "PROPERTY_ATT_STATUS_JPY", "PROPERTY_ATT_STATUS_CNY")
            );
            while($arOffice = $rsOffices->Fetch()){
                return array('USD'=>array('BUY'=>$arOffice['PROPERTY_ATT_BUY_USD_VALUE'],'SELL'=>$arOffice['PROPERTY_ATT_SELL_USD_VALUE'],'STATUS'=>$arOffice['PROPERTY_ATT_STATUS_USD_VALUE']),
                             'EUR'=>array('BUY'=>$arOffice['PROPERTY_ATT_BUY_EUR_VALUE'],'SELL'=>$arOffice['PROPERTY_ATT_SELL_EUR_VALUE'],'STATUS'=>$arOffice['PROPERTY_ATT_STATUS_EUR_VALUE']),
                             'GBP'=>array('BUY'=>$arOffice['PROPERTY_ATT_BUY_GBP_VALUE'],'SELL'=>$arOffice['PROPERTY_ATT_SELL_GBP_VALUE'],'STATUS'=>$arOffice['PROPERTY_ATT_STATUS_GBP_VALUE']),
                             'CHF'=>array('BUY'=>$arOffice['PROPERTY_ATT_BUY_CHF_VALUE'],'SELL'=>$arOffice['PROPERTY_ATT_SELL_CHF_VALUE'],'STATUS'=>$arOffice['PROPERTY_ATT_STATUS_CHF_VALUE']),
                             'JPY'=>array('BUY'=>$arOffice['PROPERTY_ATT_BUY_JPY_VALUE'],'SELL'=>$arOffice['PROPERTY_ATT_SELL_JPY_VALUE'],'STATUS'=>$arOffice['PROPERTY_ATT_STATUS_JPY_VALUE']),
                             'CNY'=>array('BUY'=>$arOffice['PROPERTY_ATT_BUY_CNY_VALUE'],'SELL'=>$arOffice['PROPERTY_ATT_SELL_CNY_VALUE'],'STATUS'=>$arOffice['PROPERTY_ATT_STATUS_CNY_VALUE']),
                            );
            } 

        } else {
            if (!isset($isCreateHtml)) {
                session_start();
                if (isset($_SESSION['city'])) {
                    $selectCity = $_SESSION['city'];
                } else {
                    $selectCity = 399;
                }
            }
            $rsElements = CIBlockElement::GetList(
                Array("SORT"=>"ASC"),
                Array("IBLOCK_ID"=> "114"/*$this->arParams['IBLOCK_ID']*/,"ID"=>$selectCity, 'ACTIVE'=>'Y'),
                false,
                false,
                Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_CODE")
            );

            while($arElement = $rsElements->Fetch()){
                $arOffice = array();
                foreach ($arElement["PROPERTY_ATT_CODE_VALUE"] as $code) {
                    $rsOffices = CIBlockElement::GetList(
                        Array("SORT"=>"ASC"),
                        Array("IBLOCK_ID"=>$this->arParams['OFFICE_IBLOCK_ID'], "PROPERTY_ATT_CODE"=>$code, 'ACTIVE'=>'Y' ),
                        false,
                        false,
                        Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_BUY_GBP", "PROPERTY_ATT_BUY_USD", "PROPERTY_ATT_BUY_EUR", "PROPERTY_ATT_BUY_CHF", "PROPERTY_ATT_BUY_JPY", "PROPERTY_ATT_BUY_CNY", "PROPERTY_ATT_SELL_USD", "PROPERTY_ATT_SELL_EUR", "PROPERTY_ATT_SELL_GBP", "PROPERTY_ATT_SELL_CHF", "PROPERTY_ATT_SELL_JPY", "PROPERTY_ATT_SELL_CNY", "PROPERTY_ATT_STATUS_USD", "PROPERTY_ATT_STATUS_EUR", "PROPERTY_ATT_STATUS_GBP", "PROPERTY_ATT_STATUS_CHF", "PROPERTY_ATT_STATUS_JPY", "PROPERTY_ATT_STATUS_CNY")
                    );
                    while($arOffices = $rsOffices->Fetch()){
                        $arOffice[$arOffices['ID']] = $arOffices;
                    }
                }
            }

            //Минимальные значения валюты
            $arUSD = array('BUY' => 0);
            $arEUR = array('BUY' => 0);
            $arCHF = array('BUY' => 0);
            $arGBP = array('BUY' => 0);
            $arJPY = array('BUY' => 0);
            $arCNY = array('BUY' => 0);
            $arCur = array();

            foreach($arOffice as $key=>$office){

                if ( ($arUSD['BUY'] < $office['PROPERTY_ATT_BUY_USD_VALUE']) || ($arUSD['BUY'] == 0) ){
                    $arUSD['BUY'] = $office['PROPERTY_ATT_BUY_USD_VALUE'];
                    $arUSD['SELL'] = $office['PROPERTY_ATT_SELL_USD_VALUE'];
                    $arUSD['STATUS'] = $office['PROPERTY_ATT_STATUS_USD_VALUE'];
                    $arUSD['NAME'] = 'Доллар США';
                    $arUSD['COUNT'] = '1';
                }
                if ( ($arEUR['BUY'] < $office['PROPERTY_ATT_BUY_EUR_VALUE']) || ($arEUR['BUY'] == 0) ){
                    $arEUR['BUY'] = $office['PROPERTY_ATT_BUY_EUR_VALUE'];
                    $arEUR['SELL'] = $office['PROPERTY_ATT_SELL_EUR_VALUE'];
                    $arEUR['STATUS'] = $office['PROPERTY_ATT_STATUS_EUR_VALUE'];
                    $arEUR['NAME'] = 'Евро';
                    $arEUR['COUNT'] = '1';
                }
                if ( ($arGBP['BUY'] < $office['PROPERTY_ATT_BUY_GBP_VALUE']) || ($arGBP['BUY'] == 0) ){
                    $arGBP['BUY'] = $office['PROPERTY_ATT_BUY_GBP_VALUE'];
                    $arGBP['SELL'] = $office['PROPERTY_ATT_SELL_GBP_VALUE'];
                    $arGBP['STATUS'] = $office['PROPERTY_ATT_STATUS_GBP_VALUE'];
                    $arGBP['NAME'] = 'Фунт стерлингов Соединенного королевства';
                    $arGBP['COUNT'] = '1';
                }
                if ( ($arCHF['BUY'] < $office['PROPERTY_ATT_BUY_CHF_VALUE']) || ($arCHF['BUY'] == 0) ){
                    $arCHF['BUY'] = $office['PROPERTY_ATT_BUY_CHF_VALUE'];
                    $arCHF['SELL'] = $office['PROPERTY_ATT_SELL_CHF_VALUE'];
                    $arCHF['STATUS'] = $office['PROPERTY_ATT_STATUS_CHF_VALUE'];
                    $arCHF['NAME'] = 'Швейцарский франк';
                    $arCHF['COUNT'] = '1';
                }
                if ( ($arJPY['BUY'] < $office['PROPERTY_ATT_BUY_JPY_VALUE']) || ($arJPY['BUY'] == 0) ){
                    $arJPY['BUY'] = $office['PROPERTY_ATT_BUY_JPY_VALUE'];
                    $arJPY['SELL'] = $office['PROPERTY_ATT_SELL_JPY_VALUE'];
                    $arJPY['STATUS'] = $office['PROPERTY_ATT_STATUS_JPY_VALUE'];
                    $arJPY['NAME'] = 'Японская иена';
                    $arJPY['COUNT'] = '100';
                }
                if ( ($arCNY['BUY'] < $office['PROPERTY_ATT_BUY_CNY_VALUE']) || ($arCNY['BUY'] == 0) ){
                    $arCNY['BUY'] = $office['PROPERTY_ATT_BUY_CNY_VALUE'];
                    $arCNY['SELL'] = $office['PROPERTY_ATT_SELL_CNY_VALUE'];
                    $arCNY['STATUS'] = $office['PROPERTY_ATT_STATUS_CNY_VALUE'];
                    $arCNY['NAME'] = 'Китайский юань';
                    $arCNY['COUNT'] = '10';
                }

            }

            return array('USD'=>$arUSD, 'EUR'=>$arEUR, 'GBP'=>$arGBP, 'CHF'=>$arCHF, 'JPY'=>$arJPY, 'CNY'=>$arCNY);
        }
        
    }



    protected function getResult()
    {
        // $this->arResult['CURRENCY']['CSV'] = $this->load_kurs_csv();
        // $this->arResult['CURRENCY']['CBR'] = $this->load_kurs_cbr();
        $csv = $this->load_kurs_csv();
        $cbr = $this->load_kurs_cbr();
        $this->arResult['CUR']['USD'] = array('USD $', $csv['USD']['BUY'].'/'.$csv['USD']['STATUS'], $csv['USD']['SELL'].'/'.$csv['USD']['STATUS'], $cbr['USD']['VALUE'].'/'.$cbr['USD']['STATUS']);
        $this->arResult['CUR']['EUR'] = array('EUR €', $csv['EUR']['BUY'].'/'.$csv['EUR']['STATUS'], $csv['EUR']['SELL'].'/'.$csv['EUR']['STATUS'], $cbr['EUR']['VALUE'].'/'.$cbr['EUR']['STATUS']);
        $this->arResult['CUR']['GBP'] = array('GBP £', $csv['GBP']['BUY'].'/'.$csv['GBP']['STATUS'], $csv['GBP']['SELL'].'/'.$csv['GBP']['STATUS'], $cbr['GBP']['VALUE'].'/'.$cbr['GBP']['STATUS']);
        $this->arResult['CUR']['CHF'] = array('CHF ₣', $csv['CHF']['BUY'].'/'.$csv['CHF']['STATUS'], $csv['CHF']['SELL'].'/'.$csv['CHF']['STATUS'], $cbr['CHF']['VALUE'].'/'.$cbr['CHF']['STATUS']);
        $this->arResult['CUR']['JPY'] = array('JPY ¥ <sup>1</sup>', $csv['JPY']['BUY'].'/'.$csv['JPY']['STATUS'], $csv['JPY']['SELL'].'/'.$csv['JPY']['STATUS'], $cbr['JPY']['VALUE'].'/'.$cbr['JPY']['STATUS']);
        $this->arResult['CUR']['CNY'] = array('CNY ¥ <sup>2</sup>', $csv['CNY']['BUY'].'/'.$csv['CNY']['STATUS'], $csv['CNY']['SELL'].'/'.$csv['CNY']['STATUS'], $cbr['CNY']['VALUE'].'/'.$cbr['CNY']['STATUS']);

    }

    protected function actionMessage()
    {
        $this->arResult["MESSAGE_ERROR"] = $this->MessageError;
        $this->arResult["MESSAGE_SEND"] = $this->MessageSend;
        foreach($this->arResult['MESSAGE_ERROR'] as $error){
            echo "<p style='color: red;'>{$error}</p>";
        }
        foreach($this->arResult['MESSAGE_SEND'] as $send){
            echo "<p style='color: green;'>{$send}</p>";
        }
    }

    public function executeComponent()
    {
        try{
            // if ($this->startResultCache()) {
                $this -> arResult["COMPONENT_ID"] = 'SC';
                $this -> checkModules();
                $this -> csvToIblock();
                $this -> getResult();
                $this -> actionMessage();


                $this -> includeComponentTemplate();
            // }
        }catch (Exception $e){
            ShowError($e->getMessage());
        }
    }

};
