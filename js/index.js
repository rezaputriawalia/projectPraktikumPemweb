const container = document.querySelector(".container");
const registerBtn = document.getElementById("register");
const loginBtn = document.getElementById("login");
const urlParams = new URLSearchParams(window.location.search);

registerBtn.addEventListener("click", () => {
    container.classList.add("right-panel-active");
});

loginBtn.addEventListener("click", () => {
    container.classList.remove("right-panel-active");
});

if (urlParams.get("mode") === "register") {
    console.log("masuk");
    
    container.classList.add("right-panel-active");
}
