document.getElementById('independent').addEventListener('change', function() {
    let mediaCompanyInput = document.getElementById('media_company');
    if (this.checked) {
        mediaCompanyInput.value = '';
        mediaCompanyInput.disabled = true;
    } else {
        mediaCompanyInput.disabled = false;
    }
});