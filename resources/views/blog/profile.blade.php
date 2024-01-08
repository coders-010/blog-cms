<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Profile</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css"
        integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
        integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
</head>

<body>

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
    <div>

        <div class="container ">
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="text-center border-end">

                                        @if ($user->image)
                                            <img src="{{ asset($user->image) }}"
                                                class="img-fluid avatar-xxl rounded-circle" alt="">
                                        @else
                                            <p>No image available</p>
                                        @endif
                                        <h5 class="text-primary font-size-20 mt-3 mb-2">{{ $user->name }}</h5>

                                    </div>
                                </div><!-- end col -->
                                <div class="col-md-9">
                                    <div class="ms-3">
                                        <div>
                                            <h5 class="card-title mb-2">Biography</h5>
                                            <p class="mb-0 text-muted">Hi I'm aaaaaa,has been the industry's standard
                                                dummy text To an English person alteration text.</p>
                                        </div>
                                        <div class="row my-4">
                                            <div class="col-md-12">
                                                <div>
                                                    <p class="text-muted mb-2 fw-medium"><i
                                                            class="mdi mdi-email-outline me-2 mr-2"></i>{{ $user->email }}
                                                    </p>
                                                    <p class="text-muted fw-medium mb-0 "><i
                                                            class="mdi mdi-phone-in-talk-outline me-2 mr-2"></i>{{ $user->phone }}
                                                    </p>
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end card body -->
                    </div><!-- end card -->

                    <div class="card">
                        <div class="p-4">
                            <div class="d-flex  mb-4">
                                <h4>Blogs</h4>
                                <a class="nav-link px-4  ml-2 " href="{{ route('blog.upload') }}">

                                    <span class=" btn btn-primary">Add Blog </span>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Image</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($blogs as $blog)
                                        <tr>
                                            <td>{{ $blog->blogtitle }}</td>
                                            <td class="text-justify">
                                                {{ implode(' ', array_slice(explode(' ', $blog->blogcontent), 0, 29)) }}....
                                            </td>

                                            <td>
                                                @if ($blog->image)
                                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->blogtitle }} "
                                                        width="60px" height="40px">
                                                @else
                                                    <p>No image available</p>
                                                @endif
                                            </td>
                                            <td class="mt-2">
                                                <form action="{{route('blog.destroyBlog', $blog->id)}}" method="Post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="bi bi-trash ms-2 btn btn-danger mb-2"></button>

                                                </form>

                                                <a href="{{route('blog.editBlog', $blog->id)}}"><button type="button"
                                                        class="bi bi-pencil-square btn btn-primary ms-2"></button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination justify-content-center">
                            <li class="page-item {{ $currentPage <= 1 ? 'disabled' : '' }}">
                                <a class="page-link"
                                    href="{{ $currentPage > 1 ? route('blog.profileShow', ['page' => $currentPage - 1]) : '#' }}"
                                    aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @for ($i = 1; $i <= $totalPages; $i++)
                                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                    <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ $currentPage >= $totalPages ? 'disabled' : '' }}">
                                <a class="page-link"
                                    href="{{ $currentPage < $totalPages ? route('blog.profileShow', ['page' => $currentPage + 1]) : '#' }}"
                                    aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>


                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-4">


                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="card-title mb-4">Personal Details</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Designation</th>
                                                <td>{{ $user->designation }}</td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <th scope="row">Age</th>
                                                <td>{{ $user->age }}</td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <th scope="row">Gender</th>
                                                <td>{{ $user->gender }}</td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <th scope="row">Address</th>
                                                <td>{{ $user->address }}</td>
                                            </tr><!-- end tr -->
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                    </a>
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="card-title mb-4">Work Experince</h4>
                                <ul class="list-unstyled work-activity mb-0">
                                    <li class="work-item" data-date="2020-21">
                                        <h6 class="lh-base mb-0">ABCD Company</h6>
                                        <p class="font-size-13 mb-2">Web Designer</p>
                                        <p>To achieve this, it would be necessary to have uniform grammar, and more
                                            common words.</p>
                                    </li>
                                    <li class="work-item" data-date="2019-20">
                                        <h6 class="lh-base mb-0">XYZ Company</h6>
                                        <p class="font-size-13 mb-2">Graphic Designer</p>
                                        <p class="mb-0">It will be as simple as occidental in fact, it will be
                                            Occidental person, it will seem like simplified.</p>
                                    </li>
                                </ul><!-- end ul -->
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
