<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Admin</title>
    <!-- plugins:css -->
    @include('admin.components.styles')
    


    <style>
      .table td.description {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }

    </style>
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    
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
                        <h1><a href="{{url('/home')}}" style="font-size: 35px">Dashboard</a>/Categories
                        </h1> 
                    </div>
                  </div>
                </div>

                <!-- main category -->
              <div class="col-12 grid-margin stretch-card mt-5">
                <div class="card">
                  @if(session()->has('mainmessage'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session()->get('mainmessage')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif ($errors->has('name') || $errors->has('image'))
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
                    <h4 class="card-title">Main Categories</h4>
                    
                    <form class="forms-sample" action="{{url('add-main-category')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                      <div class="form-group">
                        <label for="exampleInputName1"> Category Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" name="name" >
                       
                      </div>
                      

                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">

                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      
                      
                      <button type="submit" class="btn btn-primary mr-2">Save</button>
                      <button class="btn btn-dark">Cancel</button>

                    </form>
                  </div>
                </div>
              </div>

              <!-- sub category -->
              <div class="col-12 grid-margin stretch-card mt-5">  
                <div class="card">
                  @if(session()->has('subMessage'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session()->get('subMessage')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif ($errors->has('category_name'))
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
                    <h4 class="card-title">Sub Categories</h4>
                    
                    <form class="forms-sample" action="{{url('add-subcategory')}}" method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" name="category_name" placeholder="Sub Category Name" >
                      </div>
                      
                      
                      <div class="form-group">
                        <div class="form-group">
                        <label for="exampleTextarea1">Description ( optional )</label>
                        <textarea class="form-control" name="category_des" rows="4"></textarea>
                      </div>
                      </div>
                      
                      
                      <button type="submit" class="btn btn-primary mr-2">Save</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>

              <!-- main category table -->
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  @if(session()->has('mainDeleteMessage'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session()->get('mainDeleteMessage')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  @endif
                  <div class="card-body">
                    <h4 class="card-title">Main Category List</h4>
                    <div class="table-responsive">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Image </th>
                            <th> Edit </th>
                            <th> Delete </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($main_category as $main_category)
                          <tr>
                            <td> {{$main_category->id}} </td>
                            <td>  {{$main_category->name}} </td>
                            <td>
                                <a href="{{ Storage::url($main_category->image) }}" target="_blank">
                                <img src="{{ Storage::url($main_category->image) }}" alt="{{ $main_category->name }}" width="100">
                                </a>
  
                            </td>
                            <td> 
                              <a class="btn btn-success btn-md"
                              href="{{url('edit-main-category',$main_category->id)}}">
                                Edit
                              </a>
                            </td>
                             <td> 
                              <a class="btn btn-danger btn-md" 
                              href="{{url('delete-main-category',$main_category->id)}}"
                              onclick=" return confirm('Are you sure that delete this category?')">Delete</a>  
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>


              <!-- sub category table -->
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  @if(session()->has('subDeleteMessage'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session()->get('subDeleteMessage')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  @endif
                  <div class="card-body">
                    <h4 class="card-title">Sub Category List</h4>
                    <div class="table-responsive">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Description </th>
                            <th> Edit </th>
                            <th> Delete </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($sub_category as $sub_category)
                          <tr>
                            <td> {{$sub_category->id}} </td>
                            <td> {{$sub_category->category_name}} </td>
                            <td class="description" data-toggle="tooltip" data-placement="top" title="{{$sub_category->category_des}}"> {{$sub_category->category_des}} </td>
                            <td>
                              <a class="btn btn-success btn-md"
                              href="{{url('edit-sub-category',$sub_category->id)}}">
                                Edit
                              </a>
                            </td>
                            
                            <td>
                              <a class="btn btn-danger btn-md" 
                              href="{{url('delete-sub-category',$sub_category->id)}}"
                              onclick=" return confirm('Are you sure that delete this sub category?')">Delete</a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
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