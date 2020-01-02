<!DOCTYPE html>
<html lang="en">
  <head>
      @include('admin.layouts.header')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>  Manegment!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('assets/images/img.jpg')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{Auth::user()->name}} </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Process</h3>
                <ul class="nav side-menu">

                <li><a href="{{route('teacher.dataOfTeacher')}}"> Data Of Teacher <span ></span></a>
                <li><a href="{{route('teacher.allTeachers')}}">   Teachers <span></span></a>
                    <li><a> Projects  <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                      <li><a href="{{route('teacher.showSuggestedNewProject')}}"> Suggested New Project</a></li>
                        <li><a href="{{route('teacher.allProject')}}">Show all Projects </a></li>
                        </ul>
                    </li>
                <li><a href="{{route('teacher.allDiscussions')}}">  Discusions <span ></span></a>

                </ul>
              </div>


            </div>

            <!-- /sidebar menu -->



          </div>
        </div>




        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
                    <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                          </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('assets/images/img.jpg')}}" alt=""> {{Auth::user()->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         <i class="fa fa-sign-out pull-right"></i> <span style="font-size: 1.3em">Log Out</span>
                     </a>
                      <form action="{{ route('logout') }}" method="POST" id="logout-form">
                          @csrf
                      </form>
                  </ul>
                </li>


              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main">


            @yield('content')


          </div>


        </div>
        <!-- /page content -->

      </div>
    </div>



      {{-- javascript --}}

      @extends('admin.layouts.footer')


  </body>
</html>
