$(document).ready(function(){

$('td.interact:not(.reserved)').click(function() {
    if($(this).hasClass("userRes")){
        //canceling a reservation
        $(this).toggleClass("userRes");
        $('input#t').val("0");
        $('input#f').val("0");
    }else{
        //making a new reservation
        $('td.userRes').toggleClass("userRes");
        $(this).toggleClass("userRes");
        
        //find the wanted time and field and update input values 
        $('input#t').val(($('tr').index($('td.userRes').parent()[0])+5)+ "");
        $('input#f').val(((($('td').index($('td.userRes')[0])) % 5)+1)+"");
    }
    return;
});

});
