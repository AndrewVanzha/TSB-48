Компонент положить в local/components/webtu/subscribe

Пример вызова:  
```
<?$APPLICATION->IncludeComponent(
	"webtu:subscribe", 
	".default", 
	array(
		"AJAX_MODE" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"RUBRIC" => array(
			0 => "1",
		)
	),
	false
);?>
```
Стили для отображения ошибок и успеха:
```
.alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; }
.alert-danger { color: #a94442; background-color: #f2dede; border-color: #ebccd1; }
.alert-success { color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; }
```