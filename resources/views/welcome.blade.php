<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Laravel CRUD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-sm bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li>
                        <a class="navbar-brand text-light" href="/"> <b>Blogs</b></a>
                    </li>
                </ul>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                    <a class="text-light" href="{{ route('user.login') }}">Login</a>
                </button>
        </nav>
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
                </tr>
            </thead>
            <tbody class="table-group-divider mt-4">
                @foreach ($blogs as $blog)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td><a href="blogs/{{ $blog->id }}/show" class="text-dark">{{ $blog->name }}</a></td>
                        <td><img src="blogs/{{ $blog->image }}"class="rounded-circle" width="40" height="40">
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {{ $blogs->links() }}
    </body>

</html>
