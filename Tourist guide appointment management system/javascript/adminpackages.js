let data = JSON.parse(localStorage.getItem("crudData")) || [];
let idCounter = data.length + 1;
let currentPage = 1;
const itemsPerPage = 5;

function displayData() {
    const tableBody = document.getElementById("dataTable").getElementsByTagName("tbody")[0];
    tableBody.innerHTML = "";

    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, data.length);

    for (let i = startIndex; i < endIndex; i++) {
        const item = data[i];
        const row = tableBody.insertRow();
        row.innerHTML = `
            <td>${i + 1}</td>
            <td><img src="${item.image}" alt="Image" style="max-width: 100px;"></td>
            <td>${item.date_created}</td>
            <td>${item.package}</td>
            <td>${item.description}</td>
            <td>
                <select id="status_${i}" onchange="updateStatus(${i}, this.value)">
                    <option value="active" ${item.status === 'active' ? 'selected' : ''}>Active</option>
                    <option value="inactive" ${item.status === 'inactive' ? 'selected' : ''}>Inactive</option>
                </select>
            </td>
            <td>
                <button type="button" onclick="edit(${i})">Edit</button>
                <button type="button" onclick="remove(${i})">Delete</button>
            </td>
        `;
    }

    updatePagination();
}

function createOrUpdate() {
    const id = document.getElementById("packageId").value;
    const imageInput = document.getElementById("image");
    const image = imageInput.files.length > 0 ? URL.createObjectURL(imageInput.files[0]) : '';
    const date_created = document.getElementById("date_created").value;
    const package = document.getElementById("package").value;
    const description = document.getElementById("description").value;
    const status = 'inactive';

    if (id) {
        const index = data.findIndex(item => item.id == id);
        if (index !== -1) {
            data[index] = { id, image, date_created, package, description, status };
        }
    } else {
        data.push({ id: idCounter++, image, date_created, package, description, status });
    }

    localStorage.setItem("crudData", JSON.stringify(data));
    displayData();
    resetForm();
    toggleForm(); // Close the form after saving
}

function edit(index) {
    const item = data[index];
    document.getElementById("packageId").value = item.id;
    document.getElementById("date_created").value = item.date_created;
    document.getElementById("package").value = item.package;
    document.getElementById("description").value = item.description;
    toggleForm();
}

function remove(index) {
    data.splice(index, 1);
    localStorage.setItem("crudData", JSON.stringify(data));
    displayData();
}

function updateStatus(index, status) {
    data[index].status = status;
    localStorage.setItem("crudData", JSON.stringify(data));
    displayData();
}

function prevPage() {
    currentPage = Math.max(currentPage - 1, 1);
    displayData();
}

function nextPage() {
    const totalPages = Math.ceil(data.length / itemsPerPage);
    currentPage = Math.min(currentPage + 1, totalPages);
    displayData();
}

function goToPage(page) {
    currentPage = page;
    displayData();
}

function createPageNumbers() {
    const pageNumbers = document.getElementById("pageNumbers");
    pageNumbers.innerHTML = ''; // Clear existing page numbers

    const totalPages = Math.ceil(data.length / itemsPerPage);
    const importantPages = [1, 10, 50];

    importantPages.forEach(page => {
        if (page <= totalPages) {
            const pageButton = document.createElement("button");
            pageButton.textContent = page;
            pageButton.onclick = function() {
                goToPage(page);
            };
            if (page === currentPage) {
                pageButton.classList.add("active");
            }
            pageNumbers.appendChild(pageButton);
        }
    });
}

function updatePagination() {
    const totalPages = Math.ceil(data.length / itemsPerPage);
    document.getElementById("pageCount").textContent = `Page ${currentPage} of ${totalPages}`;
    document.getElementById("pagination").style.visibility = totalPages > 1 ? "visible" : "hidden";
    createPageNumbers();
}

function toggleForm() {
    const form = document.getElementById("crudForm");
    const overlay = document.getElementById("overlay");
    form.style.display = form.style.display === "none" || form.style.display === "" ? "block" : "none";
    overlay.classList.toggle("show");
}

function resetForm() {
    document.getElementById("packageForm").reset();
    document.getElementById("packageId").value = '';
}

window.onload = function() {
    displayData();
}
