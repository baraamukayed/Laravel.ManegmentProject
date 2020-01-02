@extends('student.index')

@section('content')

<br/>
<br/>
<br/>


<div class="panel panel-info">
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em">Group View  </p></div>
        <div class="panel-body">

                <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="th-sm">Student Number
                            </th>
                            <th class="th-sm">Name
                            </th>


                          </tr>
                        </thead>
                        <tbody >

                            @foreach ($students as $student)
                            <tr>
                            <td>{{$student->studentNumber}}</td>
                            <td>{{$student->user->name}}</td>
                            </tr>

                            @endforeach


                        </tbody>

                      </table>


        </div>
      </div>


@endsection
