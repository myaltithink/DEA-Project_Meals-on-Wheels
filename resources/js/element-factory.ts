/**
 * Factory for generating element.
 *
 * @param elementTarget takes in argument of which element to be generated
 * @param classList takes in array as argument for what class is to be applied
 * @param innerHTML takes in string as argument as for what should be inside of the element
 * @param attribute takes in Object with key/value pair for some attributes that is not mention such as style, data attributes, id, and so on.
 * @returns HTMLElement
 */
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
