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
	const wordpressUrl = "http://nathalie-mota.local/"
	// var wordpressUrl = "http://localhost:10034/"

	plusBtn.click(() => {
		// passer à la deuxieme page
		page++
		ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)
	})

	/*  refactor   */
	category.change(() => {
		// Réinitialiser la page actuelle à 1 lorsque les filtres sont modifiés
		page = 1
		//console.log("filter by category")
		container.html("")
		ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)

		//ajaxCall(wordpressUrl + "/wp-admin/admin-ajax.php", page)
	})
})

//  fonction qui fait la requête ajax
function ajaxCall(url, page) {
	const btnChargement = $(".btn_chargement")

	const selectArray = document.querySelectorAll(".select")

	//console.log(selectArray[0].lastChild.innerHTML)
	const category = selectArray[0].lastChild.innerHTML
	const format = selectArray[1].lastChild.innerHTML
	const byDate = selectArray[2].lastChild.innerHTML

	console.log(category, format, byDate)

	$.ajax({
		url,
		type: "POST",
		// data for the backend
		data: {
			action: "charger_plus",
			page,
			category,
			format,
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
			//console.log(reponse);
			const btnFullscreen = document.querySelectorAll('.fullscreen')
			const imagepost = document.querySelectorAll('.post_img')

			btnFullscreen.forEach((btn,i)=>{
				btn.addEventListener("click", () => {
					Checklightbox()
					ArrayIndex = i
					imgchargement.src = imagepost[ArrayIndex].currentSrc
					catimg.innerText = (cat[ArrayIndex].innerText)
					refimg.innerText = (imagepost[ArrayIndex].getAttribute("data-imgid"))
				})
			})
		},
		error: function (error) {
			console.log("Error:", error)
		},
	})
}
