<?php
if( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();

use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;


class SynchCbr extends CBitrixComponent
{
    public $MessageError = array();
    public $MessageSend = array();

    #Перезаписываем $this->arParams (Удаляем не нужное)
    public function onPrepareComponentParams($params)
    {
        $result = array(
            "CACHE_TIME"             => $params['CACHE_TIME'],

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

    protected function load_kurs()
    {
        define("tsKurs","15:00:00");        # Время смены курса центральным банком
        $kurs_file=$_SERVER['DOCUMENT_ROOT'].$this->GetPath().'/log/kurs.txt';
        if (file_exists($kurs_file)){
           $lastModified=filemtime($kurs_file);
           // каждые 24 часа, но с учетом времени смены курса центральным банком
           if (date("Y-m-d H:i:s",$lastModified) > date("Y-m-d H:i:s",time()-60*60*24) && !(date("H:i:s",$lastModified) < tsKurs && date("H:i:s")>tsKurs ) ) {
            return explode('|',file_get_contents($kurs_file));
            //echo "<!--Курс ЦБ на ".date("Y-m-d H:i:s",$lastModified)."<br>Доллар - <b>".$dollar."</b><br>Евро - <b>".$euro."</b><br>".$df1."-->";
            }
        }

        // Получаем текущие курсы валют в rss-формате с сайта www.cbr.ru
        $content = $this->get_content();

        if(!$content&&file_exists($kurs_file)){// считаю по старому курсу если он есть
            return explode('|',file_get_contents($kurs_file));
        }

        // Разбираем содержимое, при помощи регулярных выражений
        $pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i";
        preg_match_all($pattern, $content, $out1, PREG_SET_ORDER);
        $dollar = "";
        $euro = "";
        foreach($out1 as $cur1)
        {
            if($cur1[2] == 840) $dollar = str_replace(",",".",$cur1[4]);
            if($cur1[2] == 978) $euro   = str_replace(",",".",$cur1[4]);
            if($cur1[2] == 826) $GBP    = str_replace(",",".",$cur1[4]);
            if($cur1[2] == 756) $CHF    = str_replace(",",".",$cur1[4]);
            if($cur1[2] == 392) $JPY    = str_replace(",",".",$cur1[4]);
            $JPY = $JPY / 100;

        }

        if(file_put_contents($kurs_file, $kurs=($dollar.'|'.$euro.'|'.$GBP.'|'.$CHF.'|'.$JPY))<10)array_push($this->MessageError,'Ошибка записи в '.$kurs_file);
        return explode('|',$kurs);
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
        if (!$fd) array_push($this->MessageError, "<h3>Сервер ЦБ не отвечает!</h3>");
        else
        {
          // Чтение содержимого файла в переменную $text
          while (!feof ($fd)) $text .= @fgets($fd, 4096);
          // Закрыть открытый файловый дескриптор
          @fclose ($fd);
        }
        return $text;
    }

    protected function getResult()
    {
        list($dollar, $euro, $GBP, $CHF, $JPY)=$this->load_kurs();
        $this->arResult['TIME'] = date("d.m.Y H:i",filemtime($_SERVER['DOCUMENT_ROOT'].$this->GetPath().'/log/kurs.txt'));
        $this->arResult['CURRENCY']['DOLLAR'] = $dollar;
        $this->arResult['CURRENCY']['EURO'] = $euro;
        $this->arResult['CURRENCY']['GBP'] = $GBP;
        $this->arResult['CURRENCY']['CHF'] = $CHF;
        $this->arResult['CURRENCY']['JPY'] = $JPY;

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
                $this -> getResult();
                $this -> actionMessage();


                $this -> includeComponentTemplate();
            // }
		}catch (Exception $e){
			ShowError($e->getMessage());
		}
    }

};
