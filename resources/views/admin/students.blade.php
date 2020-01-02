@extends('admin.index')

@section('content')

<br/>
<br/>
<br/>


<div class="panel panel-info">
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em"> All Student </p></div>
        <div class="panel-body">

                <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="th-sm">Name
                            </th>
                            <th class="th-sm">Division
                            </th>
                            <th class="th-sm">Student Number
                            </th>
                            <th class="th-sm">level
                            </th>
                            <th class="th-sm">  Process
                                </th>

                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $student)
                          <tr>
                          <td>{{$student->name}}</td>
                            <td>{{$student->student->division}}</td>
                            <td>{{$student->student->studentNumber}}</td>
                            <td>{{$student->student->level}}</td>
                            <td> <a href="{{route('admin.editStudent',[$student->student->id])}}"><i class="fa fa-edit" style="color: blue"></i> Update</a>
                                <form action="{{route('admin.deleteStudent',[$student->student->id])}}"  method="POST" class="d-inline form-inline delete">
                                    @method('DELETE')
                                    <button  type="submit" style="width: 20px ; height: 20px; "><i class="fa fa-trash" style="transform: translate(-3px,-3px); color: red"></i></button>
                                    @csrf
                                </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>

                      </table>
                      {{$users->links()}}

        </div>
      </div>


@endsection

@section('scripts')
<script>
        $('form.delete').on('submit', function(e) {
            if (!window.confirm('Are you sure to Delete this Student ?')) {
                e.preventDefault();
            }

        });
        </script>
@endsection
