function  toggleSidebar(){
    const sidebar = document.getElementById("sidebar");
    const title = document.getElementById("title");
    const main = document.getElementById("main");
    const cards = document.getElementById("cards");
    

    if (sidebar.style.width === "250px") {  
        sidebar.style.width = "0";
        title.style.marginLeft = "0";
        main.style.marginLeft = "0";
        cards.style.marginLeft = "0";
    
    } else {
        sidebar.style.width = "250px";
        title.style.marginLeft = "250px";
        main.style.marginLeft = "250px";
        cards.style.marginLeft = "250px";
    }
}

