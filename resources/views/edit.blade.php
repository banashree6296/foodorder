<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <header class="jumbotron text-center">
            <h1>Edit Food Details</h1>
        </header>
        @if(isset($edit_details))
        <form method="post" enctype="multipart/form-data" action="{{url('api/update')}}">
            @csrf 
            <input type="hidden" name="hidden_id" value="{{$edit_details->id}}" class="form-control">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{$edit_details->name}}" class="form-control">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" value="{{$edit_details->price}}" class="form-control">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
                <img src="upload/{{$edit_details->image}}" height="78px" width="78px">
            </div>
            <div class="form-group">
                <button class="btn btn-sm btn outline-info">Update</button>
            </div>

        </form>
        @endif
    </div>
    
</body>
</html>