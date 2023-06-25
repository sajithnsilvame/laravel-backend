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
                        <h1><a href="{{url('/home')}}" style="font-size: 35px">Dashboard</a>/Product List 
                          <a href="{{url('add-product')}}" class="btn btn-warning float-end m-auto">
                          Add New Product
                          </a>
                        </h1>
                        
                    </div>
                  </div>
                </div>


              <!-- product list -->
              <div class="col-lg-12 grid-margin stretch-card mt-5">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Main Category List</h4>
                    <div class="table-responsive">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Title </th>
                            <th> Description </th>
                            <th> Sizes </th>
                            <th> Colors </th>
                            <th> Main Category </th>
                            <th> Sub Category </th>
                            <th> Image </th>
                            <th> Price </th>
                            <th> Dis.Price </th>
                            <th> Quantity </th>
                            <th> Edit </th>
                            <th> Delete </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($products as $product)
                          <tr>
                            <td> {{$product->id}} </td>
                            <td> {{$product->title}} </td>
                            <td class="description" data-toggle="tooltip" data-placement="top" title="{{$product->description}}"> {{$product->description}} 
                            </td>

                            <td>
                              @if (is_array($product->size))
                                {{ implode(', ', $product->size) }}
                              @else
                                {{ implode(', ', json_decode($product->size)) }}
                              @endif
                            </td>

                            <td>
                              @if (is_array($product->color))
                                {{ implode(', ', $product->color) }}
                              @else
                                {{ implode(', ', json_decode($product->color)) }}
                              @endif
                            </td>

                            <td>
                              {{$product->main_category}}
                            </td>

                            <td>
                              @if (is_array($product->sub_category))
                                {{ implode(', ', $product->sub_category) }}
                              @else
                                {{ implode(', ', json_decode($product->sub_category)) }}
                              @endif
                            </td>

                            <td>
                                <a href="{{ Storage::url($product->image) }}">
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" width="100">
                                </a>  
                            </td>

                            <td> {{$product->price}} </td>
                            <td>
                              @if($product->discount_price)
                                  {{$product->discount_price}}
                              @else
                               <span class="text-danger">No Discount</span>    
                              @endif
                            </td>

                            <td>
                              {{$product->quantity}}
                            </td>

                            <td> 
                              <a class="btn btn-success btn-md"
                              href="{{url('edit-product',$product->id)}}">
                                Edit
                              </a>
                            </td>
                             <td> 
                              <a class="btn btn-danger btn-md" 
                              href="{{url('delete-product',$product->id)}}"
                              onclick=" return confirm('Are you sure that delete this product?')">Delete</a>  
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

      <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
      </script>

    @include('admin.components.scripts')
  </body>
</html>