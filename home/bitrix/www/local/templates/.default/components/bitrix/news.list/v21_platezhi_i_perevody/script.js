document.addEventListener("DOMContentLoaded", function() {
	var parent_popup = document.querySelector('.v21-transfer-card');
	var popup_block = `
	<div class="popup_pay__overlay"></div>
	<div class="popup_pay">
		<span class="popup_pay__close">&times;</span>
		<iframe id="popup_pay__frame" src="https://widget3.intervale.ru/?portal_id=P2PTRANSSTROYBANK0415R4G343J0415" name="portal_id=P2PTRANSSTROYBANK0415R4G343J0415;" scrolling="yes" style="width: 100%; height: 100%; border: none; outline: none; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255);"></iframe>
	</div>
	`;
	parent_popup.insertAdjacentHTML('afterend', popup_block);
	
	var popupBg = document.querySelector('.popup_pay__overlay'); // Фон попап окна
	var popup = document.querySelector('.popup_pay'); // Само окно
	var openPopupButtons = document.querySelector('.open-popup'); // Кнопки для показа окна
	var closePopupButton = document.querySelector('.popup_pay__close'); // Кнопка для скрытия окна
	
	function openPopup(e){ // Для каждой вешаем обработчик событий на клик
			e.preventDefault(); // Предотвращаем дефолтное поведение браузера
			popupBg.classList.add('active'); // Добавляем класс 'active' для фона
			popup.classList.add('active'); // И для самого окна
			var scrollY = document.documentElement.style.getPropertyValue('--scroll-y');
			var body = document.body;
			body.style.position = 'fixed';
			body.style.top = `-${scrollY}`;

		}
	openPopupButtons.addEventListener('click', openPopup);
	
	function closePopup(){ // Вешаем обработчик на крестик
		popupBg.classList.remove('active'); // Убираем активный класс с фона
		popup.classList.remove('active'); // И с окна
		var body = document.body;
		var scrollY = body.style.top;
		body.style.position = '';
		body.style.top = '';
		window.scrollTo(0, parseInt(scrollY || '0') * -1);
	}
	closePopupButton.addEventListener('click', closePopup);

	function clossPopupOther(e){ // Вешаем обработчик на весь документ
		if(e.target === popupBg) { // Если цель клика - фот, то:
			popupBg.classList.remove('active'); // Убираем активный класс с фона
			popup.classList.remove('active'); // И с окна
			var body = document.body;
			var scrollY = body.style.top;
			body.style.position = '';
			body.style.top = '';
			window.scrollTo(0, parseInt(scrollY || '0') * -1);
		}
	}
	document.addEventListener('click', clossPopupOther);

});