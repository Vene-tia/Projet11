const btnFullscreen = document.querySelectorAll('.fullscreen')
const lightbox = document.querySelector('.lightbox')
const quitter_lightbox = document.querySelector('.close_lightbox')
const imgchargement = document.getElementById('imgchargement')
const imgavant = document.querySelector('.before_lightbox')
const imgapres = document.querySelector('.next_lightbox')
const refimg = document.querySelector('.lightbox__ref')
const catimg = document.querySelector('.lightbox__cat')
const cat = document.querySelectorAll('.categorie')
let Showlightbox = false
let ArrayIndex = null

btnFullscreen.forEach((btn,i)=>{
    btn.addEventListener("click", () => {
        Checklightbox()
        ArrayIndex = i
        imgchargement.src = imagepost[ArrayIndex].currentSrc
        catimg.innerText = (cat[ArrayIndex].innerText)
        refimg.innerText = (imagepost[ArrayIndex].getAttribute("data-imgid"))
    })
})

quitter_lightbox.addEventListener("click", () => {
    Checklightbox()
})

imgapres.addEventListener("click", () => {
    AddIMG()
})

imgavant.addEventListener("click", () => {
    MinusIMG()
})

// FUNCTIONS //

function Checklightbox() {
    console.log("running check lightbox ... ");
    if (Showlightbox) {
            lightbox.style.display = "none"
            Showlightbox = false
        }
        else {
            lightbox.style.display = "flex"
            Showlightbox = true
        }
}

function AddIMG() {
    const imagepost = document.querySelectorAll('.post_img')
    if (ArrayIndex === imagepost.length-1) {
        ArrayIndex = 0
        }
    else {
        ArrayIndex ++
    }
    imgchargement.src = imagepost[ArrayIndex].currentSrc
    catimg.innerText = (cat[ArrayIndex].innerText)
    refimg.innerText = (imagepost[ArrayIndex].getAttribute("data-imgid"))
}

function MinusIMG() {
    const imagepost = document.querySelectorAll('.post_img')
    if (ArrayIndex === 0) {
        ArrayIndex = imagepost.length-1
        }
    else {
        ArrayIndex --
    }
    imgchargement.src = imagepost[ArrayIndex].currentSrc
    catimg.innerText = (cat[ArrayIndex].innerText)
    refimg.innerText = (imagepost[ArrayIndex].getAttribute("data-imgid"))
}