       <!-- DataTables and AJAX script -->
       <script>
                            $(document).ready(function () {
                                const userTable = $('#user-table').DataTable({
                                    // ... (other DataTables configurations)
                                    columnDefs: [{

                                        targets: -1, // Actions column index
                                        orderable: false, // Disable sorting
                                    }],
                                });

                                // Open Edit Modal on Edit Button Click
                                $('#user-table tbody').on('click', 'button.btn-edit', function () {
                                    const userId = $(this).data('user-id');
                                    const editForm = $('#editModal .modal-body').html($(
                                        '#editFormTemplate').html());

                                    // Fetch user data via AJAX and populate the form fields

                                    // Show the modal
                                    $('#editModal').modal('show');
                                });

                                // Handle form submission
                                $('#editModal').on('submit', '#editForm', function (event) {
                                    event.preventDefault();

                                    // Perform AJAX form submission and update user data

                                    // Close the modal
                                    $('#editModal').modal('hide');
                                });
                            });
                        </script>

                        <script>
                            var table = $('#user-table').DataTable();
                            table.destroy(); // Destroy the existing DataTable instance
                            $('#user-table').DataTable(); // Initialize DataTable again with new settings or data

                            // Initialize DataTable with Ajax
                            $(document).ready(function () {
                                $('#user-table').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    ajax: "{{ route('admin.getUsersData') }}",
                                    dataSrc: function (json) {
                                        return json; // Return the data directly from the response
                                    }
                                    columns: [{
                                            data: 'name',
                                            name: 'name'
                                        },
                                        {
                                            data: 'email',
                                            name: 'email'
                                        },
                                        {
                                            data: 'phone',
                                            name: 'phone'
                                        },
                                        {
                                            data: 'address',
                                            name: 'address'
                                        },
                                        {
                                            data: 'usertype',
                                            name: 'usertype'
                                        },
                                        {
                                            data: 'actions',
                                            name: 'actions',
                                            orderable: false,
                                            searchable: false
                                        },
                                    ],
                                });

                            });

                            $('#editForm').on('submit', function (e) {
                                e.preventDefault(); // Prevent the default form submission

                                // Perform AJAX submission
                                $.ajax({
                                    url: $(this).attr('action'),
                                    type: $(this).attr('method'),
                                    data: $(this).serialize(),
                                    success: function (response) {
                                        // Show success message and redraw DataTable
                                        $('#message-container').html(
                                            '<div class="alert alert-success">User updated successfully!</div>'
                                            );
                                        table.ajax
                                    .reload(); // Redraw the DataTable to reflect the changes
                                    },
                                    error: function () {
                                        // Show error message
                                        $('#message-container').html(
                                            '<div class="alert alert-danger">An error occurred while updating the user.</div>'
                                            );
                                    }
                                });
                            });

                            // Form submit event handler
                            $('#editForm').on('submit', function (e) {
                                e.preventDefault(); // Prevent the default form submission

                                var submitButton = $(this).find('[type="submit"]');
                                submitButton.prop('disabled',
                                true); // Disable the button to prevent multiple submissions

                                // Perform AJAX submission
                                $.ajax({
                                    url: $(this).attr('action'),
                                    type: $(this).attr('method'),
                                    data: $(this).serialize(),
                                    success: function (response) {
                                        // Show success message and redraw DataTable
                                        $('#message-container').html(
                                            '<div class="alert alert-success">User updated successfully!</div>'
                                            );
                                        table.ajax
                                    .reload(); // Redraw the DataTable to reflect the changes
                                    },
                                    error: function () {
                                        // Show error message
                                        $('#message-container').html(
                                            '<div class="alert alert-danger">An error occurred while updating the user.</div>'
                                            );
                                    },
                                    complete: function () {
                                        submitButton.prop('disabled',
                                        false); // Re-enable the button after AJAX request completes
                                    }
                                });
                            });
                        </script>



