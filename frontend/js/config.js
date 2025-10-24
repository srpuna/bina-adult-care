const config = {
    // API configuration
    api: {
        baseUrl: process.env.API_BASE_URL || 'http://localhost:8000/api',
        endpoints: {
            services: '/services',
            content: '/content',
            contact: '/contact'
        }
    },
    
    // Authentication
    auth: {
        tokenKey: 'adminToken',
        loginPath: '/admin/login.html',
        dashboardPath: '/admin/dashboard.html'
    },
    
    // File upload configuration
    upload: {
        maxFileSize: 5 * 1024 * 1024, // 5MB
        allowedTypes: ['image/jpeg', 'image/png', 'image/webp']
    }
};

// Freeze the configuration to prevent modifications
Object.freeze(config);
export default config;