@extends('teacher.index')

@section('content')

<br/>
<br/>
<br/>


<div class="panel panel-info">
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em">Discussions Table</p></div>
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
                            <th class="th-sm"> Date
                            </th>
                            <th class="th-sm"> Time
                            </th>
                            <th class="th-sm"> Place
                            </th>



                          </tr>
                        </thead>
                        <tbody >
                            @foreach ($discussions as $discussion)
                            <tr>
                                    <td>{{$discussion->project->title}}  </td>
                                    <td>{{$discussion->teacher->user->name}}</td>
                                    <td>
                                            @foreach ($students as $student)
                                                @if($student->id == $discussion->student_id)
                                                {{$student->user->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                    <td>{{$discussion->date}} </td>
                                    <td>{{$discussion->time}}  </td>
                                    <td>{{$discussion->place}} </td>

                            </tr>
                            @endforeach

                        </tbody>

                      </table>
        </div>
      </div>


@endsection
