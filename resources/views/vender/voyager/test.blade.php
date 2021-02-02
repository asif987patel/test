<form action="http://localhost/test/public/test" method="post" enctype="multipart/form-data">
    @csrf
    <label for="file">File</label>
    <input type="file" name="file">
    <input type="submit">
</form>
