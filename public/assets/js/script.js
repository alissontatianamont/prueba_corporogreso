
function close_modal(){
    let card_modal = document.getElementById('card-success');
    card_modal.classList.add('d-none');
}
document.addEventListener("DOMContentLoaded", function() {
    var fileInput = document.getElementById("archivo_excel");
    var selectedFilename = document.getElementById("selected-filename");
    
    fileInput.addEventListener("change", function() {
        var filename = this.value.split('\\').pop();
        selectedFilename.textContent = filename;
    });
});


