/**
 * @param {string} url 
 * @param {string} [token=''] token
 * @returns {Promise<Object>}
 */
async function fetchGet(url, token = '') {
    try {
        let response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization': `Bearer ${token}`
            },
            method: 'GET'
        });

        return response = await response.json();
    } catch (err) {
        console.log(err);
        throw new Error(err);
    }
}

/**
 * @param {string} url 
 * @param {FormData|Object} data 
 * @param {string} [token=''] token
 * @returns {Promise<Object>}
 */
async function fetchPost(url, data, token = '') {
    try {
        let response;
        let headers = {
            'X-Requested-With': 'XMLHttpRequest',
            'Authorization': `Bearer ${token}`
        }
        if (data instanceof FormData) {
            body = data
        } else {
            body = JSON.stringify(data);
        }
        response = await fetch(url, {
            headers: headers,
            method: 'post',
            body: body
        });

        return response = await response.json();
    } catch (err) {
        throw new Error(err);
    }
}

/**
 * @param {string} url 
 * @param {string} [token=''] token
 * @returns {Promise<Object>}
 */
async function fetchDelete(url, token = '') {
    try {
        let response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization': `Bearer ${token}`
            },
            method: 'DELETE'
        });

        return response = await response.json();
    } catch (err) {
        throw new Error(err);
    }
}

/**
 * @returns {void}
 */
function isConnected() {
    let token = localStorage.getItem("token");
    if (!(token === null || token === "")) window.location.href = "/";
}

/**
 * @returns {void}
 */
function isNotConnected() {
    let token = localStorage.getItem("token");
    if (token === null || token === "") window.location.href = "/";
}

/**
 * @returns {File} file
 * @returns {Promise<string>}
 */
function readFile(file) {
    return new Promise((resolve, err) => {
        let reader = new FileReader();
        reader.onload = (e) => {
            resolve(e.target.result);
        };
        reader.readAsDataURL(file);
    });
}

function debounce(func, second) {
    let timer;
    return () => {
        clearTimeout(timer);
        timer = setTimeout(() => { func(); }, second * 1000);
    }
}

function wait(seconds) {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve(1);
        }, seconds * 1000);
    });
}