// console.log(location.href)
Array.from(document.querySelectorAll(".links_to_functions a")).forEach(el => {
    if(el.href === location.href){
        el.classList.add("active");
        return 0;
    }
});




$(document).ready(function(){
    let path = $(location).attr('href') ;
    let book = path.split('/')[4];
    let chapter = $.cookie(book);

    if(chapter != undefined || chapter!= null){
        $("#continue_read").text('Продолжите чтение с главы ' + chapter);
        $("#continue_read").attr('href', '/book/' + book + '/chapter/' + chapter);
    }

});
