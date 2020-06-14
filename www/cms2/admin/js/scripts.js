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