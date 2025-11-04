const fileInput = document.getElementById('store-logo');
const preview = document.getElementById('preview');
const dropArea = fileInput.closest("label");

dropArea.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropArea.classList.add("border-success");
});

dropArea.addEventListener("dragleave", () => {
    dropArea.classList.remove("border-success");
});

dropArea.addEventListener("drop", (e) => {
    e.preventDefault();
    dropArea.classList.remove("border-success");
    fileInput.files = e.dataTransfer.files;
    previewFile(fileInput.files[0]);
});

fileInput.addEventListener("change", () => {
    if (fileInput.files.length > 0) {
        previewFile(fileInput.files[0]);
    }
});

function previewFile(file) {
    const reader = new FileReader();
    reader.onload = function (e) {
        preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail mt-2" width="150">`;
    };
    reader.readAsDataURL(file);
}