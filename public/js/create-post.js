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
    console.log(res);
    const json = JSON.parse(res);

    if (json.success) {
        console.log('berhasil');
        window.location.reload();
    } else {
        console.log(':(');
        button.disabled = false;
    }
}