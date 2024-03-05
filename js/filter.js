// JQUERY
$(document).ready(function () {

    const wordpressUrl = "http://nathalie-mota.local/"
    const plusBtn = $(".plus_btn")
    plusBtn.click(() => {
       $.ajax({
        url: wordpressUrl + "/wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "charger_plus",
            test_name: "fvfqd",
        },
        success: function (reponse) {
            console.log(reponse)
            plusBtn.remove()
        },
        error: function (error) {
            console.log("Error:", error)
        },
       })
    })    
})