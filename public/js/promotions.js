$(document).ready(function () {

    var bank_id =  $('#bankSelector').val();

    getPromotions(bank_id);
    
    $(document).on('change', '#bankSelector', function () {
        var bank_id =  $('#bankSelector').val();
        getPromotions(bank_id);
    });

    //get group description to update
    function getPromotions(bank_id) {

        $.ajax({
            type: 'GET',
            url: base_url+'/get-promotions',
            data: {'bank_id':bank_id},
            complete : function () {
            },
            success: function (obj) {
                console.log(obj);
                if(obj.success){
                    //$('#group-description-text p').html(obj.message);

                }
            }
        });
    }

});