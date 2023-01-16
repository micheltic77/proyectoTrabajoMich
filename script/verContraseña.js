$(document).ready(function(){
    $('#ojo').mousedown(function(){
        $('#pass').removeAttr('type');
    });
    $('#ojo').mouseup(function(){
        $('#pass').attr('type','password');
    });

    $('#ojoC').mousedown(function(){
        $('#confPass').removeAttr('type');
    });
    $('#ojoC').mouseup(function(){
        $('#confPass').attr('type','password');
    });
})
