<!DOCTYPE html>
@include('Dashboardadmin.layout.header')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('Dashboardadmin.layout.sidebar')
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('/admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      @include('/Dashboardadmin.layout.nav')
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 <section class="content-header" style="background-color: ">
 <form  role="form" method="POST" action="{{url('/adminpanel/story/search')}}" enctype="multipart/form-data">
    
    {{csrf_field()}}

           <div style="margin-left:67%;">
           <input type="text" placeholder="Search.." name="s">
          <button type="submit" style="background-color:#dbc65d;;"><i class="fa fa-search" ></i></button>
          </div>
</form>

      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('/adminpanel/employer/create')}}"> Add Employer story </a></li>
      </ol>
 </section>

    <!-- Main content -->
    <section class="content" style="background-color:; ">
      <div class="row">
        <div class="col-xs-12">
         
            <!-- /.box-header -->
            <div class="box-body">
      <form action="{{url('/adminpanel/deleteid/story')}}" method="post">
      {{csrf_field()}}
       
            <table id="example2" class="table table-bordered table-striped dataTable">

                <thead>
                <tr>
                  <th> <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i></button>
                  </th>
                 
                  <th > description</th>
                  <th> user name</th>
                  <th>Created_at</th>
                  <th> Approval</th>
                
                </tr>
                </thead>
                <tbody>
           
               
                @foreach($story as $userinfo)
                <tr>
                <td><input type="checkbox" name=delid[] value="{{$userinfo->id}}"></td>
                  <td>{{$userinfo->description}}</td>
                  <td>{{$userinfo['user']['name']}}</td>
                  <td>{{$userinfo->created_at}}</td>
                  @if($userinfo->approval==1)
                  <td><input type="checkbox" name=approval value="{{$userinfo->approval}}" onclick="Approval(this,{{$userinfo->id}})" checked ></td>
               @else
               <td><input type="checkbox" name=approval value="{{$userinfo->approval}}" onclick="Approval(this,{{$userinfo->id}})"></td>
              @endif
             <td> <a href="{{url('/adminpanel/story/'.$userinfo->id.'/edit')}}" class="btn btn-primary"> Edit </a></td>
                </tr>
                @endforeach
           
                </tbody>
                <tfoot>
                {{ $story->links() }}
              
           
                </tfoot>

              </table>
           </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
          <!-- /.box -->
        </div>
        <!-- /.col -->

      <!-- /.row -->
    </section>
    </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<!-- AdminLTE for demo purposes -->
<script src="/admin/cust/sweetalert.js"></script>

<script src="/admin/cust/sweetalert.min.js"></script>
  @include('Dashboardadmin.layout.flashMessage')
  @include('Dashboardadmin.layout.footer')
     </body>
     @yield('scripts')

</html>

     <script>

     function Approval(e,id){
     var act;
     if(e.value==1)
      act=0;
      else act=1;
      $.ajax({
        url:"/approvalSuccessStories",
        data:{id:id,active:act},
        type:"get",
        success:function(data){}

      });

     }
     </script>