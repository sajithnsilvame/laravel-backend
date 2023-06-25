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
                        <h1><a href="{{url('/home')}}" style="font-size: 35px">Dashboard</a>/Orders </h1>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12 grid-margin stretch-card mt-5">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Main Category List</h4>
                    <div class="table-responsive">
                      <table class="table table-dark">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> First name </th>
                            <th> Amount </th>
                            <th> Deadline </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> 1 </td>
                            <td> Herman Beck </td>
                            <td> $ 77.99 </td>
                            <td> May 15, 2015 </td>
                          </tr>
                          <tr>
                            <td> 2 </td>
                            <td> Messsy Adam </td>
                            <td> $245.30 </td>
                            <td> July 1, 2015 </td>
                          </tr>
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