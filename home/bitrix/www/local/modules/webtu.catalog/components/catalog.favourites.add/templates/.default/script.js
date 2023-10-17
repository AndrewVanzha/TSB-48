function addFavourite(product_id) {

    $.ajax({
        type: 'POST',
        url: '/local/modules/webtu.catalog/interfaces/favourites.php',
        data: {action: 'add', id: product_id},
        success: function(data) {
            data = JSON.parse(data);
            if(typeof(data['error']) == 'undefined') {
                $('#favourite-add-' + product_id).hide();
                $('#favourite-remove-' + product_id).show();
            } else {
                alert(data['error']);
            }
        }
    });
}

function removeFavourite(product_id) {

    $.ajax({
        type: 'POST',
        url: '/local/modules/webtu.catalog/interfaces/favourites.php',
        data: {action: 'remove', id: product_id},
        success: function(data) {
            data = JSON.parse(data);
            if(typeof(data['error']) == 'undefined') {
                $('#favourite-add-' + product_id).show();
                $('#favourite-remove-' + product_id).hide();
            } else {
                alert(data['error']);
            }
        }
    });
}
