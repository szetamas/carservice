function validateSearchInputs(clientNameInput, clientIdInput) {
    clientNameInput.parent().parent().find('.invalid-feedback').remove();
    clientNameInput.addClass('is-invalid');
    clientIdInput.addClass('is-invalid');
    let errorMessage = `
    <div class="invalid-feedback">
      You have to write something to one input
    </div>`;
    if (clientNameInput.val().length > 0) {
        if (clientIdInput.val().length === 0) {
            clientNameInput.removeClass('is-invalid');
            clientIdInput.removeClass('is-invalid');
            return true;
        } else {
            errorMessage = `
              <div class="invalid-feedback">
                You could use just one input
              </div>`;
        }
    } else if (clientIdInput.val().length > 0) {
        if (clientNameInput.val().length === 0) {
            if (/^[a-zA-Z0-9]+$/.test(clientIdInput.val())) {
                clientNameInput.removeClass('is-invalid');
                clientIdInput.removeClass('is-invalid');
                return true;
            } else {
                clientNameInput.removeClass('is-invalid');
                errorMessage = `
                <div class="invalid-feedback">
                  Your id input could has just letters and numbers
                </div>`;
            }
        } else {
            errorMessage = `
              <div class="invalid-feedback">
                You could use just one input
              </div>`;
        }
    }
    clientNameInput.after(errorMessage);
    clientIdInput.after(errorMessage);
    return false;
}
