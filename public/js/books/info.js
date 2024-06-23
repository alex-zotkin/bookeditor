// new Vue({
//     el: "#chapters_list",
//     data:{
//         chapters: [
//             {
//                 id: 1,
//                 title: "Название первой главы: Гарри Поттер и Кубок огня"
//             },
//             {
//                 id: 2,
//                 title: "2 глава: Гарри Поттер и Орден Феникса"
//             },
//             {
//                 id: 3,
//                 title: "Третья глава"
//             }
//         ],
//
//         drag_traget: null,
//         drop_item: -1
//     },
//
//     watch:{
//         drop_item(n, o){
//             console.log(n)
//             if(document.getElementById("chapter_drop_zone")){
//                 document.getElementById("chapter_drop_zone").remove();
//             }
//
//             let new_drop_elem = document.createElement("li");
//             new_drop_elem.setAttribute('id', "chapter_drop_zone");
//             new_drop_elem.classList.add("chapter_drop_zone", "column");
//             new_drop_elem.innerHTML = `<h3>Бросьте сюда</h3>`;
//
//             let chapter_list = document.getElementById("chapters_list");
//             if(this.drop_item && this.drop_item !== -1){
//
//                 chapter_list.insertBefore(new_drop_elem, this.drop_item);
//             } else{
//                 chapter_list.insertBefore(new_drop_elem, chapter_list.lastChild);
//             }
//         }
//     },
//
//     mounted(){
//         let chapters_list = document.querySelectorAll("#chapters_list li");
//         chapters_list.forEach(li => {
//            let move_button = li.querySelector(".chapter_move");
//
//            move_button.addEventListener("mousedown", this.mousedown);
//
//            li.addEventListener("mousemove", this.mousemove);
//            li.addEventListener("mouseup", this.mouseup);
//         });
//     },
//
//     methods: {
//         mousedown(e){
//             this.drag_target = e.target.parentElement;
//             this.drop_item = null;
//             this.drag_target.classList.add("chapter--active");
//
//             let new_y = e.clientY - document.getElementById("chapters_list").offsetTop;
//             this.drag_target.style.top = new_y - this.drag_target .offsetHeight/2 + 'px';
//         },
//
//         mousemove(e){
//             if(this.drag_target != null){
//                 let new_y = e.clientY - document.getElementById("chapters_list").offsetTop;
//
//                 this.drag_target.style.top = new_y - this.drag_target .offsetHeight/2 + 'px';
//
//                 let find_elem = null;
//                 Array.from(document.querySelectorAll("#chapters_list li")).forEach(el => {
//                     if((el !== this.drag_target && el !== document.getElementById("chapter_drop_zone"))
//                         && el.offsetTop> this.drag_target.offsetTop) {
//                         find_elem = el;
//                     }
//                 });
//
//                 this.drop_item =  find_elem;
//             }
//         },
//
//         mouseup(e){
//             this.drag_target.classList.remove("chapter--active");
//             this.drag_target = null;
//             this.drop_item = -1;
//
//             console.log('up')
//         }
//     }
// })





new Vue({
    el: "#app",
    data: {
        create_form: false,
    },

    mounted(){
        let list = document.getElementById("chapters_list");
        new Sortable(list, {
            handle: '.chapter_move', // handle's class
            animation: 250,
            chosenClass: 'chapter--active',
            easing: "cubic-bezier(1, 0, 0, 1)",

            onEnd: function(evt) {
                let from = evt.oldIndex + 1;
                let to = evt.newIndex + 1;

                $.ajax({
                    url: location.href + "/chapters/swap",
                    type: "POST",
                    data: {
                        from: from,
                        to: to
                    },
                    success: ()=>{
                        location.reload();
                    }
                });
            }
        });
    },
})
