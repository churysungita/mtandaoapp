   <table class="table table-bordered table-contextual" id="search">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Class Level</th> <!-- New Column -->
                                                    <th>Subject</th> <!-- New Column -->
                                                    <th>Topic</th> <!-- New Column -->
                                                    <th>Subtopic</th> <!-- New Column -->
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($posts as $post)
                                                <tr>
                                                    <td>{{ $post->title }}</td>
                                                    <td>{{ $post->darasa->class_name }}</td>
                                                    <!-- Display class level -->
                                                    <td>{{ $post->subject->subject_name }}</td>
                                                    <!-- Display subject -->
                                                    <td>{{ $post->topic->topic_name }}</td> <!-- Display topic -->
                                                    <td>{{ $post->subtopic->subtopic_name }}</td>
                                                    <!-- Display subtopic -->
                                                    <td>{{ ucfirst($post->status) }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.post_contents.edit', $post) }}" class="btn btn-primary">Edit</a>
                                                        <a href="{{ route('admin.post_contents.show', $post) }}" class="btn btn-success">View</a>
                                                        <!-- Add View button -->
                                                        <form action="{{ route('admin.post_contents.destroy', $post) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="7">No posts available.</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
