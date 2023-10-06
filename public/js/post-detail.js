window.onload = async function getPosts(event) {
    event.preventDefault();

    const lib = new Lib();

    const container = document.getElementById('post-list');

    let post_id = window.location.href.split('/');
    post_id = post_id[post_id.length - 1];

    const payload = {
        post_id : post_id
    };

    const res = await lib.get('/api/post/' + post_id, payload);
    console.log(res);
    const json = JSON.parse(res);

    if (json.success) {
        const result = json.data;

        const post_id               = result[0].post_id;
        const profile_picture_path  = result[1].profile_picture_path;
        const display_name          = document.createTextNode(result[1].display_name ? result[1].display_name : result[1].username);
        const username              = document.createTextNode('@' + result[1].username);
        const post_timestamp        = document.createTextNode(result[0].post_timestamp);
        const post_content          = document.createTextNode(result[0].post_content);
        const replies               = document.createTextNode(result[0].replies);
        const shares                = document.createTextNode(result[0].shares);
        const likes                 = document.createTextNode(result[0].likes);

        // <a><div /></a> tag
        const outer_node = document.createElement('a');
        outer_node.href = `/post/${post_id}`;
        outer_node.classList.add('node', 'post-card');
        
        const inner_node = document.createElement('div');

        // <div><img /></div> tag
        const profile_picture_node = document.createElement('div');
        profile_picture_node.classList.add('node', 'profile_picture_node');
        const profile_picture_img_node = document.createElement('img');
        profile_picture_img_node.src = profile_picture_path;
        profile_picture_img_node.classList.add('profile_picture_img_node');
        profile_picture_node.appendChild(profile_picture_img_node);

        // right <div> tag
        const content_node = document.createElement('div');
        content_node.classList.add('node', 'content_node');

        // top right <div> tag
        const top_content_node = document.createElement('div');
        top_content_node.classList.add('top_content_node');

        const top_content_node_display_name = document.createElement('div');
        const top_content_node_username = document.createElement('div');
        const top_content_node_post_timestamp = document.createElement('div');

        top_content_node_display_name.classList.add('node', 'top_content_node_display_name');
        top_content_node_username.classList.add('node', 'top_content_node_username');
        top_content_node_post_timestamp.classList.add('node', 'top_content_node_post_timestamp');

        top_content_node_display_name.appendChild(display_name);
        top_content_node_username.appendChild(username);
        top_content_node_post_timestamp.appendChild(post_timestamp);

        top_content_node.appendChild(top_content_node_display_name);
        top_content_node.appendChild(top_content_node_username);
        top_content_node.appendChild(top_content_node_post_timestamp);

        content_node.appendChild(top_content_node);

        // middle <div> tag
        const middle_content_node = document.createElement('div');
        
        middle_content_node.classList.add('node', 'middle_content_node');
        
        middle_content_node.appendChild(post_content);

        content_node.appendChild(middle_content_node);

        // bottom <div> tag
        const bottom_content_node = document.createElement('div');
        bottom_content_node.classList.add('bottom_content_node');

        const bottom_content_node_replies = document.createElement('div');
        const bottom_content_node_shares = document.createElement('div');
        const bottom_content_node_likes = document.createElement('div');
        
        bottom_content_node_replies.classList.add('node', 'bottom_content_node_replies');
        bottom_content_node_shares.classList.add('node', 'bottom_content_node_shares');
        bottom_content_node_likes.classList.add('node', 'bottom_content_node_likes');

        bottom_content_node_replies.appendChild(replies);
        bottom_content_node_shares.appendChild(shares);
        bottom_content_node_likes.appendChild(likes);

        bottom_content_node.appendChild(bottom_content_node_replies);
        bottom_content_node.appendChild(bottom_content_node_shares);
        bottom_content_node.appendChild(bottom_content_node_likes);

        content_node.appendChild(bottom_content_node);

        inner_node.appendChild(profile_picture_node);
        inner_node.appendChild(content_node);

        outer_node.appendChild(inner_node);
        container.appendChild(outer_node);
    } else {
        console.log('waterpark');
    }
}