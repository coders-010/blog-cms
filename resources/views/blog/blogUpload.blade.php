<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Uploader</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">Blog CMS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('blog.index') }}">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Categories & Tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{ route('blog.profileShow') }}">Profile</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container mt-2">
        <h2 class="mb-4">Blog Uploader</h2>
        <form action="{{ route('blog.storeBlog') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Blog Title:</label>
                <input type="text" class="form-control" id="title" name="blogtitle" required>
            </div>
            <div class="form-group">
                <label for="image">Feature Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="content">Blog Content:</label>
                <textarea class="form-control" id="content" name="blogcontent" rows="9" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Upload Blog</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
