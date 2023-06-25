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
                  
                @if(session()->has('subUpdateMessage'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session()->get('subUpdateMessage')}}
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
                    <h4 class="card-title">Edit & Update Sub Categories</h4>
                    
                    <form class="forms-sample" action="{{url('update-sub-category',$sub_category->id)}}" method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="category_name" placeholder="Sub Category Name" required="" value="{{$sub_category->category_name}}">
                      </div>
                      
                      
                      <div class="form-group">
                        <div class="form-group">
                        <label for="exampleTextarea1">Description ( optional )</label>
                        <textarea class="form-control" name="category_des" rows="4"
                        >{{$sub_category->category_des}}</textarea>
                      </div>
                      </div>
                      
                      
                      <button type="submit" class="btn btn-primary mr-2">Save</button>
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