@extends('admin.index')

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
                            <th class="th-sm"> Process
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
                                    <td> <a href="{{route('admin.editDiscussion',[$discussion->id])}}"><i class="fa fa-edit" style="color: blue"></i> Update</a>
                                        <form action="{{route('admin.deleteDiscussion',[$discussion->id])}}"  method="POST" class="d-inline form-inline delete">
                                            @method('DELETE')
                                            <button  type="submit" style="width: 20px ; height: 20px; "><i class="fa fa-trash" style="transform: translate(-3px,-3px); color: red"></i></button>
                                            @csrf
                                        </form>
                                    </td>
                                 </tr>
                            @endforeach

                        </tbody>

                      </table>
                      {{$discussions->links()}}

        </div>
      </div>


@endsection
@section('scripts')
<script>
        $('form.delete').on('submit', function(e) {
            if (!window.confirm('Are you sure to Delete this Discussion ?')) {
                e.preventDefault();
            }

        });
        </script>
@endsection
