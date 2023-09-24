import { Widget } from "./Widget.js";
import { Element } from "./Element.js";
import { finalElement } from "./FinalElement.js";



const perso = document.querySelector('#perso');
const widgets = document.querySelectorAll('.widget')
const sauvegarde = document.querySelector('#sauvegarde')


for(const widget of widgets){
    new Widget(widget,'input','h2')
}


perso.addEventListener('dragover',e=>{
    e.preventDefault()  
    e.dataTransfer.dropEffect = "copy"    
})

perso.addEventListener('drop', e=>{
    e.preventDefault()
    const input = document.createElement('input')
    
    perso.append(input)
    input.style.position = "absolute"
    input.style.top = (e.offsetY/ perso.clientHeight) *100 +"%"
    input.style.left = (e.offsetX/perso.clientWidth) *100 + "%"
    input.style.transform = "translate(-50%,-50%)"
    input.focus()
    input.dataset.elem = "drag"
    new Element(input, 'h2')


    
    
})

for(const child of perso.children){
    
    new finalElement(child, 'input')
}




sauvegarde.addEventListener('click',e=>{
    e.stopPropagation()
    let ajax = new XMLHttpRequest
    ajax.open("POST", 'http://localhost:8000/', true)
    let data = new FormData()
    data.append(perso.getAttribute('id'), perso.outerHTML)
    ajax.send(data)
    ajax.addEventListener('load',e=>{
        const template = document.querySelector('#loading')
        const clone = template.content.cloneNode(true)
        document.querySelector('#widgets').append(clone)
        
    })

})

