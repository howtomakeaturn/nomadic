<form action="/upload-photo" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    {{ csrf_field() }}
    <input type="submit" value="Upload Image" name="submit">
</form>
