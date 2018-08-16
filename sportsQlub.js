$(document).ready(function(){

initialHighlight();

$('td.interact:not(.reserved)').click(function() {
    if($(this).hasClass("userRes")){
        //canceling a reservation
        $(this).toggleClass("userRes");
        $('input#t').val("0");
        $('input#f').val("0");
        
        //remove highlights from headers
        $('th.highlight').toggleClass("highlight");
    }else{
        //making a new reservation
        $('td.userRes').toggleClass("userRes");
        $(this).toggleClass("userRes");
        
        //remove highlights from headers
        $('th.highlight').toggleClass("highlight");
        
        
        //find the wanted time and field and update input values
        var time =  ($('tr').index($('td.userRes').parent()[0])+5);
        var field = ((($('td').index($('td.userRes')[0])) % 5)+1);
        $('input#t').val(time + "");
        $('input#f').val(field +"");
        
        //highlight the row headers of the selection for extra clarity
        $('th#f'+field).toggleClass("highlight");
        $('th#t'+time).toggleClass("highlight");
    }
    return;
});

});

//if there's already a reservation, highlight the ssociated headers
function initialHighlight(){
    
    if($('td.userRes').length >0){
        var time =  ($('tr').index($('td.userRes').parent()[0])+5);
        var field = ((($('td').index($('td.userRes')[0])) % 5)+1);
        
        //highlight the row headers of the selection for extra clarity
        $('th#f'+field).toggleClass("highlight");
        $('th#t'+time).toggleClass("highlight");
    }
    return;
}
