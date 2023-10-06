window.onload = async function getPosts(event) {
    event.preventDefault();

    const lib = new Lib();

    const container = document.getElementById('user-list');

    let post_id = window.location.href.split('/');
    post_id = post_id[post_id.length - 1];

    const payload = {
        post_id : post_id
    };

    const res = await lib.get('/api/user/read/' + post_id, payload);
    const json = JSON.parse(res);

    if (json.success) {
        const result = json.data;
        container.innerHTML = result;
    } else {
        console.log('waterpark');
    }
}