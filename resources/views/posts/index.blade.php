<table>
    <thead>
        <th>Title</th>
        <th>Active</th>
    </thead>
    @foreach ($posts as $post)
        <tr>
            <td>{{ $post->title }} </td>
            <td>{{ $post->active ? "Yes" : "No" }}</td>
        </tr>
    @endforeach

</table>

{{ $posts->appends(request()->input())->links("pagination::bootstrap-4") }}