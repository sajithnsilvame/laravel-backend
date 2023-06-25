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
                @include('admin.components.contentBody')
            </div>  
          </div>
          
        </div>
        
      </div>
 
    @include('admin.components.scripts')
  </body>
</html>