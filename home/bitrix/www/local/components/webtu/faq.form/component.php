<?
	if( !defined( 'B_PROLOG_INCLUDED' ) || B_PROLOG_INCLUDED !== true ) die();
	CModule::IncludeModule("iblock");	
    $message_err = array();
    $message_send = array();
    
    $el = new CIBlockElement;
	if ( !empty($_REQUEST['submit_cb'])  )
    {

		$_REQUEST['name'] = trim($_REQUEST['name']);
        $_REQUEST['comment'] = trim($_REQUEST['comment']);
        $_REQUEST['id'] = trim($_REQUEST['id']);

        
        if ( !empty($_REQUEST['name']) && !empty($_REQUEST['comment']) && count($message_err) == 0  ){
        
                $title = $_REQUEST['name'].'-'.mktime();
                $arParams_trans = array("replace_space"=>"-","replace_other"=>"-");
                $trans = Cutil::translit($title,"ru",$arParams_trans);

                $arLoadProductArray = Array(
                	"IBLOCK_ID"      => $arParams["IBLOCK_ID"],
                	"NAME"           => $title,
                    "CODE"           => $trans,
                	"ACTIVE"         => "N",
                	"PREVIEW_TEXT"   => $_REQUEST['comment'],
                	"DETAIL_TEXT"	 => "",
                	"DATE_ACTIVE_FROM" => date("d.m.Y H:i:s"),
                    "DETAIL_PICTURE" => "",
                    "PROPERTY_VALUES" => array("NAME"=>$_REQUEST['name'],"ID_AUKTSION"=>$_REQUEST['id'])
                ); 
                   
                    if ($PRODUCT_ID = $el->Add($arLoadProductArray)){
                        
                        //Отправляем письмо на EMAIL          
                        $arMailFields = array(
                            "NAME" => $_REQUEST['name'],
                            "COMMENT" => $_REQUEST['comment']
                        
                        ); 

						$result = CEvent::Send('faq', SITE_ID, $arMailFields);

                        if($result){
                            array_push($message_send, GetMessage( 'SEND_DONE' ) );
                        }else{
                            array_push($message_err, GetMessage( 'ERROR_SEND_ELEMENT' ) );
                        }  
                        
                    	unset($_REQUEST['name']);
                        unset($_REQUEST['id']);
                        unset($_REQUEST['comment']);
                        unset($_REQUEST['submit_cb']); 
                    }

        }else{     
            if(empty($_REQUEST['name'])){ array_push($message_err, GetMessage( 'WRITE_NAME' ) ); }    
            if(empty($_REQUEST['comment'])){ array_push($message_err, GetMessage( 'WRITE_COMMENT' ) ); }                                               
                                                          

        }
        
        $arResult['err'] = $message_err;
        $arResult['send'] = $message_send;         
	}


	$this->IncludeComponentTemplate();
?>