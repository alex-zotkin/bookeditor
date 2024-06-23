new Vue({
    el: "#app",
    data: {
        spoler: null
    },
    mounted(){
        let path = $(location).attr('href') ;
        let book = path.split('/')[4];
        let chapter = $.cookie(book);

        if(chapter != undefined || chapter!= null){
            this.spoler = chapter;
        }
    },
    methods: {

    }
});
