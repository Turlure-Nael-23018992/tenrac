const loginElement = document.getElementById("login");
const cont_login = document.getElementById("cont_login");
console.log('loginElement');
cont_login.addEventListener("click", function(element) {
    if (getComputedStyle(loginElement).display ==  "flex" && !loginElement.contains(element.target)) {
        popup();
    }
  
});

// Fonction pour toggle le formulaire de login
function popup() {
    console.log(getComputedStyle(loginElement).display );
  if (getComputedStyle(loginElement).display === "flex") {
    
    loginElement.style.display = "none"; 
  } else {
    loginElement.style.display = "flex"; 
  }
}