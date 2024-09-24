$('.select-picking-list').change(function(){
    var getValue = $(this).val();
    $.ajax({
        url : '<?php echo site_url('PickOrder/getPickListDetail') ?>',
        method : 'POST',
        dataType : 'json',
        data : {pickListId:getValue},
        success : function(rseponse){
            console.log(response);
        }
    })
});