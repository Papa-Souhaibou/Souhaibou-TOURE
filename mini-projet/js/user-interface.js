var tabs = document.querySelectorAll(".tabs a");
const tabContent = document.querySelectorAll(".tab-content");
tabs.forEach((tab) => {
    tab.addEventListener("click", event => {
        for (const div of tabContent) {
            if(div.classList.contains("active")){
                div.classList.remove("active");
            }
        }
        for (const a of tabs) {
            const li = a.parentNode;
            a.style.color = "inherit";
            if(li.classList.contains("active")){
                li.classList.remove("active");
            }
        }
        const divId = event.target.getAttribute("href");
        event.target.style.color = "darkturquoise";
        event.target.parentNode.classList.add("active");
        const div = document.querySelector(divId);
        div.classList.add("active");
    });
});