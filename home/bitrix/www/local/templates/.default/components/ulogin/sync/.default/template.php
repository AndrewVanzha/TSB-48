<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die(); ?>
<? CJSCore::Init(array("jquery")); ?>
<? if($USER->IsAuthorized()): ?>
    <div class="form-change-col">
        <div class="form-social-wrap">
            <div class="topic-title">Социальные сети</div>
            <div class="form-social">
            	<div class="ulogin_synchronisation">
            		<?php echo $arResult['ULOGIN_CODE']; ?>
            	</div>
            	<div id="ulogin_synchronisation">
            		<?php echo $arResult['ULOGIN_SYNC']; ?>
            	</div>
            	<script type="text/javascript">
            		$(document).ready(function () {
            			var uloginNetwork = $('#ulogin_synchronisation').find('.ulogin_network');
            
            			uloginNetwork.click(function () {
            				var network = $(this).attr('data-ulogin-network');
            				var identity = $(this).attr('data-ulogin-identity');
            				uloginDeleteAccount(network, identity);
            			});
            		});
            		function uloginDeleteAccount(network, identity) {
            			$.ajax({
            				url: '/bitrix/components/ulogin/sync/ulogin-ajax.php',
            				type: 'POST',
            				dataType: 'json',
            				data: {
            					identity: identity
            				},
            				error: function (data, textStatus, errorThrown) {
            					alert("Не удалось выполнить запрос");
            				},
            				success: function (data) {
            					switch (data.answerType) {
            						case 'error':
            							alert(data.title + "\n" + data.msg);
            							break;
            						case 'ok':
            							alert(data.msg);
            							var accounts = $('#ulogin_accounts'),
            								nw = accounts.find('[data-ulogin-network=' + network + ']');
            							if (nw.length > 0) nw.hide();
            							break;
            						default:
            							break;
            					}
            				}
            			});
            		}
            	</script>
            </div>
            
        	<div class="note-social">
        		<?= GetMessage("ULOGIN_ACCOUNTS_DESC") ?>
        	</div>
        </div>
    </div>
<? endif; ?>