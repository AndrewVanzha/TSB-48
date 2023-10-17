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
                if($cur1[2] == 985) $PROP['ATT_PLN'] = str_replace(",",".",$cur1[4]);
                /*if($cur1[2] == 392) $JPY    = str_replace(",",".",$cur1[4]);
                $PROP['ATT_JPY'] = $JPY / 100;*/
            }

            //Записываем курсы в файл
            $curForFile = $PROP['ATT_USD'].'|'.$PROP['ATT_EUR'].'|'.$PROP['ATT_GBP'].'|'.$PROP['ATT_CHF'].'|'.$PROP['ATT_JPY'].'|'.$PROP['ATT_CNY'].'|'.$PROP['ATT_PLN'];
            file_put_contents($kurs_file, $curForFile);

            //сравниваем занчения для статуса
            $rsOldCurrency = CIBlockElement::GetList(
                Array("TIMESTAMP_X"=>"DESC"),
                Array("IBLOCK_ID"=> $this->arParams['CBR_IBLOCK_ID']),
                false,
                Array("nPageSize"=>1),
                Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_GBP", "PROPERTY_ATT_USD", "PROPERTY_ATT_EUR", "PROPERTY_ATT_CHF", "PROPERTY_ATT_JPY", "PROPERTY_ATT_CNY", "PROPERTY_ATT_PLN", "PROPERTY_ATT_STATUS_USD", "PROPERTY_ATT_STATUS_EUR", "PROPERTY_ATT_STATUS_GBP", "PROPERTY_ATT_STATUS_CHF", "PROPERTY_ATT_STATUS_JPY", "PROPERTY_ATT_STATUS_CNY", "PROPERTY_ATT_STATUS_PLN")
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
            $PROP['ATT_STATUS_PLN'] = ($oldCurrency['0']['PROPERTY_ATT_PLN_VALUE'] < $PROP['ATT_PLN'])?'>':'<';

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
            Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_GBP", "PROPERTY_ATT_USD", "PROPERTY_ATT_EUR", "PROPERTY_ATT_CHF", "PROPERTY_ATT_JPY", "PROPERTY_ATT_CNY", "PROPERTY_ATT_PLN", "PROPERTY_ATT_STATUS_USD", "PROPERTY_ATT_STATUS_EUR", "PROPERTY_ATT_STATUS_GBP", "PROPERTY_ATT_STATUS_CHF", "PROPERTY_ATT_STATUS_JPY", "PROPERTY_ATT_STATUS_CNY", "PROPERTY_ATT_STATUS_PLN")
        );

        while ($arCurrency = $rsCurrency->Fetch()) {
            $arCur['USD'] = array('value'=>$arCurrency['PROPERTY_ATT_USD_VALUE'],"status"=>$arCurrency['PROPERTY_ATT_STATUS_USD_VALUE']);
            $arCur['EUR'] = array('value'=>$arCurrency['PROPERTY_ATT_EUR_VALUE'],"status"=>$arCurrency['PROPERTY_ATT_STATUS_EUR_VALUE']);
            $arCur['GBP'] = array('value'=>$arCurrency['PROPERTY_ATT_GBP_VALUE'],"status"=>$arCurrency['PROPERTY_ATT_STATUS_GBP_VALUE']);
            $arCur['CHF'] = array('value'=>$arCurrency['PROPERTY_ATT_CHF_VALUE'],"status"=>$arCurrency['PROPERTY_ATT_STATUS_CHF_VALUE']);
            $arCur['JPY'] = array('value'=>$arCurrency['PROPERTY_ATT_JPY_VALUE'],"status"=>$arCurrency['PROPERTY_ATT_STATUS_JPY_VALUE']);
            $arCur['CNY'] = array('value'=>$arCurrency['PROPERTY_ATT_CNY_VALUE'],"status"=>$arCurrency['PROPERTY_ATT_STATUS_CNY_VALUE']);
            $arCur['PLN'] = array('value'=>$arCurrency['PROPERTY_ATT_PLN_VALUE'],"status"=>$arCurrency['PROPERTY_ATT_STATUS_PLN_VALUE']);
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
                        $arCurrency[$data['0']]["code"] = $data['0'];
                        $arCurrency[$data['0']]["name"] = $data['1'];
                        $arCurrency[$data['0']]["date"] = $data['2'];
                        $arCurrency[$data['0']]["currency"][$data['3']]["buy"] = $data['4'];
                        $arCurrency[$data['0']]["currency"][$data['3']]["sell"] = $data['5'];
                        $arCurrency[$data['0']]["currency"][$data['3']]["status"] = '>';
                    }
                }
            }
            fclose($handle);
        }
        return $arCurrency;
    }

    public function csvToIblock($only_modify_date = null)
    {
        //время изменения csv-файла с курсами валют
        $fileModify = filectime($_SERVER['DOCUMENT_ROOT']."/currency/cur.csv");

		//время изменения json-файла с курсами валют
        $jsonModify = filectime($_SERVER['DOCUMENT_ROOT']."/currency/currency.json");

		//время изменения html-файла с курсами валют для banki.ru
        $tableModify = filectime($_SERVER['DOCUMENT_ROOT']."/currency_rates_table.html");
		
        $this->arResult['MODIFY_DATE_FILE'] = $jsonModify;
		
        if ($fileModify < $jsonModify) return;

        $arCurrency = $this->getCsv($_SERVER['DOCUMENT_ROOT']."/currency/cur.csv");

        if(!empty($arCurrency)){
			$json = file_get_contents($_SERVER['DOCUMENT_ROOT']."/currency/currency.json");
			$json = json_decode($json, true);
			
			$currency_out = [];
			
            foreach ($arCurrency as $arKey => $arItem) {
				$arItemTmp = $arItem;
				if(!empty($json[$arKey])){
					
					foreach($arItem['currency'] as $key => $currency){
						if(!empty($json[$arKey]['currency'][$key]) && $json[$arKey]['currency'][$key]['buy'] !== $currency['buy']){
							if($json[$arKey]['currency'][$key]['buy'] > $currency['buy']){
								$arItemTmp['currency'][$key]['status'] = '>';
							} else {
								$arItemTmp['currency'][$key]['status'] = '<';
							}
						}
					}
					
				}
				$currency_out[$arKey] = $arItemTmp;
            }
			
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/currency/currency.json", json_encode($currency_out));
            $this->createHtml($_SERVER['DOCUMENT_ROOT']."/currency_rates_table.html");
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
                if ($cur['buy'] > 0) {
                    $buy = str_replace('.', ',', $cur['buy']);
                    $sell = str_replace('.', ',', $cur['sell']);
                    $name = $cur['name'];
                    $count = $cur['count'];
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

    protected function load_kurs_csv($selectCity = null, $isCreateHtml = null)
    {
		$json = file_get_contents($_SERVER['DOCUMENT_ROOT']."/currency/currency.json");
		$json = json_decode($json, true);
		
        if ($isCreateHtml === null) {
            $ofId = \GarbageStorage::get('OfficeId');
        }
        if(!empty($ofId)){
            $rsOffices = CIBlockElement::GetList(
                Array("SORT"=>"ASC"),
                Array("IBLOCK_ID"=>$this->arParams['OFFICE_IBLOCK_ID'], "ID"=>$ofId),
                false,
                false,
                Array("IBLOCK_ID", "ID", "PROPERTY_ATT_CODE")
            );
            while($arOffice = $rsOffices->Fetch()){
				
				return $json[$arOffice['PROPERTY_ATT_CODE_VALUE']]['currency'];
            }
			
        } else {
            if ($isCreateHtml === null) {
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

			$arOffice = array();
            while($arElement = $rsElements->Fetch()){
                foreach ($arElement["PROPERTY_ATT_CODE_VALUE"] as $code) {
					if($selectCity == 399 && $code != 10013) {
						continue;
					}
					
					if($selectCity == 400 && $code != 10017) {
						continue;
					}
                    
					$arOffice[] = $json[$code];
                }
            }

            //Минимальные значения валюты
            $arUSD = array('buy' => 0);
            $arEUR = array('buy' => 0);
            $arCHF = array('buy' => 0);
            $arGBP = array('buy' => 0);
            $arJPY = array('buy' => 0);
            $arCNY = array('buy' => 0);
            $arPLN = array('buy' => 0);
            $arCur = array();

            foreach($arOffice as $key=>$office){

                if ( !empty($office['currency']['USD']) && ($arUSD['buy'] < $office['currency']['USD']['buy'] || ($arUSD['buy'] == 0)) ){
                    $arUSD['buy'] = $office['currency']['USD']['buy'];
                    $arUSD['sell'] = $office['currency']['USD']['sell'];
                    $arUSD['status'] = $office['currency']['USD']['status'];
                    $arUSD['name'] = 'Доллар США';
                    $arUSD['count'] = '1';
                }
                if ( !empty($office['currency']['EUR']) && ($arEUR['buy'] < $office['currency']['EUR']['buy'] || ($arEUR['buy'] == 0)) ){
                    $arEUR['buy'] = $office['currency']['EUR']['buy'];
                    $arEUR['sell'] = $office['currency']['EUR']['sell'];
                    $arEUR['status'] = $office['currency']['EUR']['status'];
                    $arEUR['name'] = 'Евро';
                    $arEUR['count'] = '1';
                }
                if ( !empty($office['currency']['GBP']) && ($arGBP['buy'] < $office['currency']['GBP']['buy'] || ($arGBP['buy'] == 0)) ){
                    $arGBP['buy'] = $office['currency']['GBP']['buy'];
                    $arGBP['sell'] = $office['currency']['GBP']['sell'];
                    $arGBP['status'] = $office['currency']['GBP']['status'];
                    $arGBP['name'] = 'Фунт стерлингов Соединенного королевства';
                    $arGBP['count'] = '1';
                }
                if ( !empty($office['currency']['CHF']) && ($arCHF['buy'] < $office['currency']['CHF']['buy'] || ($arCHF['buy'] == 0)) ){
                    $arCHF['buy'] = $office['currency']['CHF']['buy'];
                    $arCHF['sell'] = $office['currency']['CHF']['sell'];
                    $arCHF['status'] = $office['currency']['CHF']['status'];
                    $arCHF['name'] = 'Швейцарский франк';
                    $arCHF['count'] = '1';
                }
                if ( !empty($office['currency']['JPY']) && ($arJPY['buy'] < $office['currency']['JPY']['buy'] || ($arJPY['buy'] == 0)) ){
                    $arJPY['buy'] = $office['currency']['JPY']['buy'];
                    $arJPY['sell'] = $office['currency']['JPY']['sell'];
                    $arJPY['status'] = $office['currency']['JPY']['status'];
                    $arJPY['name'] = 'Японская иена';
                    $arJPY['count'] = '100';
                }
                if ( !empty($office['currency']['CNY']) && ($arCNY['buy'] < $office['currency']['CNY']['buy'] || ($arCNY['buy'] == 0)) ){
                    $arCNY['buy'] = $office['currency']['CNY']['buy'];
                    $arCNY['sell'] = $office['currency']['CNY']['sell'];
                    $arCNY['status'] = $office['currency']['CNY']['status'];
                    $arCNY['name'] = 'Китайский юань';
                    $arCNY['count'] = '10';
                }
                if ( !empty($office['currency']['PLN']) && ($arPLN['buy'] < $office['currency']['PLN']['buy'] || ($arPLN['buy'] == 0)) ){
                    $arPLN['buy'] = $office['currency']['PLN']['buy'];
                    $arPLN['sell'] = $office['currency']['PLN']['sell'];
                    $arPLN['status'] = $office['currency']['PLN']['status'];
                    $arPLN['name'] = 'Польский злотый';
                    $arPLN['count'] = '1';
                }

            }

            return array('USD'=>$arUSD, 'EUR'=>$arEUR, 'GBP'=>$arGBP, 'CHF'=>$arCHF, 'JPY'=>$arJPY, 'CNY'=>$arCNY, 'PLN'=>$arPLN);
        }

    }



    protected function getResult()
    {
        // $this->arResult['CURRENCY']['CSV'] = $this->load_kurs_csv();
        // $this->arResult['CURRENCY']['CBR'] = $this->load_kurs_cbr();
        $csv = $this->load_kurs_csv();
        $cbr = $this->load_kurs_cbr();
		if(!empty($csv['USD']['buy'])){
			$this->arResult['CUR']['USD'] = array('USD $', $csv['USD']['buy'].'/'.$csv['USD']['status'], $csv['USD']['sell'].'/'.$csv['USD']['status'], $cbr['USD']['value'].'/'.$cbr['USD']['status']);
		}
		if(!empty($csv['EUR']['buy'])){
			$this->arResult['CUR']['EUR'] = array('EUR €', $csv['EUR']['buy'].'/'.$csv['EUR']['status'], $csv['EUR']['sell'].'/'.$csv['EUR']['status'], $cbr['EUR']['value'].'/'.$cbr['EUR']['status']);
		}
		if(!empty($csv['GBP']['buy'])){
			$this->arResult['CUR']['GBP'] = array('GBP £', $csv['GBP']['buy'].'/'.$csv['GBP']['status'], $csv['GBP']['sell'].'/'.$csv['GBP']['status'], $cbr['GBP']['value'].'/'.$cbr['GBP']['status']);
		}
		if(!empty($csv['CHF']['buy'])){
			$this->arResult['CUR']['CHF'] = array('CHF ₣', $csv['CHF']['buy'].'/'.$csv['CHF']['status'], $csv['CHF']['sell'].'/'.$csv['CHF']['status'], $cbr['CHF']['value'].'/'.$cbr['CHF']['status']);
		}
		if(!empty($csv['JPY']['buy'])){
			$this->arResult['CUR']['JPY'] = array('JPY ¥ <sup>1</sup>', $csv['JPY']['buy'].'/'.$csv['JPY']['status'], $csv['JPY']['sell'].'/'.$csv['JPY']['status'], $cbr['JPY']['value'].'/'.$cbr['JPY']['status']);
		}
		if(!empty($csv['CNY']['buy'])){
			$this->arResult['CUR']['CNY'] = array('CNY ¥ <sup>2</sup>', $csv['CNY']['buy'].'/'.$csv['CNY']['status'], $csv['CNY']['sell'].'/'.$csv['CNY']['status'], $cbr['CNY']['value'].'/'.$cbr['CNY']['status']);
		}
		if(!empty($csv['PLN']['buy'])){
			$this->arResult['CUR']['PLN'] = array('PLN zł', $csv['PLN']['buy'].'/'.$csv['PLN']['status'], $csv['PLN']['sell'].'/'.$csv['PLN']['status'], $cbr['PLN']['value'].'/'.$cbr['PLN']['status']);
		}
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