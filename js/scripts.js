const btn = document.querySelector(".modale")
btn.addEventListener("click", ()=>{
    document.getElementById('id01').style.display='block'
})

window.addEventListener("click", (event)=>{
    if (event.target == document.querySelector('.w3-modal')) {
        document.getElementById('id01').style.display = "none";
      }
})

console.log(window.location.pathname)
if (window.location.pathname!="/"){
    const btnctn = document.querySelector(".button_contact")
    if (btnctn) {
        btnctn.addEventListener("click", ()=>{
            document.getElementById('id01').style.display='block'
            //const ref_contact = document.getElementById('ref_contact')
            //const ref_input = document.querySelectorAll('.wpcf7-text')[2]
            //ref_input.value = ref_contact.value
            const ref_contact = document.getElementById("BF").textContent
            const ref_input = document.querySelectorAll('.wpcf7-text')[2]
            ref_input.value = ref_contact
            console.log(document.getElementById("BF").textContent)
        })
    }



window.addEventListener("click", (event)=>{
    if (event.target == document.querySelector('.w3-modal')) {
        document.getElementById('id01').style.display = "none";
      }
})
}


const menu_btn = document.querySelector('.burger-btn')
const navMobile = document.querySelector('.nav-mobile')
const croixBurger =  document.querySelector('#croix-burger')
const menuBurger =  document.querySelector('#menu-burger')

let showMobileNav = false

menu_btn.addEventListener('click', ()=>{
    /* ferme le menu mobile  */
    if(showMobileNav){
        navMobile.style.display = "none";
        showMobileNav = false
        croixBurger.style.display = "none"
        menuBurger.style.display = "block"
    /* ouvrir le menu mobile  */
    }else{
        navMobile.style.display = "block";
        showMobileNav = true
        croixBurger.style.display = "block"
        menuBurger.style.display = "none"

    }
})