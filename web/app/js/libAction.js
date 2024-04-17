function clearForm(formId) {
    var form = document.getElementById(formId);
    for (var i = 0; i < form.elements.length; i++) {
        var element = form.elements[i];
        if (element.name != "lang" && element.name != "userId" && element.name != "USER_UPDATED" && element.name != "USER_CREATED") {
            if (element.type == "radio" || element.type == "checkbox") {
                element.checked = false;
            } else {
                element.value = "";
            }
        }
        element.disabled = false;
    }
    $(".select2").trigger("change");
    const disabledOrFormInputs = document.querySelectorAll(".disabled");
    disabledOrFormInputs.forEach((input) => {
        input.disabled = true;
    });
}

function resetValidate(formId) {
    var form = document.getElementById(formId);
    form.classList.remove("was-validated");
}
