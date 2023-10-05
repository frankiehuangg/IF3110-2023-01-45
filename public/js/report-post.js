async function reportPost(event, postId, reporter, description) {
    event.preventDefault();

    const lib = new Lib();

    const button = document.getElementById(`report-button-${postId}`);
    button.disabled = true;

    const payload = {
        post_id : postId,
        reporter : reporter,
        description : description
    };

    const res = await lib.post('/api/report/post', payload);
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

async function createReport(event, postId, reporter) {
    let description = prompt("Please enter your report description", "Report Description");

    if(description == null || description == "") {
        alert("Report cancelled");
        return;
    }
    else {
        reportPost(event, postId, reporter, description);
    }

}