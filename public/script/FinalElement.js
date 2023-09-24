import { Element } from "./Element.js"

export class finalElement{

    constructor(element,previous){
        this.element = element
        this.previous = previous
        this.element.addEventListener('click', this.inputUp.bind(this))
    }
    inputUp(e){

        let content = e.target.innerText
        const input = document.createElement(this.previous)
        input.value = content
        for(let i=0;i<e.target.style.length; i++){
            const targetStyle = e.target.style[i]
            console.log(targetStyle);
            input.style[targetStyle] = e.target.style[targetStyle]
        }
        
        perso.insertBefore(input,e.target)
        input.focus() 
       


        new Element(input, e.target.tagName)
        e.target.remove()
    }
}