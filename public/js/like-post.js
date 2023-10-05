async function like(event, userID, postID) {
    event.preventDefault();

    const lib = new Lib();

    const button = document.getElementById(`like-button-${postID}`);
    button.disabled = true;

    const payload = {
        username : userID,
        post_id : postID
    };

    console.log(postID);

    const res = await lib.post('/api/post/like', payload);
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

