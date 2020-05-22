<h1>Create</h1>



<form action="/content/edit/{{ $page['file_name'] }}" method="post">

    @csrf

    @method("patch")

    <p>Name: 
        <input type="text" name="name" value="{{ $page['name'] }}">
    </p>

    <p>Published: 
        <input type="text" name="published" value="{{ $page['published'] }}">
    </p>

    <p>Content: 
        <input type="text" name="content" value="{{ $page['content'] }}">
    </p>

    <button type="submit">Submit</button>
</form>