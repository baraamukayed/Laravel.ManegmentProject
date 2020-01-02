@extends('teacher.index')

@section('content')

<br/>
<br/>
<br/>


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
                            <th class="th-sm"> Who is Suggested?
                            </th>
                            <th class="th-sm">Date Of Suggestion
                            </th>
                            <th class="th-sm"> Suggestion View
                            </th>

                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($projects as $project)
                            @if($project->isAccepted != 'yes')

                            <tr>
                                    <td>{{$project->title}} </td>
                                    <td> {{$project->type}}</td>
                                    <td>{{$project->user->name}}</td>
                                    <td>{{$project->created_at}}</td>
                                    <td><a href="{{ route('admin.downloadexplanatory',[$project->uuid])}}">{{ $project->explanatory }}</a></td>

                            </tr>
                            @endif
                            @endforeach

                        </tbody>

                      </table>
                      {{$projects->links()}}


        </div>
      </div>


@endsection
