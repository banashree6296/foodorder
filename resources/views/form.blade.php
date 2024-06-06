<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <header class="jumbotron text-center">
            <h1>Please fill the form</h1>
        </header>

        
        @if(isset($message))
        {{$message}}
        @endif

        <form method="post" enctype="multipart/form-data" action="{{url('api/submit')}}">
        @csrf 
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control">

        </div>
        <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" class="form-control">
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" class="form-control">
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-sm btn-outline-success">Submit</button>
        </div>
        </form>
    </div>
    
</body>
</html>