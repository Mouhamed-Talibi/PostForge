window.addEventListener("load", function() {
    console.log("Page fully loaded!"); // Debug check
    document.getElementById("loader").style.display = "none";
    document.getElementById("content").classList.add("show");
});