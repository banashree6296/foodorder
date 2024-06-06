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
            <h1>Food Items</h1>
        </header>
        @if(isset($details))

        
        <section>
           <a href="{{url('api/form')}}"><button class="btn btn-sm btn-outline-info float-right" >Add new food Item</button></a>
        </section>
        
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                    <tr>
                        <th>SL NO</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    @foreach($details->all() as $info)
                    <tr>
                        <td>{{$info->id}}</td>
                        <td>{{$info->name}}</td>
                        <td>{{$info->description}}</td>
                        <td>{{$info->price}}</td>
                        <td><img src="http://localhost:8000/upload/{{$info->image}}" height="68px" width="68px" ></td>
                        <td>
                            <a href="{{url('api/edit')}}{{$info->id}}"><button class="btn btn-sm btn-outline-warning">Edit</button></a>
                            <a href="{{url('api/delete')}}{{$info->id}}"><button class="btn btn-sm btn-outline-danger">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
        @endif
    </div>
</body>
</html>