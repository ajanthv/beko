$(document).on('change', '#bankSelector', function () {
    var bankId = $("#bankSelector option:selected").val();
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
});

// activate/inactivate user
function activeInactiveUser(userId, type) {

    var processingElm = $('#oac-processing .oac-processing-text');
    processingElm.html('Loading...');

    Foundation.libs.reveal.settings.close_on_background_click = false;
    $('#oac-processing').foundation('reveal', 'open');

    var $_token = $('[name="_token"]').val();

    $.ajax({
        type: 'POST',
        url: base_url+'/admin/active-inactive-user',
        data: {'userId':userId, 'type': type},
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $_token
        },
        complete : function () {
            $('#oac-processing').foundation('reveal', 'close');
        },
        success: function (obj) {
            if(obj.success){
                if(type == 'active'){
                    $('#inactive-user-info')
                        .removeClass('error-label')
                        .addClass('success-label')
                        .html('This user is currently active.');
                }else{
                    $('#inactive-user-info')
                        .removeClass('success-label')
                        .addClass('error-label')
                        .html('This user is currently inactive.');
                }
            }
        }
    });
}