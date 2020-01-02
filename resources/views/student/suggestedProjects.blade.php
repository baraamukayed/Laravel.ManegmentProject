@extends('student.index')

@section('content')

<br/>
<br/>
<br/>

<div class="row">

        <div class="col-md-12">

            @if(session()->has('success'))
                <div class="alert alert-success">

                    {{session()->get('success')}}

                </div>

                @endif

            </div>
 </div>

 @if($std->project == null)

<div class="panel panel-info">
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em">Suggested Projects</p></div>
        <div class="panel-body">
                <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="th-sm">Project Title
                            </th>
                            <th class="th-sm">Project Type
                            </th>
                            <th class="th-sm">Who is Suggested?
                            </th>
                            <th class="th-sm"> Suggestion View
                            </th>
                            <th class="th-sm">  Select Project
                                </th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                            @if($project->isAccepted != 'yes')
                            @if($project->isSelected != 'yes')
                            <tr>
                                    <td>{{$project->title}} </td>
                                    <td> {{$project->type}}</td>
                                    <td> {{$project->user->name}}</td>
                                    <td><a href="{{ route('admin.downloadexplanatory',[$project->uuid])}}">{{ $project->explanatory }}</a></td>
                                    <td>
                                <form action="{{route('student.selectProject',$project->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success"> Select </button>
                                </form>
                            </td>
                            @endif
                            @endif
                                </tr>
                            @endforeach

                        </tbody>

                      </table>
                      {{$projects->links()}}

        </div>
      </div>

      @else
     <span style="color: green;font-size: 1.2em;"> You are select Project , If you want to change it u must to delete your project </span>
     <br>
     <div class="panel panel-info">
            <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em"> Project For You</p></div>
            <div class="panel-body">
                    <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th class="th-sm">Project Title
                                </th>
                                <th class="th-sm">Project Type
                                </th>
                                <th class="th-sm">Who is Suggested?
                                </th>
                                <th class="th-sm"> Suggestion View
                                </th>
                                <th class="th-sm">  Operation
                                    </th>

                              </tr>
                            </thead>
                            <tbody>

                                <tr>
                                        <td>{{$std->project->title}} </td>
                                        <td> {{$std->project->type}}</td>
                                        <td> {{$std->project->user->name}}</td>
                                        <td><a href="{{ route('admin.downloadexplanatory',[$std->project->uuid])}}">{{ $std->project->explanatory }}</a></td>
                                        <td>
                                    <form action="{{route('student.deleteProject',$std->project->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger"> Delete </button>
                                    </form>
                                </td>

                                    </tr>

                            </tbody>

                          </table>

            </div>
          </div>
          @endif
@endsection
