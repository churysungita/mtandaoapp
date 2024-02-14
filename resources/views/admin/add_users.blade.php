<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">

        @include('admin.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                </div>
                <div class="row">



                </div>
                <div class="row">

                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="container">
                            <div class="row justify-content-center">



                                <div class="col">

                                    <!-- Flash messages -->
                                    @if(session('success'))
                                    <div class="alert alert-success" id="addedMessage">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    <div class="card">
                                        <div class="card-header">Add New User</div>
                                        <div class="card-body">
                                            <form action="{{url('create_users')}}" method="POST">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="name">Name:</label>
                                                    <input type="text" name="name" id="name" class="form-control"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="email" name="email" id="email" class="form-control"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone:</label>
                                                    <input type="text" name="phone" id="phone" class="form-control"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address:</label>
                                                    <input type="text" name="address" id="address" class="form-control"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password:</label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group">


                                                    <label for="usertype" value="">
                                                        <div class="flex items-center">
                                                            <label class="inline-flex items-center">
                                                                <input type="radio" name="usertype" value="3"
                                                                    class="form-radio" checked>
                                                                <span class="ml-2">Student</span>
                                                            </label>
                                                            <label class="inline-flex items-center ml-6">
                                                                <input type="radio" name="usertype" value="2"
                                                                    class="form-radio">
                                                                <span class="ml-2">Teacher</span>
                                                            </label>
                                                            <label class="inline-flex items-center ml-6">
                                                                <input type="radio" name="usertype" value="1"
                                                                    class="form-radio">
                                                                <span class="ml-2">Admin</span>
                                                            </label>
                                                        </div>
                                                        <br>
                                                        <button type="submit" class="btn btn-primary">Add User</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
            </div>



        </div>


    </div>
    <!-- page-body-wrapper ends -->
    </div>
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
<script>
// Remove the update message after 3 seconds
setTimeout(function() {
    $('#addedMessage').fadeOut('slow');
}, 3000);
</script>

</html>