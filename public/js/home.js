window.onload = async function getPosts(event) {
    event.preventDefault();

    const lib = new Lib();

    const container = document.getElementById('post-list');

    const payload = {
        n : 25
    };

    const res = await lib.get('/api/post/get', payload);
    const json = JSON.parse(res);

    if (json.success) {
        const posts = json.data;

        for (let i = 0; i < posts.length; i++) {
            const post = posts[i];
            
            const post_id           = post.post_id;
            const post_content      = post.post_content;
            const post_timestamp    = post.post_timestamp;
            const post_likes        = post.likes;
            const post_replies      = post.replies;
            const post_shares       = post.shares;

            const outer_node = document.createElement('a');
            outer_node.href = `/post/${post_id}`;
            outer_node.classList.add('post-card', 'position-relative');
            
            const inner_node = document.createElement('div');
            inner_node.appendChild(document.createTextNode(`${post_timestamp}`));
            inner_node.appendChild(document.createTextNode(`${post_content}`));
            inner_node.appendChild(document.createTextNode(`${post_replies}`));
            inner_node.appendChild(document.createTextNode(`${post_shares}`));
            inner_node.appendChild(document.createTextNode(`${post_likes}`));

            outer_node.appendChild(inner_node);
            container.appendChild(outer_node);
        }
    } else {
        console.log('waterpark');
    }
}