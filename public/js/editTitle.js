//Changer le titre form 
function toggleTitleForm(index, title) {
    var titleElement = document.getElementById('title-' + index);
    var formElement = document.getElementById('edit-form-' + index);
    var textareaElement = document.getElementById('textarea-' + index);

    if (titleElement && formElement && textareaElement) {
        // Toggle visibility
        if (formElement.style.display === 'none') {
            titleElement.style.display = 'none'; // Hide the title
            formElement.style.display = 'block'; // Show the form
            textareaElement.value = title; // Set the category title in the textarea
        } else {
            titleElement.style.display = 'block'; // Show the title
            formElement.style.display = 'none'; // Hide the form
        }
    }
}


function cancelEdit(index) {
    var titleElement = document.getElementById('title-' + index);
    var formElement = document.getElementById('edit-form-' + index);

    if (titleElement && formElement) {
        // Hide the form and show the title
        titleElement.style.display = 'block';
        formElement.style.display = 'none';
    }
}

//Changer le titre form end

// Ajouter une tache form
function toggleForm(formId) {
    var form = document.getElementById(formId);
    var addButton = document.getElementById('add-btn-' + formId.split('-')[1]);

    if (form.style.display === "none") {
        form.style.display = "block";
        addButton.style.display = "none";
    } else {
        form.style.display = "none";
        addButton.style.display = "block";
    }
}

function cancelForm(formId) {
    var form = document.getElementById(formId);
    var addButton = document.getElementById('add-btn-' + formId.split('-')[1]);

    // Clear form fields
    form.reset();

    // Hide the form and show the Add Task button
    form.style.display = "none";
    addButton.style.display = "block";
}
//Ajouter une tache form end