<?
use \Bitrix\Main\Loader;

if (isset($_POST["AJAX"]) && $_POST["AJAX"] == "Y"){
    //запускаем сессию
    session_start();

    #Добавляем
    if(isset($_POST["ADD_LIKED"]) && $_POST["ADD_LIKED"] == "Y" && isset($_POST["PRODUCT_ID"])  ){
        $product_id = htmlspecialchars($_POST["PRODUCT_ID"]);
        $_SESSION["LIKED_PRODUCTS"][$product_id] = $product_id;
    }
    #удалить по id
    else if(isset($_POST["DELETED_LIKED_ID"]) && $_POST["DELETED_LIKED_ID"] == "Y" && isset($_POST["PRODUCT_ID"]) ){
        $product_id = htmlspecialchars($_POST["PRODUCT_ID"]);
        unset($_SESSION["LIKED_PRODUCTS"][$product_id]);
    }
    #удалить всё
    else if(isset($_POST["DELETED_LIKED"])){
        unset($_SESSION["LIKED_PRODUCTS"]);
    }

    echo count( $_SESSION["LIKED_PRODUCTS"] );
}
?>