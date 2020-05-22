<style>
    .sidebar {
        background: hsl(80, 90%, 70%);
        padding: 30px;
    }

    .post {
        padding: 30px;
        background: lightblue;
        margin: 15px 0;
    }
</style>

<h1>Content View</h1>


<a href="/content/create/">Create</a>


@foreach($files as $file)
    <div class="post">
        <p>{{ $file['name'] }}</p>
        <p>{{ $file['published'] }}</p>
        <p>{{ $file['content'] }}</p>
        <p><a href="/content/edit/{{ $file['file_name'] }}">Edit</a></p>
    </div>
@endforeach




