<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?
    $user_name = "";
    if ( $USER->IsAuthorized() ) {
        $rsUser = CUser::GetByID($USER->GetID());
        $arUser = $rsUser->Fetch();
        $user_name = $arUser["NAME"];

    }
?>

<div class="heading">Задать вопрос администратору</div>
    <form  id="feedbackForm" name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" class="form-question" method="post" enctype="multipart/form-data">
        <div class="subtitle">Обратная связь</div>

        <? global $USER;?>
          <? if ($USER->IsAuthorized()): ?>
            Вы авторизовались, как <b><?=$USER->GetParam("NAME")?></b> <a href="?logout=yes">Выйти</a>
          <?else:?>
              <div class="reviews-form-text">Для отправки отзыва вам необходимо авторизоваться через </div>
               <?$APPLICATION->IncludeComponent(
                    "ulogin:auth",
                    "",
                    Array(
                        "GROUP_ID" => array("2", "3", "4", "6"),
                        "LOGIN_AS_EMAIL" => "Y",
                        "SEND_EMAIL" => "Y",
                        "SOCIAL_LINK" => "N",
                        "ULOGINID1" => "2aad5593",
                        "ULOGINID2" => ""
                    )
                );?>
              <div class="reviews-form-text">или укажите</div>
          <?endif;?>
          <? if (!$USER->IsAuthorized()): ?>
            <input type="text" name="name" placeholder="ФИО" value="<?if(strlen($_REQUEST['name']) > 0){echo htmlspecialcharsbx($_REQUEST['name']);}?>" requared>
          <?endif;?><br><br>


        <textarea name="comment" value="<?if(strlen($_REQUEST['comment']) > 0){echo htmlspecialcharsbx($_REQUEST['comment']);}?>"></textarea>
        <? if ($USER->IsAuthorized()): ?>
            <input type="hidden" name="name" value="<?=$user_name?>">
         <?endif;?>
	    <input type="hidden" name="id" value="<?=$arParams['ID']?>">
        <input type="submit" name="submit_cb" value="Отправить" />
        
        <?
        if( count($arResult['err']) > 0 ){
             echo '<div class="input shadow">';
                foreach( $arResult['err'] as $item ){
                     echo '<div  style="color:red; text-align:center; margin-top: 15px;">'.$item.'</div>';
                }
            echo '</div>';
        }
        if( count($arResult['send']) > 0 ){
            echo '<div class="input shadow">';
                foreach( $arResult['send'] as $item ){
                    echo '<div style="color:green; text-align:center; margin-top: 15px;">'.$item.'</div>';
                 }
            echo '</div>';
        }      
        ?> 
    </form>




                                  