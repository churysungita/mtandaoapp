<form id="editForm" action="{{ route('admin.updateUser', ['id' => $user->id]) }}" method="POST"  >
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" required>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}" style="color: white; ">
    </div>
    <div class="form-group">
        <label for="usertype">User Type</label>
        <select name="usertype" id="usertype" class="form-control" required>
            <option value="1" @if($user->usertype === '1') selected @endif>Admin</option>
            <option value="2" @if($user->usertype === '2') selected @endif>Teacher</option>
            <option value="3" @if($user->usertype === '3') selected @endif>Student</option>
        </select>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password if you want to change it">
    </div>
    <button type="submit" class="btn btn-primary">Update User</button>
</form>
