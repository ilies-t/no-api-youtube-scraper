$(window).on('load', function(){
    $bannerbaliz = $('.result-card').attr('style');
    $textbaliz = $('.result-channel_name').length;
    $divresult = $('div.form-elag');
    $alert = $('.alert');

    if($bannerbaliz === "background-image:url('https:')" || $textbaliz === 0){
        $($divresult).addClass('bad');
        $('body').addClass('fencie');
        $alert.removeClass('off');
        $alert.delay(500).fadeOut(5000 , function () { $(this).remove(); });
    }
    else{
        $($divresult).addClass('good');
        $alert.remove();
    };
    console.log('formVerif is OK');
})