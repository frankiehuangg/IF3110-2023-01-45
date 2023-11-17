window.onload = async function getReports(event) {
    event.preventDefault();

    const lib = new Lib();
    
    const container = document.getElementById('report-list');
    
    let page = window.location.href.split('/');
    page = page[page.length - 1];
    
    const payload = {
        page : page
    };

    const res = await lib.get('/api/user_report/read', payload);
    console.log(res);
    const json = JSON.parse(res);

    if (json.success) {
        const results = json.data;
        container.innerHTML = results;
    } else {
        if (json.status_code === 400) {
            window.location.assign('/');
        }
    }
}

const updateStatus = async (report_id, type) => {
    const lib = new Lib();

    const data = {
        report_id : report_id,
        status : type === 1 ? 'accepted' : 'rejected'
    }

    const res = await lib.patch('/api/user_report/update', data);
    const json = JSON.parse(res);

    if (json.success) {
        window.location.reload();
    } else {
        console.log("failed to update");
    }
}

const redirect = (type) => {
    let page = window.location.href.split('/');
    page = page[page.length - 1];

    if (type == 0 && page != 0) {
        page = parseInt(page) - 1
    } else if (type == 1) {
        page = parseInt(page) + 1;
    }
    window.location.assign('/report-list/' + page);
}