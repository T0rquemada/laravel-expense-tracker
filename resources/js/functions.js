// Make request and return response from server
async function request(method, route, csrfToken, body= null) {
    if (!method) throw new Error('Method for request not provided!');
    if (!route) throw new Error('Route for request not provided!');
    if (!csrfToken) throw new Error('csrf token for request not provided!');
    if (method !== 'GET' && body === null) throw new Error('Body for request not provided!');
    
    try {
        let options = {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
        }

        if (method !== 'GET') options.body = JSON.stringify(body); // Add body to init object

        let response = await fetch(route, options);
        
        return await response.json();
    } catch (err) {
        console.error('Request failed:', err);
        throw err;
    }
}

export { request };
