
$(document).ready(function () {

    var bankId = $("#bankSelector option:selected").val();
    getCards(bankId);
    function getCards(bankId){

        $.ajax({
            type: 'GET',
            url: base_url+'/admin/get-cards',
            data: {'bankId':bankId},
            success: function (obj) {
                console.log(obj.view);
                if(obj.success){
                    $('#cardSelectorDiv').html(obj.view);
                }
            }
        });
    }
    $(document).on('change', '#bankSelector', function () {
        bankId = $("#bankSelector option:selected").val();
        getCards(bankId);
    });

});