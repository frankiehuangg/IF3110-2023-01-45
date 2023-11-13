async function like(event, userID, postID) {
    event.preventDefault();

    const lib = new Lib();

    const payload = {
        username : userID,
        post_id : postID
    };

    const res = await lib.post('/api/post/like', payload);
    const json = JSON.parse(res);

    if (json.success) {
        console.log('berhasil');
        window.location.reload();
    } else {
        console.log(':(');
        button.disabled = false;
    }
}