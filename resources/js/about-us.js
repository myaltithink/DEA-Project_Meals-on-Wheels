const aboutTabSelector = document.querySelectorAll(".nav-tab-selector");

aboutTabSelector.forEach(selector => {
    selector.addEventListener("click", function(){
        aboutTabSelector.forEach(e => {
            e.setAttribute("data-navtabs-selected", false);
        });
        selector.setAttribute("data-navtabs-selected", true);
        displayAboutContent(aboutTabSelector, selector);
    });
});

function displayAboutContent(collections, selector){

    collections.forEach((collection) => {
        const target = collection.getAttribute("data-navtabs-target");
        const currentTab = document.querySelector(target);

        setTimeout(()=>{
            currentTab.setAttribute("data-navtab-toggled", false);
            },400)
            currentTab.classList.remove("tab-active");
    });

    const target = selector.getAttribute("data-navtabs-target");
    const targetTab = document.querySelector(target);
    setTimeout(()=>{
        targetTab.setAttribute("data-navtab-toggled", true);
    },400);
    targetTab.classList.add("tab-active");
}

/*forget password*/

const forgetPasswordSelector = document.querySelectorAll(".nav-forget-password-selector");

forgetPasswordSelector.forEach((tabSelector) => {
    tabSelector.addEventListener("click", function(){
        if (tabSelector.getAttribute("data-fp-enabled") == "true"){

            forgetPasswordSelector.forEach(e => {
                e.setAttribute("data-fp-active", false);
            });
            tabSelector.setAttribute("data-fp-active", true);
           switchForgetPasswordTab(forgetPasswordSelector, tabSelector);
        }
    });
});

function switchForgetPasswordTab(collections, selector){

    collections.forEach((collection) => {
        const target = collection.getAttribute("data-fp-target");
        const currentTab = document.querySelector(target);

        setTimeout(()=>{
            currentTab.setAttribute("data-fp-toggled", false);
            },400)
            currentTab.classList.remove("tab-active");
    });

    const target = selector.getAttribute("data-fp-target");
    const targetTab = document.querySelector(target);

    setTimeout(()=>{
        targetTab.setAttribute("data-fp-toggled", true);
    },400);
    targetTab.classList.add("tab-active");
}
