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
        <div class="panel-heading "><p style="text-align: center ; font-size: 1.5em"> All Teachers </p></div>
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
                            <th class="th-sm">Cv
                            </th>
                            <th class="th-sm">Process
                                </th>

                          </tr>
                        </thead>
                        <tbody >
                            @foreach ($users as $teacher)

                          <tr>
                            <td>{{$teacher->name}} </td>
                            <td> {{$teacher->teacher->job}}</td>
                            <td>{{$teacher->teacher->division}}</td>


                        <td>
                            @foreach ($discussion as $disc)
                            @if($teacher->teacher->id == $disc->teacher_id)
                            @foreach ($project as $pro)
                                @if($disc->project_id == $pro->id)
                                    {{$pro->title}} ,
                                @endif
                            @endforeach
                            @endif
                            @endforeach
                        </td>
                        <td><a href="{{ route('admin.download',[$teacher->teacher->uuid])}}">{{ $teacher->teacher->cv }}</a></td>
                            <td> <a href="{{route('admin.editTeacher',[$teacher->teacher->id])}}"><i class="fa fa-edit" style="color: blue"></i> Update</a>
                                <form action="{{route('admin.deleteTeacher',[$teacher->teacher->id])}}"  method="POST" class="d-inline form-inline delete">
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
            if (!window.confirm('Are you sure to Delete this Teacher ?')) {
                e.preventDefault();
            }

        });
        </script>
@endsection
