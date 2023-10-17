<?
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config as Conf;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Entity\Base;
use \Bitrix\Main\Application;

Loc::loadMessages(__FILE__);

Class webtu_auction extends CModule
{
    var $exclusionAdminFiles;
	function __construct()
    {
        $arModuleVersion = array();
        include(__DIR__."/version.php");
    
        $this->exclusionAdminFiles=array(
            '..',
            '.',
            'menu.php',
            'operation_description.php',
            'task_description.php'
        );

        $this->MODULE_ID = 'webtu.auction';
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = Loc::getMessage("WEBTU_AUC_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("WEBTU_AUC_MODULE_DESC");
    
        $this->PARTNER_NAME = Loc::getMessage("WEBTU_AUC_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("WEBTU_AUC_PARTNER_URI");
    }
    
    public function GetPath($notDocumentRoot=false)
    {
        if($notDocumentRoot)
            return str_ireplace(Application::getDocumentRoot(),'',dirname(__DIR__));
        else
            return dirname(__DIR__);
    }

    public function isVersionD7()
    {
        return CheckVersion(\Bitrix\Main\ModuleManager::getVersion('main'), '14.00.00');
    }

    function InstallDB()
    {
        return true;
    }

    function UnInstallDB()
    {
        Loader::includeModule($this->MODULE_ID);
        #Если есть файл options.php с настройками, то при удалении удаляем эти настройки из БД
        Option::delete($this->MODULE_ID);
    }
    
	function InstallEvents()
	{
        #Вызывается до попытки регистрации нового пользователя
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('main', 'OnBeforeUserRegister', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnBeforeUserUpdateHandler');

        #Вызывается до изменения параметров пользователя
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('main', 'OnBeforeUserUpdate', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnBeforeUserUpdateHandler');

        #Вызывается перед индексацией элемента поиска
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('search', 'BeforeIndex', $this->MODULE_ID, '\Webtu\Auction\Event', 'BeforeIndexHandler');

        #Вызывается после изменения флага оплаты заказа
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('sale', 'OnSalePayOrder', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnSalePayOrderHandler');
    
        #Вызывается после изменения статуса заказа
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('sale', 'OnSaleStatusOrder', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnSaleStatusOrderHandler');    
        
        #Вызывается после изменения флага отмены заказа
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('sale', 'OnSaleCancelOrder', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnSaleCancelOrderHandler');

        #Событие "OnProlog" вызывается в начале визуальной части пролога сайта.
        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('main', 'OnProlog', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnPrologHandler');

        \Bitrix\Main\EventManager::getInstance()->registerEventHandler('main', 'OnBeforeUserRegister', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnAfterEpilog');
		
		\Bitrix\Main\EventManager::getInstance()->registerEventHandler('main', 'OnAfterUserRegister', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnAfterUserRegisterHandler');
    }

	function UnInstallEvents()
	{
        #Вызывается до попытки регистрации нового пользователя
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('main', 'OnBeforeUserRegister', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnBeforeUserUpdateHandler');

        #Вызывается до изменения параметров пользователя
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('main', 'OnBeforeUserUpdate', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnBeforeUserUpdateHandler');

        #Вызывается перед индексацией элемента поиска
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('search', 'BeforeIndex', $this->MODULE_ID, '\Webtu\Auction\Event', 'BeforeIndexHandler');

        #Вызывается после изменения флага оплаты заказа
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('sale', 'OnSalePayOrder', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnSalePayOrderHandler');        
    
        #Вызывается после изменения статуса заказа
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('sale', 'OnSaleStatusOrder', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnSaleStatusOrderHandler');
        
        #Вызывается после изменения флага отмены заказа
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('sale', 'OnSaleCancelOrder', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnSaleCancelOrderHandler');
        
        #Событие "OnProlog" вызывается в начале визуальной части пролога сайта.
        \Bitrix\Main\EventManager::getInstance()->unRegisterEventHandler('main', 'OnProlog', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnPrologHandler');

        \Bitrix\Main\EventManager::getInstance()->unregisterEventHandler('main', 'OnBeforeUserRegister', $this->MODULE_ID, '\Webtu\Auction\Event', 'OnAfterEpilog');
    }
    
	function InstallFiles($arParams = array())
	{
        $path=$this->GetPath()."/install/components";
        
        #Проверяем существует ли папка с компонентами
        if(\Bitrix\Main\IO\Directory::isDirectoryExists($path)){
            #Копируем файлы
            CopyDirFiles($path, $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
        }else{
            #Если компонент не найден то выбрасываем исключения InvalidPathException - исключения связанные с неправельным путём
            throw new \Bitrix\Main\IO\InvalidPathException($path);
        }

        #Проверяем существует ли папка из административного раздела
        if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath() . '/admin'))
        {
            #Копируем 1. файлы из /install/admin/ в админку
            CopyDirFiles($this->GetPath()."/install/admin/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");

            #Копируем 2. каталог из /admin/ в админку /bitrix/admin/
            if ($dir = opendir($path))
            {
                while (false !== $item = readdir($dir))
                {
                    if (in_array($item,$this->exclusionAdminFiles))
                        continue;
                    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.$this->MODULE_ID.'_'.$item,
                        '<'.'? require($_SERVER["DOCUMENT_ROOT"]."'.$this->GetPath(true).'/admin/'.$item.'");?'.'>');
                }
                closedir($dir);
            }
        }

        return true;
	}
    
	function UnInstallFiles()
	{
        #Удаление компонентов
        $path = $this->GetPath()."/install/components/";
        $path_deleted = $_SERVER["DOCUMENT_ROOT"].'/bitrix/components/';
        
        if (is_dir($path)) {
            $dir_comp = dir($path);
            while ($entry = $dir_comp->read()) {
                if ($entry == '.' || $entry == '..') continue;

                if (is_dir($path.$entry.'/')) {
                    $int = dir($path.$entry.'/');
                    while ($dir = $int->read()) {
                        if ($dir == '.' || $dir == '..') continue;
                        \Bitrix\Main\IO\Directory::deleteDirectory($path_deleted.$entry.'/'.$dir.'/');   
                    }
                    $int->close();
                }
                
                #Если директория пустая то удаляем
                rmdir($path_deleted.$entry.'/');
            }

            $dir_comp->close();
        }
        
        #Удаление компонентов остальных файлов
        if (\Bitrix\Main\IO\Directory::isDirectoryExists($path = $this->GetPath() . '/admin')) {
            #Удаление 1 Сравниваеи папку /install/admin/ и /bitrix/admin/ и произволим удаление
            DeleteDirFiles($this->GetPath().'/install/admin/', $_SERVER["DOCUMENT_ROOT"].'/bitrix/admin');
            
            #Удаление 2 получаем файлы из /admin/ и удаяем эти файлы в папке /bitrix/admin/
            if ($dir = opendir($path)) {
                while (false !== $item = readdir($dir)) {
                    if (in_array($item, $this->exclusionAdminFiles))
                        continue;
                    \Bitrix\Main\IO\File::deleteFile($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $this->MODULE_ID . '_' . $item);
                }
                closedir($dir);
            }
        }
		return true;
	}

   /**
     * Установка модуля в один шаг 
     */
	function DoInstall()
	{
		global $APPLICATION;
        if($this->isVersionD7())
        {
            #Говорит системе что есть такой модуль и он установленный
            \Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
            
            #Установка бд таблиц и заполнения их демо данными.
            $this->InstallDB();
            #Регистрируем обработчики событий которые нам нужны.
            $this->InstallEvents();
            #Манипуляция с файлами копирование компонентов в администратиные части.
            $this->InstallFiles();

        }else{
            $APPLICATION->ThrowException(Loc::getMessage("WEBTU_AUC_INSTALL_ERROR_VERSION"));
        }
        
        //Установка в один шаг (подключаеться всегда)
        $APPLICATION->IncludeAdminFile(Loc::getMessage("WEBTU_AUC_INSTALL_TITLE"), $this->GetPath()."/install/step.php");
	}

   /**
     * Удаление модуля
     */
 	function DoUninstall()
	{
        global $APPLICATION;
        
        #Получаем объект приложения а от него контекст приложения
        $context = Application::getInstance()->getContext();
        #Получаем объект контекста вида Request (переданные данные)
        $request = $context->getRequest();

        if($request["step"]<2){
            $APPLICATION->IncludeAdminFile(Loc::getMessage("WEBTU_AUC_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep1.php");
        }elseif($request["step"]==2){
            #Манипуляция с файлами удалени компонентов в администратиные части.
            $this->UnInstallFiles();
            #Удаляем обработчики событий которые нам нужны.
			$this->UnInstallEvents();
            #Удаляем бд таблиц, если пользователь не захотел их сохранить
            if($request["savedata"] != "Y"){ $this->UnInstallDB(); }
                
            #Говорит системе что модуль Был удалён
            \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
            
            //Переходим на второй шаг удаления
            $APPLICATION->IncludeAdminFile(Loc::getMessage("WEBTU_AUC_UNINSTALL_TITLE"), $this->GetPath()."/install/unstep2.php");
        }
	}

   /**
     * Установим права доступа к модулю
     */
    #Используеться вместе с options.php
    function GetModuleRightList()
    {
        return array(
            "reference_id" => array("D","K","S","W"),
            "reference" => array(
                "[D] ".Loc::getMessage("WEBTU_AUC_DENIED"),#Доступ закрыт
                "[K] ".Loc::getMessage("WEBTU_AUC_READ_COMPONENT"),#Доступ к компонентам
                "[S] ".Loc::getMessage("WEBTU_AUC_WRITE_SETTINGS"),#Изменение настроек модуля
                "[W] ".Loc::getMessage("WEBTU_AUC_FULL"))#Полный доступ
        );
    }
}
?>