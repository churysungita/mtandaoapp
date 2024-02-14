<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
@include('admin.css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.navbar')

        <div class="container">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> About Us </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Welcome page</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About us</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-2" role="alert" style="max-width: 400px;">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif



                        <div class="container">
                            <h2>Office Contacts</h2>
                            <a class="btn btn-primary" href="{{ route('admin.office_contacts.create') }}">Add Office Contact</a>


                            @if($officeContacts->isEmpty())
                            <!-- Display the create form if no office contacts exist -->
                            <form action="{{ route('admin.office_contacts.create') }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary">Create Office Contact</button>
                            </form>
                            @else
                            <!-- Display the office contacts table if contacts exist -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Address</th>
                                        <th>Location</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($officeContacts as $officeContact)
                                    <tr>
                                        <td>{{ $officeContact->address }}</td>
                                        <td>{{ $officeContact->location }}</td>
                                        <td>{{ $officeContact->email }}</td>
                                        <td>{{ $officeContact->phone }}</td>
                                        <td>
                                            <a href="{{ route('admin.office_contacts.show', $officeContact) }}" class="btn btn-info">View</a>
                                            <a href="{{ route('admin.office_contacts.edit', $officeContact) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('admin.office_contacts.destroy', $officeContact) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this office contact?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>


                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer"></footer>
                <!-- partial -->
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
    </div>
</body>
</html>
