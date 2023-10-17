<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>

<div class="exchange-course" style="background-image: url(/local/templates/.default/img/exchange-course.jpg);">

    <div class="page-container clearfix">

        <div class="exchange-course_brief">

            <h2 class="section-title page-title--2 page-title">
                <?=GetMessage("EXCHANGE_RATES")?>
            </h2>

            <div class="note">
				<?if (isset($arResult['MODIFY_DATE_FILE'])) {
					$dateCurModify = $arResult['MODIFY_DATE_FILE'];
				} else {
					$dateCurModify = $_SESSION['MODIFY_CUR_DATE_FILE'];
				}?>
                 <?=GetMessage("DATA_FOR")?> <span id="note-date"><?echo FormatDate("H:i j F Y", $dateCurModify ),".";?></span>



            </div>
            
            <? if (!strpos($_SERVER['PHP_SELF'], 'konvertor-valyut')) { ?>
                <a href="/chastnym-klientam/konvertor-valyut/" class="button">
                    <?=GetMessage("CURRENCY_CONVERTER")?>
                </a>
            <? } ?>

        </div>

        <div class="exchange-course_table">

            <table>

                <tr>

                    <th>
                        <?=GetMessage("CURRENCY")?>
                    </th>

                    <th>
                        <?=GetMessage("PURCHASE")?>
                    </th>

                    <th>
                        <?=GetMessage("SALE")?>
                    </th>

                    <th>
                        <?=GetMessage("CBRF")?>
                    </th>

                </tr>

				<?foreach ($arResult['CUR'] as $arCur){?>

                    <? if ($arCur[1] !== '/') {?>

    					<tr>

    						<?foreach($arCur as $key => $cur){?>

    							<?if($key>0){

    								$arElement = explode("/", $cur);?>

    								<td>
    									<?if($arElement[0] > 0){?>
    										<span class="direction <?=($arElement[1]=='>')?'mi--arrow-up':'mi--arrow-down'?> mi">
    											<?=number_format((float)$arElement[0], 2, '.', '')?>
    										</span>
    									<?}?>
    								</td>

    							<?} else {?>

    			                    <td>
    									<?=$cur;?>
    		                    	</td>

    	                    	<?}?>

    						<?}?>

                        </tr>

                    <? } ?>

				<?}?>

                

            </table>
            
            <? if ($arResult['CUR']['JPY'][1] !== '/') { ?>
				<p style="margin: 20px 0 5px; font-size: 16px; color: #cd8e27;">1 - <?=GetMessage("CURS_COUNT_1")?></p>
				<?//редактировать в lang/ru/template.php и lang/en/template.php?>
            <? } ?>

			<? if ($arResult['CUR']['CNY'][1] !== '/') { ?>
			  <p style=" margin-top: 5px; font-size: 16px; color: #cd8e27;">2 - <?=GetMessage("CURS_COUNT_2")?></p> 
				<?//редактировать в lang/ru/template.php и lang/en/template.php?>
			<? } ?>

        </div>
		<div style = "color: #cd8e27; margin-top:10px;">
Уважаемые клиенты! Обращаем внимание, что курсы валют в каждом отдельном офисе могут отличаться от представленных на сайте. Для уточнения актуальной информации перейдите в раздел 
	<a href = "/chastnym-klientam/konvertor-valyut/
">Операции с валютой</a>
</div>
    </div>

</div>
