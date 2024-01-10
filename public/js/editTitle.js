// document.addEventListener('DOMContentLoaded', function () {
//     // Attach a click event listener to the document
//     document.addEventListener('click', function (event) {
//         // Check if the clicked element or its parent has the "editable-title" class
//         const editableTitleElement = event.target.closest('.editable-title');
//         if (editableTitleElement) {
//             // Get the current title text
//             const currentTitle = editableTitleElement.innerText;

//             // Create an input field
//             const inputField = document.createElement('input');
//             inputField.type = 'text';
//             inputField.value = currentTitle;

//             // Replace the title with the input field
//             editableTitleElement.innerHTML = '';
//             editableTitleElement.appendChild(inputField);

//             // Focus on the input field
//             inputField.focus();

//             // Add an event listener to handle the input field blur (when user clicks outside)
//             inputField.addEventListener('blur', function () {
//                 // Get the new title
//                 const newTitle = inputField.value;

//                 // Restore the title element with the new title
//                 editableTitleElement.innerText = newTitle;

//                 // Send an asynchronous request to update the title on the server
//                 const categoryId = editableTitleElement.dataset.categoryId; // Assuming you have a data attribute for category id
//                 const taskId = editableTitleElement.dataset.taskId; // Assuming you have a data attribute for task id
//                 updateTitleOnServer(categoryId, taskId, newTitle);
//             });
//         }
//     });

//     function updateTitleOnServer(categoryId, taskId, newTitle) {
//         // Perform an asynchronous request to update the title on the server
//         // You can use Fetch API or other libraries like Axios for this purpose
//         // Example using Fetch API:
//         fetch(`/edit/${categoryId}`, {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//             },
//             body: JSON.stringify({
//                 taskId: taskId,
//                 newTitle: newTitle,
//             }),
//         })
//             .then(response => response.json())
//             .then(data => {
//                 // Handle the response if needed
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//             });
//     }
// });


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

