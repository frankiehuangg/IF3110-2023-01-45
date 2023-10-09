class Lib {
    async promiseAjax(url, payload, asXML, method) {
        return new Promise((resolve, reject) => {
            const XHR = new XMLHttpRequest();

            XHR.onload = () => {
                if (!asXML) {
                    try {
                        resolve(XHR.responseText);
                    } catch (e) {
                        reject(e);
                    }
                } else {
                    resolve(XHR.responseXML);
                }
            };

            XHR.onerror = () => {
                reject(new Error('Fetch error'));
            };

            const usedMethod = method || 'GET';
            const params = new URLSearchParams(payload).toString();

            XHR.open(
                usedMethod,
                usedMethod !== 'GET' ? url : payload ? `${url}?${params}` : url
            );

            XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            payload ? XHR.send(params) : XHR.send();
        });
    }

    async get(url, payload, asXML) {
        return await this.promiseAjax(url, payload, asXML, 'GET');
    }

    async post(url, payload, asXML) {
        return await this.promiseAjax(url, payload, asXML, 'POST');
    }

    async patch(url, payload, asXML) {
        return await this.promiseAjax(url, payload, asXML, 'PATCH');
    }

    async delete(url, asXML) {
        return await this.promiseAjax(url, null, asXML, 'DELETE');
    }

    debounce(func, timeout = 300) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                func.apply(this, args);
            }, timeout);
        }
    }

    async uploadFile(file, url, asXML) {
        return new Promise((resolve, reject) => {
            const formData = new FormData();
            formData.append('file', file);

            const XHR = new XMLHttpRequest();
            XHR.open('POST', url, true);

            XHR.onload = () => {
                if (!asXML) {
                    try {
                        resolve(XHR.responseText);
                    } catch (e) {
                        reject(e);
                    }
                } else {
                    resolve(XHR.responseXML);
                }
            };

            XHR.onerror = () => {
                reject (new Error('Fetch error'));
            };

            XHR.send(formData);
        })
    }
}