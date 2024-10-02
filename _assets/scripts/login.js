const loginElement = document.getElementById("login");
const cont_login = document.getElementById("cont_login");
const container = document.querySelector(".formco-container")
cont_login.addEventListener("click", function(element) {
    if (getComputedStyle(loginElement).display ==  "flex" && !loginElement.contains(element.target)) {
        popup();
    }
  
});

// Fonction pour toggle le formulaire de login
function popup() {
  if (getComputedStyle(loginElement).display === "flex") {
    cont_login.style.display = "none";
    container.style.display = "none";
    document.body.style.overflow = "auto";
    loginElement.style.display = "none"; 
  } else {
    cont_login.style.display = "block";
    container.style.display = "block";
    document.body.style.overflow = "hidden";
    loginElement.style.display = "flex"; 
  }
}