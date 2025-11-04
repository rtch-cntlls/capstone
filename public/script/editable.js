document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const fields = [
        document.getElementById('firstname'),
        document.getElementById('lastname'),
        document.getElementById('email')
    ];
    editBtn.addEventListener('click', function () {
        fields.forEach(field => {
            field.removeAttribute('readonly');
            field.classList.add('editable-border');
        });
        editBtn.classList.add('d-none');
        saveBtn.classList.remove('d-none');
    });
});