$(function(){
    $(".tag_select_choose").select2({
        tags: true,
        tokenSeparators: [',']
    });
    $(".select2_init").select2({
        placeholder:"select a state",
        allowClear:true,
    });
    
})