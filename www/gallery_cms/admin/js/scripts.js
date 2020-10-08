$(document).ready(function (){
    let photo_href;
    let photo_href_splitted;
    let photo_id;
    let image_src;
    let image_href_splitted;
    let image_name;
    let image_id;
    $(".modal_thumbnails").click(function (){
        $("#set_user_image").prop('disabled',false);
        photo_href = $("#photo_id").prop('href');
        photo_href_splitted = photo_href.split("=");
        photo_id = photo_href_splitted[photo_href_splitted.length - 1];
        image_src = $(this).prop("src");
        image_href_splitted =image_src.split("/");
        image_name = image_href_splitted[image_href_splitted.length - 1];
        image_id = $(this).attr("data");
        $.ajax({
            url: "includes/ajax_code.php",
            data:{image_id:image_id},
            type:"POST",
            success: function (data) {
                if(!data.error) {
                    $(".photo-sidebar").html(data);
                }
            }
        })

    });
    $("#set_user_image").click(function () {
        $.ajax({
            url:"includes/ajax_code.php",
            data:{ image_name:image_name, photo_id:photo_id},
            type: "POST",
            success:function (data){
                if (!data.error){
                    console.log('data image',data.image_name);
                    $(".photo_image_box a img").prop('src', `images/${image_name}`)
                  // location.reload(true);
                }else {
                    console.log(data.error)
                }

            }
        })
    });

    tinymce.init({selector:'.textarea_editor'});
});



