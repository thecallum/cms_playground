<h1>Create</h1>



<form action="/content/create" method="post">

    @csrf

    <p>Name: 
        <input type="text" name="name">
    </p>

    <p>Published: 
        <input type="text" name="published">
    </p>

    <p>Content: 
        <input type="text" name="content">
    </p>

    <button type="submit">Submit</button>
</form>