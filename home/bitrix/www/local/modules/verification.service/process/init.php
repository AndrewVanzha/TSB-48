<?
/**
 * @var $APPLICATION
 * @var $USER
 */

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Page\Asset;
use Verification\Service\General;
use Verification\Service\Logger;

global $USER;
$module_id = 'verification.service';

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Сервис верификации");
Asset::getInstance()->addCss("/verification.service/assets/style.css");
Asset::getInstance()->addCss("/verification.service/assets/daterangepicker.css");
Asset::getInstance()->addJs("/verification.service/assets/moment.min.js");
Asset::getInstance()->addJs("/verification.service/assets/daterangepicker.min.js");
Asset::getInstance()->addJs("/verification.service/assets/script.js");
try {
    if (Loader::IncludeModule($module_id)) {
        try {
            $request = Application::getInstance()->getContext()->getRequest();
            $get = $request->getQueryList();
            $post = $request->getPostList();
            $check = General::check_access($get['h']);

            switch ($check) {
                case 1:
                    $APPLICATION->IncludeFile("/local/modules/$module_id/views/init/manager.php", array(
                        'module_id' => $module_id,
                        'get' => $get,
                        'post' => $post
                    ));
                    break;
                case 2:
                    $APPLICATION->IncludeFile("/local/modules/$module_id/views/init/user.php", array(
                        'module_id' => $module_id,
                        'hash' => $get['h'],
                        'get' => $get,
                        'post' => $post
                    ));
                    break;
                default:
                    //$APPLICATION->IncludeFile("/local/modules/$module_id/views/init/forbidden.php");
                    LocalRedirect('/v/');
            }
        } catch (Exception $e) {
            Logger::write('error', $e->getMessage());
        }
    }
} catch (Exception $e) {
    Logger::write('error', $e->getMessage());
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
