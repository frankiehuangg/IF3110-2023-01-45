async function submitForm(event) {
    event.preventDefault();

    const lib = new Lib();

    const button = document.getElementById('submit-button');
    button.disabled = true;

    const content = document.getElementById('input-post-content').value;

    const resourceFiles = document.getElementById('input-files').files;

    let resourceUploadResultsJSON = [];
    if (resourceFiles) {
        for (let i = 0; i < resourceFiles.length; i++) {
            const resourceUploadResult = await lib.uploadFile(resourceFiles[i], '/api/upload');
            const resourceUploadResultJSON = JSON.parse(resourceUploadResult);
            if (!resourceUploadResultJSON.success) {
                console.log('eror mas');
                return;
            } else {
                resourceUploadResultsJSON.push(resourceUploadResultJSON.data);
            }
        }
    }

    const payload = {
        post_content : content
    };

    if (resourceFiles) payload.resources = resourceUploadResultsJSON;

    const res = await lib.post('/api/post/create', payload);
    const json = JSON.parse(res);

    if (json.success) {
        alert('Post created successfully');
        window.location.reload();
    } else {
        if (json.status_code === 400) {
            alert('Please login first!');
            window.location.assign('/login');
        }
        button.disabled = false;
    }

    document.getElementById('input-post-content').value = '';
}