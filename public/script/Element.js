import { finalElement } from "./FinalElement.js"

export class Element{

    constructor(element,finalOne){
        this.element = element
        this.finalElement = finalOne
        this.element.addEventListener('focusout', this.createFinalElement.bind(this))
        if(document.querySelector('.t-texte')!= undefined){
            this.removeBox() }
            
        const clone = document.querySelector('#t-text').content.cloneNode(true)
        document.querySelector('#widgets').append(clone)
        document.querySelector('.widgets').style.display = 'none'
        document.querySelector('#imgWidget').addEventListener('click', this.removeBox)
        
        this.box = document.querySelector('.t-texte')


    }
    createFinalElement(e){
        let content = e.target.value
        if(content == ''){
            e.target.remove()
            this.removeBox()
        }
        else{
            this.elementCreate = document.createElement(this.finalElement)
            this.elementCreate.innerText = e.target.value
           

            for(let i=0;i<e.target.style.length; i++){
                const targetStyle = e.target.style[i]
                this.elementCreate.style[targetStyle] = e.target.style[targetStyle]
            }
            perso.insertBefore(this.elementCreate,e.target)

            
            for(const input of this.box.querySelectorAll('input')){
                input.addEventListener('change', this.updateStyle.bind(this))
            }

            for(const select of this.box.querySelectorAll('select')){
                select.addEventListener('change', this.updateUnit.bind(this))
            }

            new finalElement(this.elementCreate,this.element.tagName)

            e.target.remove()
        }
       

    }
    removeBox(){

            document.querySelector('.t-texte').remove()
            document.querySelector('#imgWidget').remove()
            document.querySelector('.widgets').style.display = 'flex'
            
    }
    updateStyle(e){
        const styleTarget = e.target.getAttribute('id')
        const unit = e.target.dataset.unit == null ? '' : e.target.dataset.unit
        const value = e.target.value + unit

        this.elementCreate.style[styleTarget] = value
       

        
    }
    updateUnit(e){
        const target = e.target.dataset.pour
        console.log(this.box);
        this.box.querySelector('#'+ target).dataset.unit = e.target.value
    }
}