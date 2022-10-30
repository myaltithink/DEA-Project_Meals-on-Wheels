function generateElement(elementTarget: string, classList?: Array<string>, innerHTML?:string,
    attribute?: Object) : Element{

    const element = document.createElement(elementTarget);

    if(classList){
        classList?.forEach( e => {
            element.classList.add(e);
        });
    }

    if (innerHTML){
        element.innerHTML = innerHTML;
    }

    if (attribute && Object.keys(attribute).length !== 0){
        Object.entries(attribute).forEach(([key, value]) => {
            element.setAttribute(key, value);
        });
    }

    return element;
}

export default generateElement;
