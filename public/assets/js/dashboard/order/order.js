

//sort table
document.addEventListener('DOMContentLoaded', () => {
    // Function to handle sorting
    const sortTable = (columnIndex, newOrder) => {
        const table = document.getElementById('orders-container');
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
        const table = document.getElementById('orders-container');
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



function printPage() {
    // Hide elements you don't want to print
    document.querySelectorAll('.product-image').forEach(element => {
        element.style.display = 'none';
    });

    // IDs of divs you want to print
    const divIds = ['order_info','table'];

    // Create a new print window
    const printWindow = window.open('',  'width=800,height=600');

    // Start HTML for the print window with centering and full-width styles
    printWindow.document.write(`
        <html>
        <head>
            <title>Print Preview</title>
            <style>
                /* Make the content full-width and centered */
                body, html {
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    width: 100%;
                    height: 100%;
                    text-align: center;
                }
                .order-info-container{
                    width: 100%;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    direction: rtl;
                }
                .order-info-container .order-qr-code-content img{
                    width: 150px;
                    height: 150px;
                    object-fit: cover;
                }
                .print-content {
                    width: 100%;
                    max-width: 100%;
                    text-align: center;
                }
                /* Optional: Additional styling for table and text */
                table {
                    width: 100%;
                    border-collapse: collapse;
                    text-align: center;
                    direction: rtl;
                }
                table, th, td {
                    border: 1px solid black;
                    padding: 8px;
                    
                }
                span{
                    display:none;
                }
                ul{
                    text-align: right;
                    padding: 0 20px;
                    direction: rtl;
                    list-style: none;
                    font-weight: 600;
                }    
          
                </style>
        </head>
        <body>
            <div class="print-content">
            
    `);

    // Loop through div IDs and add their content to the print window
    divIds.forEach(id => {
        const content = document.getElementById(id).innerHTML;
        printWindow.document.write(content);
    });

    // Close the HTML and apply styles for print view
    printWindow.document.write(`
            </div>
            
        </body>
        </html>
    `);

    // Finish and print
    printWindow.document.close(); // necessary for some browsers
    // printWindow.print();
}

