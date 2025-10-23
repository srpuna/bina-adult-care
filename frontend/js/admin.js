// Admin panel JavaScript
const API_BASE_URL = 'http://localhost:8000/api';

// Function to load services into the admin panel
async function loadServices() {
    try {
        const response = await fetch(`${API_BASE_URL}/services`);
        const services = await response.json();
        displayServicesInAdmin(services);
    } catch (error) {
        console.error('Error loading services:', error);
        showNotification('Error loading services', 'error');
    }
}

// Function to display services in the admin panel
function displayServicesInAdmin(services) {
    const container = document.getElementById('services-list');
    if (!container) return;

    const servicesHTML = services.map(service => `
        <div class="service-item card mb-3" data-id="${service.id}">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">${service.title}</h5>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-primary edit-service" onclick="editService(${service.id})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-danger delete-service" onclick="deleteService(${service.id})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
                <p class="card-text">${service.description}</p>
                ${service.image_url ? `<img src="${service.image_url}" class="img-thumbnail mt-2" style="max-width: 200px;">` : ''}
            </div>
        </div>
    `).join('');

    container.innerHTML = servicesHTML;
}

// Function to create a new service
async function createService(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    try {
        const response = await fetch(`${API_BASE_URL}/services`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(Object.fromEntries(formData)),
        });

        if (response.ok) {
            showNotification('Service created successfully', 'success');
            form.reset();
            loadServices(); // Reload the services list
        } else {
            throw new Error('Failed to create service');
        }
    } catch (error) {
        console.error('Error creating service:', error);
        showNotification('Error creating service', 'error');
    }
}

// Function to edit a service
async function editService(id) {
    try {
        const response = await fetch(`${API_BASE_URL}/services/${id}`);
        const service = await response.json();
        
        // Populate the edit form
        const form = document.getElementById('edit-service-form');
        form.elements['title'].value = service.title;
        form.elements['description'].value = service.description;
        form.elements['image_url'].value = service.image_url || '';
        form.dataset.serviceId = id;

        // Show the edit modal
        $('#editServiceModal').modal('show');
    } catch (error) {
        console.error('Error loading service details:', error);
        showNotification('Error loading service details', 'error');
    }
}

// Function to update a service
async function updateService(event) {
    event.preventDefault();
    const form = event.target;
    const id = form.dataset.serviceId;
    const formData = new FormData(form);

    try {
        const response = await fetch(`${API_BASE_URL}/services/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(Object.fromEntries(formData)),
        });

        if (response.ok) {
            showNotification('Service updated successfully', 'success');
            $('#editServiceModal').modal('hide');
            loadServices(); // Reload the services list
        } else {
            throw new Error('Failed to update service');
        }
    } catch (error) {
        console.error('Error updating service:', error);
        showNotification('Error updating service', 'error');
    }
}

// Function to delete a service
async function deleteService(id) {
    if (!confirm('Are you sure you want to delete this service?')) return;

    try {
        const response = await fetch(`${API_BASE_URL}/services/${id}`, {
            method: 'DELETE',
        });

        if (response.ok) {
            showNotification('Service deleted successfully', 'success');
            loadServices(); // Reload the services list
        } else {
            throw new Error('Failed to delete service');
        }
    } catch (error) {
        console.error('Error deleting service:', error);
        showNotification('Error deleting service', 'error');
    }
}

// Function to show notifications
function showNotification(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    document.body.appendChild(alertDiv);

    // Remove the alert after 5 seconds
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}

// Initialize admin dashboard
document.addEventListener('DOMContentLoaded', () => {
    // Load services when the page loads
    loadServices();

    // Set up form event listeners
    const createForm = document.getElementById('create-service-form');
    if (createForm) {
        createForm.addEventListener('submit', createService);
    }

    const editForm = document.getElementById('edit-service-form');
    if (editForm) {
        editForm.addEventListener('submit', updateService);
    }
});