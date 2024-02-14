        <!DOCTYPE html>
        <html lang="en">

        <head>


            <!-- Include Bootstrap CSS -->

            <!-- Include DataTables CSS -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

            <!-- Include jQuery -->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

            <!-- Include Bootstrap JS (popper.js is required by Bootstrap) -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            <!-- Include DataTables JS -->
            <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>









            @include('admin.css')


        </head>
        <style>
            /* Style for all export buttons */
            .dt-buttons .buttons-collection {
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                margin-right: 5px;
            }

            /* Style for specific export buttons */
            .buttons-copy,
            .buttons-csv,
            .buttons-excel,
            .buttons-pdf,
            .buttons-print {
                /* Add additional styling if needed */
            }

        </style>

        <body>
            <div class="container-scroller">

                <!-- partial:partials/_sidebar.html -->
                @include('admin.sidebar')
                <!-- partial -->
             
                <!-- partial -->
                <!-- Main body section -->


                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div id="message-container"></div>

                            <div class="col-lg-12 grid-margin stretch-card">

                                <div class="card">
                                    <!-- Add a row to display messages -->
                                    <!-- Flash messages -->
                                    @if(session('messagedeleted'))
                                    <div class="alert alert-danger" id="deleteMessage">
                                        {{ session('messagedeleted') }}
                                    </div>
                                    @endif

                                    @if(session('messageupdated'))
                                    <div class="alert alert-success" id="updateMessage">
                                        {{ session('messageupdated') }}
                                    </div>
                                    @endif
                                    <div class="card-body">
                                        <h4 class="card-title">Users list</h4>
                                        <!-- <p class="card-description"> Add class <code>.table-hover</code> -->
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="user-table">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                        <th>User Type</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $user)
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>{{ $user->address }}</td>
                                                        <td>{{ $user->usertype }}</td>
                                                        <td>

                                                            <button class="btn btn-primary btn-edit"
                                                                data-user-id="{{ $user->id }}"
                                                                data-user-name="{{ $user->name }}"
                                                                data-user-email="{{ $user->email }}"
                                                                data-user-phone="{{ $user->phone }}"
                                                                data-user-address="{{ $user->address }}"
                                                                data-user-usertype="{{ $user->usertype }}"
                                                                data-toggle="modal" data-target="#editModal">
                                                                Edit
                                                            </button>

                                                            @if ($user->usertype !== '1')
                                                            <a href="{{ route('admin.deleteUser', ['id' => $user->id]) }}"
                                                                class="btn btn-danger badge-danger">Delete</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>


                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Add Bootstrap Modal -->

                        <!-- Edit Modal -->
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editUserForm"
                                            action="{{ route('admin.updateUser', ['id' => $user->id]) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ $user->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    value="{{ $user->email }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" id="phone" class="form-control"
                                                    value="{{ $user->phone }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="address" class="form-control"
                                                    value="{{ $user->address }}" style="color: white;">
                                            </div>
                                            <div class="form-group">
                                                <label for="usertype">User Type</label>
                                                <select name="usertype" id="usertype" class="form-control" required>
                                                    <option value="1" @if($user->usertype === '1') selected @endif>Admin
                                                    </option>
                                                    <option value="2" @if($user->usertype === '2') selected
                                                        @endif>Teacher</option>
                                                    <option value="3" @if($user->usertype === '3') selected
                                                        @endif>Student</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control"
                                                    placeholder="Enter new password if you want to change it">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update User</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <!-- Delete modal content -->
                        </div>

                        <script>
                            $(document).ready(function () {

                                $('#user-table').DataTable({
                                    paging: true, // Enable pagination
                                    searching: true, // Enable searching
                                    dom: 'Bfrtip', // Enable export buttons
                                    buttons: [{
                                            extend: 'copy',
                                            className: 'buttons-collection'
                                        },
                                        {
                                            extend: 'csv',
                                            className: 'buttons-collection'
                                        },
                                        {
                                            extend: 'excel',
                                            className: 'buttons-collection'
                                        },
                                        {
                                            extend: 'pdf',
                                            className: 'buttons-collection'
                                        },
                                        {
                                            extend: 'print',
                                            className: 'buttons-collection'
                                        }
                                    ],
                                    // ... Other DataTables configurations
                                });

                                // Edit button click handler
                                $('#user-table').on('click', '.btn-edit', function () {
                                    var userId = $(this).data('user-id');
                                    var userName = $(this).data('user-name');
                                    var userEmail = $(this).data('user-email');
                                    var userPhone = $(this).data('user-phone');
                                    var userAddress = $(this).data('user-address');
                                    var userUsertype = $(this).data('user-usertype');

                                    // Populate edit modal form fields with user data
                                    $('#name').val(userName);
                                    $('#email').val(userEmail);
                                    $('#phone').val(userPhone);
                                    $('#address').val(userAddress);
                                    $('#usertype').val(userUsertype);

                                    $('#editModal').modal('show');
                                });
                            });

                            // Delete button click handler
                            $('#user-table').on('click', '.btn-delete', function () {
                                var userId = $(this).data('user-id');
                                $('#deleteModal').html(
                                    '<div>Delete modal content for user with ID: ' + userId +
                                    '</div>');
                                $('#deleteModal').modal('show');
                            });

                            // Delete confirmation modal submit handler
                            // Delete confirmation modal submit handler
                            $('#deleteModal').on('click', '.btn-confirm-delete', function () {
                                var userId = $(this).data('user-id');
                                $.ajax({
                                    url: "{{ route('admin.deleteUser', ['id' => ':id']) }}"
                                        .replace(':id', userId),
                                    type: 'POST',
                                    data: {
                                        id: userId
                                    },
                                    success: function () {
                                        // Update table by removing the deleted row
                                        $('tr[data-user-id="' + userId + '"]').remove();
                                        $('#deleteModal').modal('hide');

                                        // Display success message
                                        showMessage('User deleted successfully!',
                                            'success');
                                    },
                                    error: function () {
                                        // Display error message
                                        showMessage(
                                            'An error occurred while deleting the user.',
                                            'error');
                                    }
                                });
                            });

                        </script>




                    </div>

                    <!-- @include('admin.body')  -->
                    <!-- main body section panel ends -->
                </div>
                <!-- page-body-wrapper ends -->
            </div>
            <!-- container-scroller -->
            <!-- plugins:js -->
            @include('admin.script')


            </div>
            <!-- End custom js for this page -->
        </body>
        <script>
            // Remove the delete message after 3 seconds
            setTimeout(function () {
                $('#deleteMessage').fadeOut('slow');
            }, 3000);

            // Remove the update message after 3 seconds
            setTimeout(function () {
                $('#updateMessage').fadeOut('slow');
            }, 3000);

        </script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

        <!-- DataTables JavaScript -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <!-- DataTables Buttons CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

        <!-- DataTables Buttons JavaScript -->
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>


        </div>
