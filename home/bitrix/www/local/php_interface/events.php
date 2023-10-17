<?
AddEventHandler("main", "OnBeforeProlog", "OnBeforePrologHandler");
function OnBeforePrologHandler()
{
   if (isset($_REQUEST['utm_source']) && !(empty($_REQUEST['utm_source']))) {
      setcookie("UTM_SOURCE", $_REQUEST['utm_source'], time() + 60 * 60 * 24 * 60, '/');
   } else {
      if (!isset($_COOKIE['UTM_SOURCE'])) {
         setcookie("UTM_SOURCE", 'no_data', time() + 60 * 60 * 24 * 60, '/');
      }
   }
   if (isset($_REQUEST['utm_medium']) && !(empty($_REQUEST['utm_medium']))) {
      setcookie("UTM_MEDIUM", $_REQUEST['utm_medium'], time() + 60 * 60 * 24 * 60, '/');
   } else {
      if (!isset($_COOKIE['UTM_MEDIUM'])) {
         setcookie("UTM_MEDIUM", 'no_data', time() + 60 * 60 * 24 * 60, '/');
      }
   }
   if (isset($_REQUEST['utm_campaign']) && !(empty($_REQUEST['utm_campaign']))) {
      setcookie("UTM_CAMPAIGN", $_REQUEST['utm_campaign'], time() + 60 * 60 * 24 * 60, '/');
   } else {
      if (!isset($_COOKIE['UTM_CAMPAIGN'])) {
         setcookie("UTM_CAMPAIGN", 'no_data', time() + 60 * 60 * 24 * 60, '/');
      }
   }
   if (isset($_REQUEST['utm_term']) && !(empty($_REQUEST['utm_term']))) {
      setcookie("UTM_TERM", $_REQUEST['utm_term'], time() + 60 * 60 * 24 * 60, '/');
   } else {
      if (!isset($_COOKIE['UTM_TERM'])) {
         setcookie("UTM_TERM", 'no_data', time() + 60 * 60 * 24 * 60, '/');
      }
   }
   if (isset($_REQUEST['utm_content']) && !(empty($_REQUEST['utm_content']))) {
      setcookie("UTM_CONTENT", $_REQUEST['utm_content'], time() + 60 * 60 * 24 * 60, '/');
   } else {
      if (!isset($_COOKIE['UTM_CONTENT'])) {
         setcookie("UTM_CONTENT", 'no_data', time() + 60 * 60 * 24 * 60, '/');
      }
   }
}

AddEventHandler("main", "OnEndBufferContent", "OnEndBufferContentHandler");
function OnEndBufferContentHandler(&$content)
{
   file_put_contents('/home/bitrix/www' . '/currency/a_tsb_cookies_utm_source.json', json_encode($_COOKIE["UTM_SOURCE"]));
   $pattern = '/<\/form>/';
   $hiddenInputs = 
         '<input hidden name="UTM_SOURCE" value="'   . $_COOKIE['UTM_SOURCE']   . '">'. 
         '<input hidden name="UTM_MEDIUM" value="'   . $_COOKIE['UTM_MEDIUM']   . '">'.
         '<input hidden name="UTM_CAMPAIGN" value="' . $_COOKIE['UTM_CAMPAIGN'] . '">'.
         '<input hidden name="UTM_TERM" value="'     . $_COOKIE['UTM_TERM']     . '">'.
         '<input hidden name="UTM_CONTENT" value="'  . $_COOKIE['UTM_CONTENT']  . '">'.
      '</form>';
   $content = preg_replace($pattern, $hiddenInputs, $content);
}