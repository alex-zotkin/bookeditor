$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// $("input[type=file]").each((i, el) => {
//     console.log($(el))
//     $(el).change(event => {
//         console.log(event)
//     })
// })
