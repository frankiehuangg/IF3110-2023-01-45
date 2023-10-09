const lib = new Lib();

async function searchPosts() {
    const container = document.getElementById('post-list');
    const searchVal = document.getElementById('search-bar-input').value;

    container.innerHTML = "";

    const payload = {
        search_str : searchVal
    };

    if (searchVal !== '') {
        const res = await lib.get('/api/post/search', payload);
        const json = JSON.parse(res);
        console.log(json);
    
        if (json.success) {
            container.innerHTML = json.data;
        }
    }
}

const searchChange = lib.debounce(() => searchPosts());