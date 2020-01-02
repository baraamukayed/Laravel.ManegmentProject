@extends('admin.index')

@section('content')

<br/>
<br/>

<div>
        <a href="{{route('admin.suggestedProjectFromTeacher')}}"> <i class="fa fa-arrow-right" style="font-size: 1.3em"></i> <span style="font-size: 1.3em ; color: red"> The Projects Suggested by Teachers are Unacceptable </span>
        </a>
    </div>
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
                            <th class="th-sm">Date Of Suggestion
                            </th>
                            <th class="th-sm"> Who is suggested?
                            </th>
                            <th class="th-sm"> Suggestion View
                            </th>
                            <th class="th-sm"> Process
                            </th>

                          </tr>
                        </thead>
                        <tbody>
            @foreach ($projects as $project)
                            @if($project->isAccepted != 'yes')
                          <tr>
                            <td>{{$project->title}} </td>
                            <td> {{$project->type}}</td>
                            <td>{{$project->created_at}}</td>
                            <td>{{$project->user->name}}</td>
                            <td><a href="{{ route('admin.downloadexplanatory',[$project->uuid])}}">{{ $project->explanatory }}</a></td>
                            <td>
                                    <a href="{{route('admin.editProject',[$project->id])}}"><i class="fa fa-edit" style="color: blue"></i> Update</a>
                                    <form action="{{route('admin.deleteProject',[$project->id])}}"  method="POST" class="d-inline form-inline delete">
                                        @method('DELETE')
                                        <button  type="submit" style="width: 20px ; height: 20px; "><i class="fa fa-trash" style="transform: translate(-3px,-3px); color: red"></i></button>
                                        @csrf
                                    </form>
                            </td>

                          </tr>
                          @endif
            @endforeach

                        </tbody>

                      </table>
                      {{$projects->links()}}



        </div>

      </div>


@endsection

@section('scripts')
<script>
        $('form.delete').on('submit', function(e) {
            if (!window.confirm('Are you sure to Delete this Project ?')) {
                e.preventDefault();
            }

        });
        </script>
@endsection
