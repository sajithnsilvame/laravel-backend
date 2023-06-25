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
                      <h1> <a href="{{url('/home')}}" style="font-size: 35px">Dashboard</a>/Add New Product 
                        <a href="{{url('product-list')}}" class="btn btn-warning float-end m-auto">
                        Product List
                        </a>
                      </h1> 
                  </div>
                </div>
              </div>

              <div class="col-12 grid-margin stretch-card mt-5">
                <div class="card">
                  @if(session()->has('productSavemessage'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session()->get('productSavemessage')}}
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
                    <h4 class="card-title">Create New Product</h4>
                    
                    <form class="forms-sample" action="{{url('update-product',$product->id)}}" method="POST" enctype="multipart/form-data" id="myForm">
                      @csrf

                      <div class="form-group">
                        <label for="exampleInputTitle">Title <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" name="title" value="{{$product->title}}">                        
                      </div>

                      <div class="form-group">
                        <label for="exampleInputDescription">Description <span class="text-danger">*</span> </label>
                        <textarea class="form-control" name="description" rows="4" >{{$product->description}}</textarea>
                      </div>

                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                              <label for="exampleInputSizes">Sizes</label>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input"
                                name="size[]" value="XS">XS </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input"
                                name="size[]" value="S">S</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input"
                                name="size[]" value="M">M</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input"
                                name="size[]" value="L">L</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input"
                                name="size[]" value="XL">XL</label>
                            </div>
  
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="exampleInputColors">Colors</label>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" 
                                name="color[]" value="Black"> Black </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" 
                                name="color[]" value="White"> White </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" 
                                name="color[]" value="Red"> Red </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" 
                                name="color[]" value="Blue"> Blue </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" 
                                name="color[]" value="Green"> Green </label>
                            </div>

                          </div>
                        </div>

                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <h4 class="card-title">Categories <span class="text-danger">*</span> </h4>

                                <div class="form-group">
                                  <label>Select Main Category</label>
                                  <select class="js-example-basic-single" style="width:100%" name="main_category" id="m_c_dropdown">

                                    <option>Select</option>

                                  @foreach($main_Categories as $mainCategory)
                                    <option value="{{$mainCategory->name}}"> {{$mainCategory->name}} </option>
                                  @endforeach  
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label>Select Sub Categories <span class="text-danger">*</span> </label>
                                  <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="sub_category[]" id="s_c_dropdown">

                                    @foreach($sub_Categories as $subCategory)
                                    <option value="{{$subCategory->category_name}}"> {{$subCategory->category_name}} </option>
                                    @endforeach
                                  </select>
                                </div>

                              </div>
                            </div>
                        </div>

                      </div>

                      <div class="form-group">
                        <label>Image <span class="text-danger">*</span> </label>
                        <input type="file" name="image" class="file-upload-default" onchange="previewImage(event)">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">

                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                          
                        </div>
                          <div class="mt-2">
                            <img id="preview" src="#" alt="Preview Image" style="display:none;max-width:10%;height:10%;">
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">

                          <div class="form-group">
                            <label for="lableForPrice"> Price <span class="text-danger">*</span> </label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Rs</span>
                              </div>
                              <div class="input-group-prepend">
                                <span class="input-group-text">0.00</span>
                              </div>
                              <input type="text" class="form-control" name="price" value="{{$product->price}}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="lableForPrice">Discount Price</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Rs</span>
                              </div>
                              <div class="input-group-prepend">
                                <span class="input-group-text">0.00</span>
                              </div>
                              <input type="text" class="form-control" name="dis_price" value="{{$product->discount_price}}">
                            </div>
                          </div>

                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputQty">Quantity <span class="text-danger">*</span> </label>
                            <input type="number" class="form-control" id="quantity" name="qty" min="1" value="{{$product->quantity}}">
                          </div>
                        </div>
                      </div>
                                            
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <a class="btn btn-dark" onclick="resetForm()">Cancel</a>
                    </form>

                  </div>
                </div>
              </div>
                
            </div>  
          </div>
          
        </div>
        
      </div>
      
      <script>
        var quantityField = document.getElementById("quantity");

          quantityField.addEventListener("keydown", function(e) {
            if (e.keyCode === 69 || e.keyCode === 189 || e.keyCode === 190 || e.keyCode === 187 || e.keyCode === 107 || e.keyCode === 109 || e.keyCode === 110) {
              e.preventDefault();
            }
          });

          quantityField.addEventListener("input", function() {
            if (quantityField.value < 1) {
              quantityField.value = 1;
            }
          });


          function resetForm() {
            document.getElementById("myForm").reset();
            $('#m_c_dropdown').val('').trigger('change');
            $('#s_c_dropdown').val(null).trigger('change');
            document.getElementById("preview").style.display = "none";
            document.getElementById("preview").src = "#";
        }

        function previewImage(event) {
          var input = event.target;
          var reader = new FileReader();
          reader.onload = function(){
            var img = document.getElementById("preview");
            img.style.display = "block";
            img.src = reader.result;
          };
          reader.readAsDataURL(input.files[0]);
      }

      </script>
 
    @include('admin.components.scripts')
  </body>
</html>