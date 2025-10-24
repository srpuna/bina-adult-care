import config from './config.js';

class ApiService {
    constructor() {
        this.baseUrl = config.api.baseUrl;
    }

    // Get authorization header
    #getHeaders() {
        const token = localStorage.getItem(config.auth.tokenKey);
        return {
            'Content-Type': 'application/json',
            'Authorization': token ? `Bearer ${token}` : ''
        };
    }

    // Handle API responses and errors
    async #handleResponse(response) {
        if (!response.ok) {
            const error = await response.json().catch(() => ({
                message: 'An unknown error occurred'
            }));
            throw new Error(error.message || `HTTP error! status: ${response.status}`);
        }
        return response.json();
    }

    // Generic request method
    async #request(endpoint, options = {}) {
        try {
            const url = `${this.baseUrl}${endpoint}`;
            const response = await fetch(url, {
                ...options,
                headers: this.#getHeaders()
            });
            return await this.#handleResponse(response);
        } catch (error) {
            console.error('API request failed:', error);
            throw error;
        }
    }

    // CRUD operations for services
    async getServices() {
        return this.#request(config.api.endpoints.services);
    }

    async createService(data) {
        return this.#request(config.api.endpoints.services, {
            method: 'POST',
            body: JSON.stringify(data)
        });
    }

    async updateService(id, data) {
        return this.#request(`${config.api.endpoints.services}/${id}`, {
            method: 'PUT',
            body: JSON.stringify(data)
        });
    }

    async deleteService(id) {
        return this.#request(`${config.api.endpoints.services}/${id}`, {
            method: 'DELETE'
        });
    }

    // Content management
    async getContent(section) {
        return this.#request(`${config.api.endpoints.content}/${section}`);
    }

    async updateContent(section, data) {
        return this.#request(`${config.api.endpoints.content}/${section}`, {
            method: 'PUT',
            body: JSON.stringify(data)
        });
    }

    // Contact information
    async getContactInfo() {
        return this.#request(config.api.endpoints.contact);
    }

    async updateContactInfo(data) {
        return this.#request(config.api.endpoints.contact, {
            method: 'PUT',
            body: JSON.stringify(data)
        });
    }

    // File upload
    async uploadFile(file) {
        if (!config.upload.allowedTypes.includes(file.type)) {
            throw new Error('File type not supported');
        }
        if (file.size > config.upload.maxFileSize) {
            throw new Error('File size exceeds limit');
        }

        const formData = new FormData();
        formData.append('file', file);

        return this.#request('/upload', {
            method: 'POST',
            headers: {
                'Authorization': this.#getHeaders().Authorization
            },
            body: formData
        });
    }
}

// Create a singleton instance
const apiService = new ApiService();
export default apiService;