<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial=scale=1.0">
        <title>Create A Post</title>
    </head>
    <body>
    <div class="form-container">
          <form onsubmit="submitForm(event)">
            <div class="form-section">
              <label for="post-content">Description</label> <br>
              <input type="text" name="post-content" placeholder="Type the post content" id="input-post-content" required>
            </div>

            <div class="form-section">
              <label>Pictures (optional)</label> <br>
              <input type="file" name="file-resource" id="input-files" accept="image/*" multiple>
            </div>

            <div class="form-section-submit">
              <input type="submit" value="Post" id="submit-button">
            </div>
          </form>
        </div>

        <script defer async src="/public/js/lib.js"></script>
        <script defer async src="/public/js/create-post.js"></script>
    </body>
</html>