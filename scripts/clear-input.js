function clearInput() {
    document.forms[0].reset();
    var inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.setAttribute("value", "");
    });
}