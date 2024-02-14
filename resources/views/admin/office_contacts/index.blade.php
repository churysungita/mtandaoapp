<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Custom CSS for beautifying the modal */

    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
      

        <div class="container">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Office Contacts</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Welcome page</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Office contacts</li>
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

                        <div class="col-lg-12 stretch-card">
                            <div class="container">



                                @if($officeContacts->isEmpty())
                                <!-- Display the create form if no office contacts exist -->


                                <div class="container">
                                    <h2>{{ isset($officeContact) ? 'Edit Office Contact' : 'Add Office Contact' }}</h2>

                                    @if(isset($officeContact))
                                    <form action="{{ route('admin.office_contacts.update', $officeContact) }}" method="POST">
                                        @method('PUT')
                                        @else
                                        <form action="{{ route('admin.office_contacts.store') }}" method="POST">
                                            @endif

                                            @csrf

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', isset($officeContact) ? $officeContact->address : '') }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="location">Location</label>
                                                <input type="text" name="location" id="location" class="form-control" value="{{ old('location', isset($officeContact) ? $officeContact->location : '') }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', isset($officeContact) ? $officeContact->email : '') }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', isset($officeContact) ? $officeContact->phone : '') }}">
                                            </div>

                                            <button type="submit" class="btn btn-primary">{{ isset($officeContact) ? 'Update' : 'Create' }} Office Contact</button>
                                        </form>
                                </div>


                                @else
                                <!-- Display the office contacts table if contacts exist -->
                                <div class="table-responsive"> 
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

                                                <!-- Button to trigger the edit modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{ $officeContact->id }}">
                                                    Edit
                                                </button>
                                                <form action="{{ route('admin.office_contacts.destroy', $officeContact) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this office contact?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal for each contact -->
                                        <div class="modal fade" id="editModal{{ $officeContact->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Office Contact</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('admin.office_contacts.update', $officeContact) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <!-- Form fields for editing contact details -->
                                                            <div class="form-group">
                                                                <label for="address">Address:</label>
                                                                <input type="text" class="form-control" name="address" value="{{ $officeContact->address }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="location">Location:</label>
                                                                <input type="text" class="form-control" name="location" value="{{ $officeContact->location }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">Email:</label>
                                                                <input type="email" class="form-control" name="email" value="{{ $officeContact->email }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone">Phone:</label>
                                                                <input type="text" class="form-control" name="phone" value="{{ $officeContact->phone }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                                @endif
                            </div>

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

    <!-- Your existing HTML code -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.min.js"></script>

    <script>
        // Add JavaScript/jQuery to fade out the error message
        $(document).ready(function() {
            // Delay the fading out of the error message by 3 seconds (adjust as needed)
            setTimeout(function() {
                $('#error-message').fadeOut('slow');
            }, 3000); // 3000 milliseconds (3 seconds)
        });

    </script>
</body>

</html>

<script>
    // Automatically close the success message after 3 seconds
    setTimeout(function() {
        $('.alert').alert('close');
    }, 3000);

</script>
