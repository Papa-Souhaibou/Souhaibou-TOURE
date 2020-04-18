const contents = document.querySelectorAll("#displays-pages > div");
for (const content of contents) {
    content.style.display = "none";
}
const home = document.querySelector("#liste-question");
home.style.display = "block";
const menu = document.querySelectorAll("#setting-items > a");
for (const item of menu) {
    item.addEventListener("click", event => {
        for (const content of contents) {
            content.style.display = "none";
        }
        for(const a of menu){
            const aClass = a.classList[0];
            a.setAttribute("class",aClass);
        }
        const itemPreviousClass = event.target.getAttribute("class");
        if(itemPreviousClass === "add"){
            event.target.setAttribute("class",itemPreviousClass+" active add-active");
        }else if(itemPreviousClass === "list"){
            event.target.setAttribute("class",itemPreviousClass+" active list-active");
        }
        const displayDivId = event.target.getAttribute("href");
        let displayValue = "block";
        if(displayDivId === "#create"){
            displayValue = "flex";
        }
        const displayDiv = document.querySelector(displayDivId);
        displayDiv.style.display = displayValue;
    });
}

window.addEventListener("load", event => {
    for (const content of contents) {
        content.style.display = "none";
    }
    const href = window.location.href.split("#")[1];
    const showContent = document.querySelector("#"+href);
    showContent.style.display = "block";
});