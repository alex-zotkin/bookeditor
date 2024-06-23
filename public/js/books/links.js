new Vue({
    el: "#app",
    data: {
        loading: false,
        book_id: -1,
        data: [],

        pixi: null,
    },

    mounted(){
        this.all_info();
        this.book_id = $(location).attr('href').split('/')[4];
    },

    methods:{
        all_info(){
            this.loading = true;
            let path = $(location).attr('href') + '/all_info';

            $.ajax({
                url: path,
                type: "GET",
                data: {

                },
                success: (data)=>{
                    this.data = data;
                    this.loading = false;

                    this.draw();
                    console.log(this.data);
                }
            });
        },


        draw() {
            this.pixi = new PIXI.Application({
                width: document.getElementById("canvas").offsetWidth,
                height: document.getElementById("canvas").offsetHeight,
                view: document.getElementById("canvas"),
                background: '#1099bb',
                backgroundAlpha: 0,
                antialias: true,
                resolution: 2,
                resizeTo: document.getElementById("canvas")
            });

            let link_paths = [];
            let link_texts = [];
            //Рисование линии взаимосвязи
            this.data.links.forEach(link => {
                let link_container = new PIXI.Container();
                this.pixi.stage.addChild(link_container);

                const path = new PIXI.Graphics();
                path.data = link;
                path.lineStyle(4, path.data.color.value, 1);
                path.moveTo(link.character1.x, link.character1.y);
                path.lineTo(link.character2.x, link.character2.y);
                link_paths.push(path);
                //Рисование навания связи
                let link_text = new PIXI.Text(
                    link.color.name,
                    new PIXI.TextStyle({
                        fontSize: 12,
                        fontWeight: 600,
                        fontFamily: 'Helvetica'
                    }));
                link_text.data = link;
                link_text.anchor.set(0.5);
                link_text.x = (link.character1.x + link.character2.x) / 2 - link_text.width/2 + 8;
                link_text.y = (link.character1.y + link.character2.y) / 2 - link_text.height/2 - 8;

                let link_name_tan = (link.character2.y - link.character1.y) / (link.character2.x - link.character1.x);
                link_text.rotation = Math.atan(link_name_tan);

                link_texts.push(link_text);
                link_container.addChild(path, link_text);
            });


            this.data.characters.forEach(character => {
                //Рисование персонажа на канвасе
                let character_container = new PIXI.Container();
                character_container.cursor = 'pointer';
                character_container.interactive = true;
                character_container.id = character.id;
                character_container.x = character.x;
                character_container.y = character.y;
                this.pixi.stage.addChild(character_container);

                let texture = PIXI.Texture.from(character.image);
                texture.baseTexture.scaleMode = PIXI.SCALE_MODES.LINEAR;
                let element = new PIXI.Sprite(texture);
                element.anchor.set(0.5);
                element.x = 0;
                element.y = 0;
                element.width = 70;
                element.height = 70;

                //Рисование имени персонажа на канвасе
                let element_text = new PIXI.Text(
                    `${character.first_name}\n${character.last_name}`,
                    new PIXI.TextStyle({
                        fontSize: 12,
                        fontFamily: 'Helvetica'
                    }));
                element_text.x = element.x - element_text.width/2;
                element_text.y = element.y + element.height/2 + 5;

                character_container.addChild(element, element_text);



                character_container.on('pointerdown', (e)=>{
                    character_container.drag = true;
                    character_container.alpha = 0.7;
                });
                character_container.on('pointermove', (e)=>{
                    if(character_container.drag){
                        let canvas = document.getElementById("canvas");
                        let new_x = e.clientX - canvas.offsetLeft;
                        let new_y = e.clientY - canvas.offsetTop;

                        character_container.x = new_x;
                        character_container.y = new_y;

                        link_paths.find(path => {
                            if(path.data.character1.id === character_container.id){
                                path.clear();
                                path.data.character1.x = new_x;
                                path.data.character1.y = new_y;
                                path.lineStyle(4, path.data.color.value, 1);
                                path.moveTo(new_x, new_y);
                                path.lineTo(path.data.character2.x, path.data.character2.y);



                                link_texts.find(text => {
                                    if(text.data.character1.id === path.data.character1.id && text.data.character2.id === path.data.character2.id){
                                        text.x = (path.data.character1.x + path.data.character2.x) / 2 - text.width/2 + 8;
                                        text.y = (path.data.character1.y + path.data.character2.y) / 2 - text.height/2 - 8;

                                        let link_name_tan = (path.data.character2.y - path.data.character1.y) / (path.data.character2.x - path.data.character1.x);
                                        text.rotation = Math.atan(link_name_tan);
                                    }
                                });
                            }
                        });


                        link_paths.find(path => {
                            if(path.data.character2.id === character_container.id){
                                path.clear();
                                path.data.character2.x = new_x;
                                path.data.character2.y = new_y;
                                path.lineStyle(4, path.data.color.value, 1);
                                path.moveTo(new_x, new_y);
                                path.lineTo(path.data.character1.x, path.data.character1.y);

                                link_texts.find(text => {
                                    if(text.data.character1.id === path.data.character1.id && text.data.character2.id === path.data.character2.id){
                                        text.x = (path.data.character1.x + path.data.character2.x) / 2 - text.width/2 + 8;
                                        text.y = (path.data.character1.y + path.data.character2.y) / 2 - text.height/2 - 8;

                                        let link_name_tan = (path.data.character2.y - path.data.character1.y) / (path.data.character2.x - path.data.character1.x);
                                        text.rotation = Math.atan(link_name_tan);
                                    }
                                });
                            }
                        });
                    }

                });
                character_container.on('pointerup', (e)=>{
                    character_container.drag = false;
                    character_container.alpha = 1;

                    $.ajax({
                        url: "/character/position_edit",
                        type: "POST",
                        data: {
                            character_id: character_container.id,
                            x: character_container.x,
                            y: character_container.y,
                        },
                        success: ()=>{

                        }
                    });
                });
            });
        },







        color_create(){
            this.loading = true;

            let link_name = $('#link_name').val();
            let color = $('#color').val();

            $.ajax({
                url: "/color/create",
                type: "POST",
                data: {
                    name: link_name,
                    value: color,
                    book_id: this.book_id
                },
                success: ()=>{
                    this.all_info();
                }
            });
        },

        color_delete(color_id){
            this.loading = true;

            $.ajax({
                url: "/color/delete",
                type: "POST",
                data: {
                    id: color_id
                },
                success: ()=>{
                    this.all_info();
                }
            });
        },

        link_create(){
            this.loading = true;

            let character_1 = $('#link_character_1').val();
            let link_color = $('#link_color').val();
            let character_2 = $('#link_character_2').val();

            $.ajax({
                url: "/link/create",
                type: "POST",
                data: {
                    character1_id: character_1,
                    color_id: link_color,
                    character2_id: character_2,
                    book_id: this.book_id
                },
                success: ()=>{
                    this.all_info();
                }
            });
        },

        link_delete(link_id){
            this.loading = true;

            $.ajax({
                url: "/link/delete",
                type: "POST",
                data: {
                    id: link_id,
                },
                success: ()=>{
                    this.all_info();
                }
            });
        }
    },
});
