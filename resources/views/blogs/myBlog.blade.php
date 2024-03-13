<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Dash Board | Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
        </script>
    </head>

    <body>
        <nav class="navbar navbar-expand-sm bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li>
                        <a class="navbar-brand text-light" href="/user/dashboard/user/home"> <b>Blogs</b></a>
                    </li>
                </ul>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::guard('web')->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><button class="dropdown-item" type="button"><a href="{{ route('user.logout') }}"
                                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
                                <form action="{{ route('user.logout') }}" method="POST" class="d-none"
                                    id="logout-form">@csrf</form>
                            </button></li>
                    </ul>
                </div>
        </nav>
        <br>
        <div class="mx-2">
            <a href="{{ route('blogs.create') }}" class="btn btn-dark mt-2">New Blogs</a>
        </div>
        <br>
        @if (Session::has('Success'))
            <script>
                swal("Message", "{{ Session::get('Success') }}", 'success', {
                    button: true,
                    button: "Ok",
                    timer: 3000
                });
            </script>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                    <th scope="col">View Option</th>
                </tr>
            </thead>
            <tbody class="table-group-divider mt-4">
                @foreach ($blogs as $blog)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td><b>{{ $blog->name }} </b></td>
                        <td><img src="/blogs/{{ $blog->image }}"class="rounded-circle" width="40" height="40">
                        </td>
                        <td><a href="/blogs/{{ $blog->id }}/edit" class="btn btn-dark btn-sm">Edit</a> </td>
                        <td>
                            {{-- <a href="products/{{ $product->id }}/delete" class="btn btn-danger btn-sm">Delete</a> --}}
                            <form action="/blogs/{{ $blog->id }}/delete" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                        </td>
                        <td><a href="/blogs/{{ $blog->id }}/show" class="text-dark"><button
                                    class="btn btn-outline-info">View</button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $blogs->links() }} --}}
    </body>

</html>
