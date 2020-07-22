$(document).ready(function () {


    $('#selectAllboxes').click(function (event) {
        if (this.checked){
            console.log("allCheckbox", this.checked)
            $(".checkBoxes").each(function () {
                this.checked = true;
            })
        }else {
            $('.checkBoxes').each(function () {
                    this.checked = false;
            })
        }
    })

})

let dib_box = "<div id='load-screen'><div id='loading'></div></div>";
$("body").prepend(dib_box);
$('#load-screen').delay(700).fadeOut(600, function () {
    $(this).remove();
})

function loadUserOnline() {
    $.get("functions.php?onlineusers=result",function (data) {
        console.log("data",data);
        $(".usesonline").text(data);
    })

}

setInterval(function () {
loadUserOnline()
},5000)





