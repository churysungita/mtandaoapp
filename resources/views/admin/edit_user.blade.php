<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.navbar')
        <!-- partial -->
        <!-- Main body section -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">

                </div>

                <div class="row">

                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="container">
                                            <h2>Edit User</h2>
                                            <form
                                                action="{{ route('admin.updateUser', ['id' => $user->id]) }}"
                                                method="POST">
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
                                                        value="{{ $user->address }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="usertype">User Type</label>
                                                    <select name="usertype" id="usertype" class="form-control" required>
                                                        <option value="admin" @if($user->usertype === '1') selected
                                                            @endif>Admin</option>
                                                        <option value="teacher" @if($user->usertype === '2') selected
                                                            @endif>Teacher</option>
                                                        <option value="student" @if($user->usertype === '3') selected
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

                        </div>
                    </div>



                </div>
            </div>


            <!-- partial -->
        </div>


        <!-- @include('admin.body')  -->
        <!-- main body section panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>