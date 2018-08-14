$(document).ready(function(){

$('td.interact:not(.reserved)').click(function() {
    $('td.userRes').toggleClass("userRes");
    $(this).toggleClass("userRes");
    return;
});

});
