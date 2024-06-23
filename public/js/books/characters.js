new Vue({
    el: "#app",
    data: {
        create_form: false,

        edit_form: false,
        edit_character: {}

    },
    methods: {
        edit(character){
            this.edit_form = true;
            this.edit_character = character;
            console.log(character)
        },

        urlify(text) {
            var urlRegex = /(https?:\/\/[^\s]+)/g;
            return text.replace(urlRegex, function(url) {
              return '<a href="' + url + '">' + url + '</a><br>';
            })
        },
    }
});
