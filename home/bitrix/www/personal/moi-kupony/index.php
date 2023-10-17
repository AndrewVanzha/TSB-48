<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои купоны");

global $USER, $DB;
if (!$USER->IsAuthorized()) {
    LocalRedirect('/login/');
}
?><?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"personal_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "personal_menu",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "personal_menu",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "personal_menu"
	),
	false
);

CModule::IncludeModule('sale');

$query = "SELECT * FROM b_sale_discount_coupon WHERE ACTIVE = 'Y'";
$coupons_pre = $DB->query($query);

$time = date("Y-m-d H:i:s", time());

while ($coupon = $coupons_pre->GetNext()) {
	$from = strtotime($coupon['ACTIVE_FROM']);
	$to = strtotime($coupon['ACTIVE_TO']);
	if ($coupon['USER_ID'] != $USER->GetID() && $coupon['USER_ID'] != 0) continue;
	if ($coupon['MAX_USE'] != 0 && ($coupon['MAX_USE'] >= $coupon['USE_COUNT'])) continue;
	if ($coupon['ACTIVE_TO'] != "" && $time > $to) continue;
	if ($coupon['ACTIVE_FROM'] != "" && $time < $from) continue;
	if ($coupon['ACTIVE_TO'] == "") $coupon['ACTIVE_TO'] = "Неограниченно";
	if ($coupon['TYPE'] == 1) $coupon['TYPE'] = "На одну позицию заказа";
	if ($coupon['TYPE'] == 2) $coupon['TYPE'] = "На один заказ";
	if ($coupon['TYPE'] == 4) $coupon['TYPE'] = "Многоразовый";
	$coupons[] = $coupon;
}

$discounts = CSaleDiscount::GetList();

while ($discount = $discounts->GetNext()) {
	foreach ($coupons as &$coupon) {
		if ($coupon['DISCOUNT_ID'] == $discount['ID']) {
			$coupon['NAME'] = $discount['NAME'];
		}
	}
} ?>
<pre style="display:none"><?print_r($coupons)?></pre>
<div class="table-container">
	<? if (count($coupons) > 0) { ?>
	<table class="content-table table-account">
		<tr>
			<th>Название</th>
			<th>Код купона</th>
			<th>Тип купона</th>
			<th>Срок действия, до</th>
		</tr>
		<? foreach ($coupons as $coupon) { ?>
			<tr>
				<td><?=$coupon['NAME']?></td>
				<td><h1><?=$coupon['COUPON']?></h1></td>
				<td><?=$coupon['TYPE']?></td>
				<td><?=$coupon['ACTIVE_TO']?></td>
			</tr>
		<? } ?>
	</table>
	<? } else { ?>
		Нет купонов
	<? } ?>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>