// --------------------------------------- //
// ДОБАВЛЕНИЕ В ИЗБРАННОЕ //
// --------------------------------------- //
if(typeof add_liked != 'function') {
    function add_liked(element,element_id) {
        
        var url = ( (BX.message('TEMPLATE_PATH')) ? BX.message('TEMPLATE_PATH')+'/ajax.php' : "/local/components/webtu/catalog.liked.line/ajax.php" );

    	$.ajax({
            type: "POST",
            cache: false,
    		url: url,
            dataType: "html",
            data: { 
                PRODUCT_ID : element_id, 
                ADD_LIKED : "Y",
                AJAX : "Y"
            },
    		success: function(html){
                update_liked(html);
                
                $(element).addClass('is-active');
                $(element).attr("onclick","deleted_liked(this,"+element_id+");");
    		}
    	});

    	return false;
    }  
}
// --------------------------------------- //
// УДАЛЕНИЕ ИЗ ИЗБРАННОГО //
// --------------------------------------- //
if(typeof deleted_liked != 'function') {
    function deleted_liked(element,element_id) {
        
        var url = ( (BX.message('TEMPLATE_PATH')) ? BX.message('TEMPLATE_PATH')+'/ajax.php' : "/local/components/webtu/catalog.liked.line/ajax.php" );
        
    	$.ajax({
            type: "POST",
            cache: false,
    		url: url,
            dataType: "html",
            data: { 
                PRODUCT_ID : element_id, 
                DELETED_LIKED_ID : "Y",
                AJAX : "Y"
            },
    		success: function(html){
                update_liked(html);
                
                $(element).removeClass('is-active');
                $(element).attr("onclick","add_liked(this,"+element_id+");");
    		}
    	});
        
    	return false;
    }  
}
// --------------------------------------- //
// ОБНОВЛЕНИЕ ИЗБРАННОГО //
// --------------------------------------- //
if(typeof update_liked != 'function') {
    function update_liked(html){
        $("#favorite").html(html);
    }
}