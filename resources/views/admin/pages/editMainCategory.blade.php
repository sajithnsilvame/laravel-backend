<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Admin</title>
    <!-- plugins:css -->
    @include('admin.components.styles')
    
  </head>
  <body>
      <div class="container-scroller">

        <!-- sidebar -->
          @include('admin.components.sidebar')
        <!-- sidebar end-->
        <div class="container-fluid page-body-wrapper">
          <!-- navbar -->
          @include('admin.components.navbar')
          <!-- navbar end -->
          <div class="main-panel">
            <div class="content-wrapper">

                <div class="d-flex align-items-center justify-content-center">
                  <div class="card">
                    <div class="card-header">
                        <h1><a href="{{url('/home')}}" style="font-size: 35px">Dashboard</a>/Edit Categories

                        <a href="{{url('/categories')}}" class="btn btn-warning float-end m-auto">
                        Categories
                        </a>
                        </h1> 
                    </div>
                  </div>
                </div>

                <!-- main category -->
              <div class="col-12 grid-margin stretch-card mt-5">
                <div class="card">
                  
                @if(session()->has('mainUpdateMessage'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session()->get('mainUpdateMessage')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif ($errors->any())
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <div>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </div>
                      </div>
                  @endif
                  
                  
                  <div class="card-body">
                    <h4 class="card-title">Edit & Update Main Categories</h4>
                    
                    <form class="forms-sample" action="{{url('update-main-category',$main_category->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                      <div class="form-group">
                        <label for="exampleInputName1"> Category Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" name="name" value="{{$main_category->name}}">
                       
                      </div>
                      
                      <div class="form-group">
                        <label>Image</label>
                        <a href="{{ Storage::url($main_category->image) }}" >
                          <img style="margin:auto;" height="100" width="100" src="{{ Storage::url($main_category->image) }}" class="mb-2">
                        </a>
                        
                        <div class="input-group col-xs-12">
                          <input type="file" name="image" class="form-control file-upload-info" id="chooseFile">
                        </div> 
                      </div>

                      <button type="submit" class="btn btn-info mr-2">Update</button>
                      <button class="btn btn-dark">Cancel</button>

                    </form>
                  </div>

                  

                </div>
              </div>

              

              


             


            </div>  

          </div>
          
        </div>
        
      </div>
 
    @include('admin.components.scripts')
  </body>
</html>