window.onload = async function getPosts(event) {
    event.preventDefault();

    const lib = new Lib();

    const container = document.getElementById('post-list');

    const payload = {
        n : 25
    };

    const res = await lib.get('/api/post/read', payload);
    console.log(res);
    const json = JSON.parse(res);

    if (json.success) {
        const results = json.data;
        container.innerHTML = results;
    } else {
        console.log('waterpark');
    }
}