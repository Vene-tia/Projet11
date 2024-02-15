class Lightbox {
    static init() {
        const links = document.querySelectorAll()
        .forEach(link.addEventListener('clik', e=> {
            e.preventDefault()
            new Lightbox(e.currentTarget.getAttribute())
        }))
    }

    constructor(url) {
        const element = this.buildDOM(url)
        document.body.appendChild(element)
    }   

    buildDOM(url) {
        const dom = document.createElement('div')
        dom.classList.add('lightbox')
        dom.innerHTML = `<button class="close_lightbox"></button>
        <button class="next_lightbox"></button>
        <button class="before_lightbox"></button>
        <div class="lightbox__container"></div>`
        dom.querySelector('.close_lightbox').addEventListener('click', this.close.bind(this))
        dom.querySelector('.next_lightbox').addEventListener('click', this.next.bind(this))
        dom.querySelector('.before_lightbox').addEventListener('click', this.prev.bind(this))
        return dom
    } 

    next (e) {
    e.preventDefault()
    let i = this.images.findIndex(image => image === this.url)
    if (i === this.images.length - 1) {
        i = -1
    }
    this.loadImage(this.images[i + 1])
    }

    prev (e) {
    e.preventDefault()
    let i = this.images.findIndex(image => image === this.url)
    if (i === 0) {
        i = this.images.length
    }
    this.loadImage(this.images[i - 1])
    }
}