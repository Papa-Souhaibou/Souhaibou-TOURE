const aElts = document.querySelectorAll("#setting-items > table a");
const images = document.querySelectorAll("#setting-items > table img");
const trElts = document.querySelectorAll("#setting-items > table tr");

aElts.forEach(function (a) {
    a.addEventListener("click",function (event) {
        event.preventDefault();
        images.forEach(image => {
            if(image.getAttribute("class") === "add")
                image.setAttribute("src","img/icones/ic-ajout.png");
            else if(image.getAttribute("class") === "list")
                image.setAttribute("src","img/icones/ic-liste.png");
        });
        trElts.forEach(element => {
            element.removeAttribute("class");
        });
        const trElt = this.parentNode.parentNode;
        trElt.setAttribute("class","active");
        const lastTdEl = trElt.lastElementChild;
        const aElt = lastTdEl.firstElementChild;
        const img = aElt.firstElementChild;
        if(img.getAttribute("class") === "add"){
            img.setAttribute("src","img/icones/ic-ajout-active.png");
        }
        else if(img.getAttribute("class") === "list"){
            img.setAttribute("src","img/icones/ic-liste-active.png");
        }
    })
});
