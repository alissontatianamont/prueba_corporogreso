
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


const inputExcel = document.getElementById('archivo_excel');

inputExcel.addEventListener('change', function() {
    const file = this.files[0]; 

    if (file) {
      const fileSizeInMB = file.size / (1024 * 1024); 

      if (fileSizeInMB >= 10) {  
        alert("El archivo es demasiado grande. Por favor, elige un archivo de menos de 10 MB.");
        this.value = "";  // Limpia el input
      } 
    }
});