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


<div class="sidebar">
    <h2>Content Types</h2>
    <hr>

<ul>
    <li>Blog Post</li>
    <li>Page</li>
</ul>

</div>


<hr>


@foreach($files as $file)
    <div class="post">
        <p>{{ $file['name'] }}</p>
        <p>{{ $file['published'] }}</p>
        <p>{{ $file['content'] }}</p>
    </div>
@endforeach



