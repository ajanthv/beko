
$(document).ready(function () {

    var bank_id =  $('#bank_promotion_selector').val();

    getPromotions(bank_id);

    $(document).on('change', '#bank_promotion_selector', function (){
        var bank_id =  $('#bank_promotion_selector').val();
        getPromotions(bank_id);
    });
//get group description to update
    function getPromotions(bank_id) {

        console.log('aa');
        $.ajax({
            type: 'GET',
            url: base_url+'/get-promotions',
            data: {'bank_id':bank_id},
            complete : function () {
            },
            success: function (obj) {
                console.log(obj);
                if(obj.success){
                    $('#promotions_list').html(obj.view);

                }
            }
        });
    }

});