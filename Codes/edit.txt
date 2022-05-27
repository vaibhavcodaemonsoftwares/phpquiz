<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    </head>
    <body>
        
        <div class="container" style="margin-top: 50px;">
            <div class="row">
                <div class="col-md-12">
                    @if (session('result'))
                        <h6 class="alert alert-success">{{session('result')}}</h6>
                    @endif
                    <div class="card" style="margin-bottom: 20px;">
                        <div class="card-header">
                            <h2>Edit Package
                            <a href="{{ url('add-product') }}" class="btn btn-danger float-end">BACK</a>
                            </h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('update-product/'.$package[0]->package_id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label class="form-label">Title:</label>
                                    <input type="text" class="form-control" name="package_name" value="{{$package[0]->package_name}}" >
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Price:</label>
                                    <input type="Number" class="form-control" name="package_price" value="{{ $package[0]->package_price }}" >
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Upload Images:</label>
                                    <input class="form-control" type="file" name="package_img"  >
                                    <img src="{{asset('img/'.$package[0]->package_img)}} " width="70px" height="70px">
                                </div>
                                <div class="form-group mb-3">
                                    <label  class="form-label">Discription:</label>
                                    <input type="text" class="form-control" name="package_desc"  value="{{ $package[0]->package_desc }}" >
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-primary">Update Package</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>