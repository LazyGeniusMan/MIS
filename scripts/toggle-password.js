function togglePassword() {
    var password = document.getElementById("password");
    var eye = document.getElementById("eye");
    if (password.getAttribute("type") == "password") {
        password.setAttribute("type", "text");
        eye.setAttribute("class", "fa fa-eye")
    } else {
        password.setAttribute("type", "password");
        eye.setAttribute("class", "fa fa-eye-slash")
    }
}