//  https://codepen.io/wallaceerick/pen/nJLPvN

document.addEventListener("DOMContentLoaded", () => {
	let selectArray = Array.from(document.querySelectorAll("select"))

	selectArray.splice(0, 2);

	console.log(selectArray);

	selectArray.forEach((selectElem, i) => {
		// hiden class to native select element
		// if(i === 0 || i === 1){
		// 	return
		// }
		selectElem.classList.add("select-hidden")
		
		const options = selectElem.children
		// console.log(selectArray, selectElem);

		const luContainer = document.createElement("ul")
		luContainer.classList.add("select-options")

		const selectPlaceholder = document.createElement("div")
		selectPlaceholder.classList.add("select")
		selectPlaceholder.setAttribute("data-indx", i)

		const spanHolder = document.createElement("span")
		spanHolder.innerHTML = options[0].innerHTML
		spanHolder.setAttribute("data-indx", i)

		addOptions(luContainer, options, selectPlaceholder)

		selectPlaceholder.append(spanHolder)

		selectPlaceholder.addEventListener("click", (e) => {
			e.stopPropagation()
			toggleOptions(e.target.getAttribute("data-indx"))
			// luContainer.style.display = "block"
			// selectPlaceholder.style.borderColor = "#215AFF"
		})

		// the first two are added to a div ".filtre_gauche"
		if (i <= 1) {
			document.querySelector(".filtre_gauche").append(selectPlaceholder)
		} else {
			document.querySelector(".form-filter").append(selectPlaceholder)
		}
	})

	// close the select
	window.addEventListener("click", () => {
		const customSelectArray = document.querySelectorAll(".select")
		customSelectArray.forEach((element) => {
			element.firstChild.style.display = "none"
			element.style.borderColor = "#b8bbc2"
		})
	})

	function toggleOptions(i) {
		//console.log(customSelectArray[i])

		const customSelectArray = document.querySelectorAll(".select")
		customSelectArray[i].firstChild.style.display = "block"
		customSelectArray[i].style.borderColor = "#215AFF"
	}
})

function addOptions(container, options, selectHolder) {
	for (let index = 1; index < options.length; index++) {
		const element = options[index]
		const liOption = document.createElement("li")
		liOption.innerHTML = element.innerHTML

		liOption.addEventListener("click", (e) => {
			// console.log(e.target.innerHTML, luContainer)
			e.stopPropagation()
			container.style.display = "none"
			// selectHolder.firstChild.innerHTML = liOption.innerHTML
			selectHolder.style.borderColor = "#b8bbc2"
			setSelected(
				e.target.innerHTML,
				liOption.parentElement.nextSibling.getAttribute("data-indx")
			)
		})

		container.append(liOption)
	}

	selectHolder.append(container)
}

function setSelected(value, parentIndex) {
	const customSelectArray = document.querySelectorAll(".select")
	customSelectArray[parentIndex].lastChild.innerHTML = value
}
