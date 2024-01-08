<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Blog</title>
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
        <form action="{{ route('blog.updateBlog', ['id' => $blogs->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Blog Title:</label>
                <input type="text" class="form-control"  value="{{ !empty($blogs) ? $blogs->blogtitle : '' }}" name="blogtitle" required>
            </div>
            <div class="form-group">
                <label for="image">Feature Image:</label>
                <input type="file" class="form-control-file"   name="image" accept="image/*"><img src="{{ asset($blogs->image) }}" height="50px" width="70px" alt="">
            </div>
            <div class="form-group">
                <label for="content">Blog Content:</label>
                <textarea class="form-control"  name="blogcontent" rows="7" required>{{ !empty($blogs) ? $blogs->blogcontent : '' }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Upddate Blog</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
