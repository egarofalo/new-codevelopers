jQuery(function () {
    submit_forms_with_disable_on_submit();
    submit_forms_with_bootstrap_validation();
});

function submit_forms_with_disable_on_submit() {
    // Fetch all the forms we want to apply the loading state to
    var forms = document.querySelectorAll("form.disable-on-submit");
    // Loop over them and add loading class to submit button
    Array.prototype.forEach.call(forms, function (form) {
        form.addEventListener("submit", function (event) {
            form.querySelector('[type="submit"]').disabled = true;
            form.querySelector('[type="submit"]').classList.add("submitting");
        });
    });
}

function submit_forms_with_bootstrap_validation() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName("needs-validation");
    // Loop over them and prevent submission
    Array.prototype.forEach.call(forms, function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();

                    if (form.classList.contains("disable-on-submit")) {
                        form.querySelector('[type="submit"]').disabled = false;
                        form.querySelector('[type="submit"]').classList.remove(
                            "submitting"
                        );
                    }
                }
                form.classList.add("was-validated");
            },
            false
        );
    });
}
