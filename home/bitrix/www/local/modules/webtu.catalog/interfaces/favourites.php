<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('webtu.helpers');
\Bitrix\Main\Loader::includeModule('webtu.catalog');

use Webtu\Catalog\Facades\FavouriteFacade as Manager;
use Webtu\Helpers\BAjaxInterface as Ajax;

Ajax
    ::getInstance(
        array(
            'checkAuthorization' => true,
        )
    )
    ->prepareData(
        function()
        {
            return array(
                0 => (int)$_REQUEST['id']
            );
        }
    )
    ->addAction(
        'add',
        function($id)
        {
            return Manager::add($id);
        }
    )
    ->addAction(
        'remove',
        function($id)
        {
            return Manager::remove($id);
        }
    )
    ->processActions()
;