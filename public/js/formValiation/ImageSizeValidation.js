
let size;
// let image_required_validation = "{{trans('tms::training.image_required_validation')}}" 
// let image_size_validation = "{{trans('tms::training.image_size_validation')}}";
$('.validateImageFile-Label').hide()
$(".validateImageFile").change( function () {
    let fileSize = (this.files.item(0).size / 1024);
    if(fileSize > 3000){
        $('.validateImageFile-Label').show()
        size = fileSize;
    }else{
        $('.validateImageFile-Label').hide()
    }
});


$('#imageSizeValidatedFormSubmitButton').click( function (event) {
    if(size > 3000 ){
        event.preventDefault();
        window.scrollTo(0, 0);
    }else{
        console.log(size);
    }
})