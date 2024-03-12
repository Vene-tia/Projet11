// JQUERY
$(document).ready(function () {
	const plusBtn = $(".plus_btn")
	const category = $("#categorie")
	const format = $("#format")
	const date = $("#date")

	const container = $(".filtre")

	let page = 1
	const wordpressUrl = "http://nathalie-mota.local/"
	//var wordpressUrl = "http://localhost:10034/"

	plusBtn.click(() => {
		// passer a la deuxieme page
		page++
		ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)
	})

	category.change(() => {
		// Réinitialisez la page actuelle à 1 lorsque les filtres sont modifiés
		page = 1
		console.log("filter by category")
		// container.html("hello")

		ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)
	})

	format.change(() => {
		// Réinitialisez la page actuelle à 1 lorsque les filtres sont modifiés
		page = 1
		console.log("filter by format")
		// container.html("")

		ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)
	})

	date.change(() => {
		// Réinitialisez la page actuelle à 1 lorsque les filtres sont modifiés
		page = 1
		console.log("filter by date")
		// container.html("")

		ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)
	})
})

//  fonction qui fait la requête ajax
function ajaxCall(url, page) {
	const btnChargement = $(".btn_chargement")
	const category = $("#categorie option:selected").text()
	const format = $("#format option:selected").text()
	const byDate = $("#date option:selected").text()

	console.log(category, format, byDate)

	$.ajax({
		url,
		type: "POST",
		data: {
			action: "charger_plus",
			page,
			category,
			format,
			byDate,
		},
		success: function (reponse) {
			// s'il n'y a pas de reponse
			if (reponse == 0) {
				btnChargement.remove()
				return
			}
			// append reponse
			$(".filtre").append(reponse)
		},
		error: function (error) {
			console.log("Error:", error)
		},
	})
}

// JQUERY
// $(document).ready(function () {

//     let page = 1 ;
//     const wordpressUrl = "http://nathalie-mota.local/"
//     const plusBtn = $(".plus_btn")
//     const btnChargement = $('.btn_chargement')
//     plusBtn.click(() => {
//        passer a la deuxieme page
//         page++
        
//        $.ajax({
//         url: wordpressUrl + "/wp-admin/admin-ajax.php",
//         type: "POST",
//         data: {
//             action: "charger_plus",
//             page
//         },
//         success: function (reponse) {            
//             console.log(reponse)
//             s'il n'y a pas de reponse
//             if(reponse == 0){
//                 btnChargement.remove()
//                 return
//             }
//             append reponse
//             $('.filtre').append(reponse)
//         },
//         error: function (error) {
//             console.log("Error:", error)
//         },
//        })
//     })    
// })