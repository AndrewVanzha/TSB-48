<? 
//if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?
$APPLICATION->SetPageProperty("description", "АКБ «Трансстройбанк» (АО) поздравляет своих клиентов с Новым годом.");
$APPLICATION->SetPageProperty("keywords", "Новый год");
$APPLICATION->SetPageProperty("title", "Поздравления с Новым годом от акционерного коммерческого банка «ТрансСтройБанк»");
// Здесь будет карточка "Новый Год"
?>
<style>
html {
	overflow: auto!important;
}
</style>
<section class="v21 new_year-container">
    <?
        $headerLogo = "/local/templates/template_card/img/logo.svg";
        $headerLogoDesktop = "img/logo_desktop.svg";
        //$headerLogoDesktop = "img/logo_desktop.png";
        $headerLogoMobile = "img/logo_mobile.svg";
        //$headerLogoMobile = "img/logo_mobile.png";
    ?>
    <div class="new_year-container--logo logo-desktop">
        <a href="/"><img src="<?=$headerLogoDesktop?>" alt="АКБ «Трансстройбанк»"></a>
    </div>
    <div class="new_year-container--logo logo-mobile">
        <a href="/"><img src="<?=$headerLogoMobile?>" alt="АКБ «Трансстройбанк»"></a>
    </div>
    <div class="new_year-container--wrap">
        <div class="new_year-container--circle circle-65"></div>
        <div class="new_year-container--circle circle-63"></div>
        <div class="new_year-container--circle circle-62"></div>
        <div class="new_year-container--circle circle-66"></div>

        <div class="kino--wrap">
            <figure class="kino">
                <video controls="true" autoplay muted loop playsinline>
                    <source src="img/tiger_card.mp4" type="video/mp4"/>
<?/*?>
                    <source src="img/Drone_Tigers_cut.mp4" type="video/mp4"/>
                    <source src="img/Drone_Tigers_cut.webm" type="video/webm"/>
<?*/?>
                </video>
            </figure>
        </div>

        <div class="congratulate-block">
            <div class="congratulate-wrap">
                <div class="congratulate-header">
                    <span>Поздравляем вас с Новым годом!</span>
                </div>
                <div class="congratulate-star">
                    <img src="img/star.png" alt="Звездочка">
                    <!--img src="/local/templates/template_card/img/star.png" alt="Звездочка"-->
                </div>
                <div class="congratulate-text">
                    <span>По восточному календарю 2022 год пройдёт под знаком Тигра. В Китае верили, что этот зверь является символом силы и здоровья, отгоняет злых духов и болезни. После двух лет мировой пандемии, пусть 2022-й подарит успех, станет годом великих свершений и благоприятных событий. Осваивайте новые умения, двигайтесь вперёд, смело и энергично, как король уссурийской тайги — амурский тигр!</span>
                </div>
                <div class="congratulate-wave">
                    <img src="img/wave.png" alt="Значок волны">
                    <!--img src="/local/templates/template_card/img/wave.png" alt="Значок волны"-->
                </div>
                <div class="congratulate-footer">
                    <span>С наилучшими пожеланиями, Трансстройбанк.</span>
                </div>
            </div>
            <div class="congratulate-mobile-wrap">
                <div class="congratulate-wave">
                    <img src="img/wave.png" alt="Значок волны">
                </div>
                <div class="congratulate-footer">
                    <span>С наилучшими пожеланиями, Трансстройбанк.</span>
                </div>
            </div>
        </div>

    </div>
    <!--iframe width="560" height="315" src="https://www.youtube.com/embed/84gvPdRv6NU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe-->
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
