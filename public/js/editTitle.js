// Utility function to toggle display
function toggleDisplay(elementId, displayStyle) {
    const element = document.getElementById(elementId);
    if (element) {
        element.style.display = displayStyle;
    }
}

// Toggle Category Title Form
function toggleCategoryTitleForm(index, title) {
    console.log("Toggling category form for ID:", index); // Debugging line
    const isFormVisible = document.getElementById(`edit-form-${index}`).style.display !== 'none';

    toggleDisplay(`title-${index}`, isFormVisible ? 'block' : 'none');
    toggleDisplay(`edit-form-${index}`, isFormVisible ? 'none' : 'block');

    if (!isFormVisible) {
        document.getElementById(`textarea-${index}`).value = title;
    }
}

// Cancel Category Edit
function cancelCategorieEdit(index) {
    toggleDisplay(`title-${index}`, 'block');
    toggleDisplay(`edit-form-${index}`, 'none');
}

// Toggle Task Form
function toggleTaskForm(uniqueId) {
    console.log("Toggling task form for ID:", uniqueId); // Debugging line
    const isFormVisible = document.getElementById(`edit-task-form-${uniqueId}`).style.display !== 'none';

    toggleDisplay(`title-${uniqueId}`, isFormVisible ? 'block' : 'none');
    toggleDisplay(`description-${uniqueId}`, isFormVisible ? 'block' : 'none');
    toggleDisplay(`edit-task-form-${uniqueId}`, isFormVisible ? 'none' : 'block');

    if (!isFormVisible) {
        document.getElementById(`textarea-title-${uniqueId}`).value = document.getElementById(`title-${uniqueId}`).innerText;
        document.getElementById(`textarea-description-${uniqueId}`).value = document.getElementById(`description-${uniqueId}`).innerText;
    }
}

// Cancel Task Edit
function cancelEdit(uniqueId) {
    toggleDisplay(`title-${uniqueId}`, 'block');
    toggleDisplay(`description-${uniqueId}`, 'block');
    toggleDisplay(`edit-task-form-${uniqueId}`, 'none');
}

// Toggle Generic Form
function toggleForm(formId) {
    const form = document.getElementById(formId);
    const isFormVisible = form.style.display !== 'none';
    toggleDisplay(formId, isFormVisible ? 'none' : 'block');
}

// Cancel Generic Form
function cancelForm(formId) {
    const form = document.getElementById(formId);
    const addButtonId = 'add-btn-' + formId.split('-')[1];
    form.reset();
    toggleDisplay(formId, 'none');
    toggleDisplay(addButtonId, 'block');
}

// Toggle Create Category Form
function toggleCreateCategoryForm() {
    const isFormVisible = document.getElementById('category-form').style.display !== 'none';
    toggleDisplay('category-form', isFormVisible ? 'none' : 'block');
    toggleDisplay('create-category-button', isFormVisible ? 'block' : 'none');
}

// Cancel Create Category Form
function cancelCreateCategory() {
    toggleDisplay('category-form', 'none');
    toggleDisplay('create-category-button', 'block');
}
