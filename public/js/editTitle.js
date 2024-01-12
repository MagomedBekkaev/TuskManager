//Changer le titre d'une categorie form 
function toggleCategoryTitleForm(index, title) {
    var titleElement = document.getElementById('title-' + index);
    var formElement = document.getElementById('edit-form-' + index);
    var textareaElement = document.getElementById('textarea-' + index);

    console.log("Toggling category form for ID:", index); // Debugging line

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


function cancelCategorieEdit(index) {
    var titleElement = document.getElementById('title-' + index);
    var formElement = document.getElementById('edit-form-' + index);

    if (titleElement && formElement) {
        // Hide the form and show the title
        titleElement.style.display = 'block';
        formElement.style.display = 'none';
    }
}

//Changer le titre d'une categorie form end

//Changer le titre d'une tache form 
function toggleTaskForm(uniqueId) {
    var titleElement = document.getElementById('title-' + uniqueId);
    var descriptionElement = document.getElementById('description-' + uniqueId);
    var formElement = document.getElementById('edit-task-form-' + uniqueId);
    var titleTextareaElement = document.getElementById('textarea-title-' + uniqueId);
    var descriptionTextareaElement = document.getElementById('textarea-description-' + uniqueId);

    console.log("Toggling task form for ID:", uniqueId); // Debugging line

    if (titleElement && descriptionElement && formElement && titleTextareaElement && descriptionTextareaElement) {
        // Toggle visibility
        if (formElement.style.display === 'none') {
            titleElement.style.display = 'none'; // Hide the title
            descriptionElement.style.display = 'none'; // Hide the description
            formElement.style.display = 'block'; // Show the form
            titleTextareaElement.value = titleElement.innerText; // Set the task title in the textarea
            descriptionTextareaElement.value = descriptionElement.innerText; // Set the task description in the textarea
        } else {
            titleElement.style.display = 'block'; // Show the title
            descriptionElement.style.display = 'block'; // Show the description
            formElement.style.display = 'none'; // Hide the form
        }
    }
}

function cancelEdit(uniqueId) {
    var titleElement = document.getElementById('title-' + uniqueId);
    var formElement = document.getElementById('edit-task-form-' + uniqueId);
    var descriptionElement = document.getElementById('description-' + uniqueId);

    if (titleElement && formElement && descriptionElement) {
        titleElement.style.display = 'block'; // Show the title
        descriptionElement.style.display = 'block'; // Show the description
        formElement.style.display = 'none'; // Hide the form
    }
}



//Changer le titre d'une tache form end

//Ajouter une tache form
function toggleForm(formId) {
    var form = document.getElementById(formId);
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

// Cancel the form and hide it
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



// Show or Hide the Create Category Form
function toggleCreateCategoryForm() {
    var form = document.getElementById('category-form');
    var createButton = document.getElementById('create-category-button');

    if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block'; // Show the form
        createButton.style.display = 'none'; // Hide the create button
    } else {
        form.style.display = 'none'; // Hide the form
        createButton.style.display = 'block'; // Show the create button
    }
}

// Cancel and Hide the Create Category Form
function cancelCreateCategory() {
    var form = document.getElementById('category-form');
    var createButton = document.getElementById('create-category-button');

    form.style.display = 'none'; // Hide the form
    createButton.style.display = 'block'; // Show the create button
}
