import { Element } from './Element.js'


export class Widget{
    
        static img = new Image()
        static id = 0
    
    constructor(element, elementCreate,finalElement){
        this.elementCreate = elementCreate
        this.finalElement = finalElement
        this.element = element
        if(Widget.img.src == ""){
            Widget.img.src = '../img/barre.webP'
        }
        

        this.element.addEventListener('click',this.createElement.bind(this))
        this.element.addEventListener('dragstart', this.dragElement.bind(this))


    }
    createElement(){
        const element = document.createElement(this.elementCreate)
        perso.append(element)
        element.focus()
        new Element(element,this.finalElement)
       

    }
    dragElement(e){
        
        let imgWidth = (Widget.img.width/2)
        e.dataTransfer.setDragImage(Widget.img,imgWidth,30)
        e.dataTransfer.effectAllowed='copy'
        const dataList = e.dataTransfer.items
        dataList.add('element','prout')
    }
   
}