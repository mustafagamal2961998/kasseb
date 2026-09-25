//sort table
document.addEventListener('DOMContentLoaded', () => {
    // Function to handle sorting
    const sortTable = (columnIndex, newOrder) => {
        const table = document.getElementById('products-container');
        const tableBody = table.querySelector('tbody');
        const rows = Array.from(tableBody.querySelectorAll('tr'));

        // Sorting logic
        rows.sort((a, b) => {
            const aText = a.children[columnIndex].textContent.trim();
            const bText = b.children[columnIndex].textContent.trim();

            if (!isNaN(aText) && !isNaN(bText)) {
                // Numeric comparison
                return newOrder === 'asc' ? aText - bText : bText - aText;
            } else {
                // String comparison
                return newOrder === 'asc' 
                    ? aText.localeCompare(bText) 
                    : bText.localeCompare(aText);
            }
        });

        // Append sorted rows back to the table body
        tableBody.innerHTML = ''; // Clear the existing rows
        rows.forEach(row => tableBody.appendChild(row)); // Append sorted rows
    };

    // Function to attach sort event listeners to the table headers
    const attachSortListeners = () => {
        const table = document.getElementById('products-container');
        table.querySelectorAll('th').forEach(header => {
            header.addEventListener('click', () => {
                const columnIndex = header.getAttribute('data-column');
                const currentOrder = header.getAttribute('data-order');
                const newOrder = currentOrder === 'asc' ? 'desc' : 'asc';

                // Update the sort order in the header
                header.setAttribute('data-order', newOrder);

                // Call sort function
                sortTable(columnIndex, newOrder);
            });
        });
    };

    // Attach sorting listeners initially
    attachSortListeners();

    // Reattach the sorting listeners after the table is updated via AJAX
    document.addEventListener('ajaxUpdate', () => {
        attachSortListeners(); // Reapply sorting functionality to new table rows
    });
});



function change_image(image) {
    var container = document.getElementById("main-image");

    container.src = image.src;
}

document.addEventListener("DOMContentLoaded", function (event) {});


// tinymce.init({
//     selector: 'textarea',
//     language: lang,         // Set the language code here
//     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
//     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
// });


function activeInput(active,...hide){
    activeSelector = document.querySelector('.'+active);
    activeSelector.style.display='block';
    hide.forEach(function(element) {
        document.querySelector('.'+element).style.display='none';
    });  
}

