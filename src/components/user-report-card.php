<?php 

function userReports($response_get) {
    $report_id = $response_get->report_id;
    $user_id = $response_get->user_id;
    $reporter = $response_get->reporter;
    $description = $response_get->description;
    $status = $response_get->status;

    $html = <<<"EOT"
            <div class="report-card">
                <header>
                    <div class="reported">
                        <h3>reported</h2>
                        <h4>$user_id</h2>
                    </div>
                    <div class="reporter">
                        <h3>reporter</h2>
                        <h4>$reporter</h2>
                    </div>
                    <div class="status">
                        <h3>Status</h2>
                        <h4>$status</h2>
                    </div>
                    <button type="button" class="change-status" onclick="updateStatus($report_id, 1)">Accept</button>
                    <button type="button" class="change-status" onclick="updateStatus($report_id, 2)">Reject</button>
                </header>
                <div class="description">
                    <p>Description: </p>
                    <p>$description</p>
                </div>
            </div>
            EOT;

    return $html;
}

?>