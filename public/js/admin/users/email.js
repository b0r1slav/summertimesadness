(function(){

    //get the content of the editor and attach it to textarea
    $('#form-email').off().on('submit', function () {

        $('#descr').html($('#editor-one').html());
    });
})();