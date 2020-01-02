@extends('teacher.index')

@section('content')

<br/>
<br/>
<br/>


<div class="panel panel-info">
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em"> All Teachers   </p></div>
        <div class="panel-body">

                <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="th-sm">Name
                            </th>
                            <th class="th-sm">Job
                            </th>
                            <th class="th-sm">Division
                            </th>
                            <th class="th-sm">Supervised Projects
                                </th>


                          </tr>
                        </thead>
                        <tbody >
                            @foreach ($teachers as $teacher)

                          <tr>
                          <td> {{$teacher->user->name}}</td>
                            <td>{{$teacher->job}}  </td>
                            <td>{{$teacher->division}}  </td>
                            <td>
                                @foreach ($discussions as $discussion)

                                @if ($discussion->teacher_id == $teacher->id)

                                @foreach ($projects as $project)
                                    @if ($project->id == $discussion->project_id)
                                        {{$project->title}} ,
                                    @endif
                                @endforeach
                                @endif
                                @endforeach
                                </td>

                          </tr>
                          @endforeach
                        </tbody>

                      </table>
                      {{$teachers->links()}}

        </div>
      </div>


@endsection
