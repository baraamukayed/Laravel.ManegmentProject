@extends('admin.index')

@section('content')

<br/>
<br/>
<br/>


<div class="panel panel-info">
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em">All Student Projects  </p></div>
        <div class="panel-body">

                <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="th-sm">Project Type
                            </th>
                            <th class="th-sm">Teacher
                            </th>
                            <th class="th-sm">Students
                            </th>


                          </tr>
                        </thead>
                        <tbody >
                @foreach ($projects as $project)
                          <tr>
                            <td>{{$project->title}}  </td>
                            <td>
                            @foreach ($teacher as $teach)
                                @if($teach->id == $project->discussion->teacher_id)
                            @foreach ($user as $us)
                                @if($us->id == $teach->user_id)
                                {{$us->name}}
                                @endif
                            @endforeach
                                @endif
                            @endforeach
                            </td>
                            <td>
                                @foreach ($students as $student)
                                    @if($student->id == $project->student_id)
                                        {{$student->user->name}}
                                    @endif
                                @endforeach
                            </td>

                          </tr>

                @endforeach

                        </tbody>

                      </table>
                      {{$projects->links()}}

        </div>
      </div>


@endsection
