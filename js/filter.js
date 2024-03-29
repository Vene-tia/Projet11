// JQUERY
$(document).ready(function () {
	const plusBtn = $(".plus_btn")
	const category = $("#category")
	const format = $("#formats")
	const date = $("#date")

	const selectOptions = $(".select-options").children()

	for (let index = 0; index < selectOptions.length; index++) {
		const element = selectOptions[index]
		element.addEventListener("click", (e) => {
			console.log(e.target.innerHTML)
			page = 1
			container.html("")
			ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)
		})
	}

	const container = $(".filtre")

	let page = 1
	const wordpressUrl = "http://nathalie-mota-local.local/"
	// var wordpressUrl = "http://localhost:10034/"

	plusBtn.click(() => {
		// passer a la deuxieme page
		page++
		ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)
	})

	/*  refactor   */
	// category.change(() => {
	// 	// Réinitialisez la page actuelle à 1 lorsque les filtres sont modifiés
	// 	page = 1
	// 	console.log("filter by category")
	// 	container.html("")
	// 	ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)

	// 	//ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)
	// })

	// format.change(() => {
	// 	// Réinitialisez la page actuelle à 1 lorsque les filtres sont modifiés
	// 	page = 1
	// 	console.log("filter by format")
	// 	container.html("")
	// 	ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)

	// 	//ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)
	// })

	// date.change(() => {
	// 	// Réinitialisez la page actuelle à 1 lorsque les filtres sont modifiés
	// 	page = 1
	// 	console.log("filter by date")
	// 	container.html("")
	// 	ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)

	// 	//ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)
	// })
})

//  fonction qui fait la requête ajax
function ajaxCall(url, page) {
	const btnChargement = $(".btn_chargement")

	const selectArray = document.querySelectorAll(".select")

	//console.log(selectArray[0].lastChild.innerHTML)
	const category = selectArray[0].lastChild.innerHTML
	const format = selectArray[1].lastChild.innerHTML
	const byDate = selectArray[2].lastChild.innerHTML
	// let format = $("#formats option:selected").text()
	// let byDate = $("#date option:selected").text()

	// check empty values
	// if (category === "Categories") {
	// 	category = 0
	// }
	// if (format === "Formats") {
	// 	format = 0
	// }
	// if (byDate === "Tirer par Date") {
	// 	byDate = 0
	// }

	console.log(category, format, byDate)

	$.ajax({
		url,
		type: "POST",
		// data for the backend
		data: {
			action: "charger_plus",
			page,
			category,
			format: $("#formats option:selected").text(),
			byDate,
		},
		success: function (reponse) {
			// s'il n'y a pas de réponse
			if (reponse == 0) {
				btnChargement.remove()
				return
			}
			// apprend la réponse
			$(".filtre").append(reponse)
		},
		error: function (error) {
			console.log("Error:", error)
		},
	})
}

// sans jQuery
// document.addEventListener("DOMContentLoaded", () => {
// 	const plusBtn = document.querySelector(".plus-btn")
// 	plusBtn.addEventListener("click", () => {
// 		console.log("clicked sans jQuery !!!!!!")
// 	})
// })
