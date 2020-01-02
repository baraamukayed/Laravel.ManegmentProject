<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Project;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class TeacherController extends Controller
{
    //

    public function index(){
        if(Auth::user()->role == 'teacher'){

        return view('teacher.index');
        }
        else{
            return redirect()->back();
        }
    }

    ///////////////// Data Of Teacher is Login /////////////////

    public function dataOfTeacher(){
        if(Auth::user()->role == 'teacher'){

        $idTeacher = Auth::user()->id;
        $teacher = Teacher::all()->where('user_id',$idTeacher)->first();
        return view('teacher.dataOfTeacher',compact('teacher'));
        }
        else{
            return redirect()->back();
        }
    }

    ///////////////// Show Edit Your Data /////////////////

    public function editYourData($id){
        if(Auth::user()->role == 'teacher'){

        $user = User::findOrFail($id);
        $teacher_id = $user->id;
        $teacher = Teacher::all()->where('user_id',$teacher_id)->first();
        return view('teacher.editYourData',compact(['user','teacher']));
        }
        else{
            return redirect()->back();
        }

    }

    ///////////////// Update Your Data /////////////////

        public function updateYourData(Request $request , $id){
            if(Auth::user()->role == 'teacher'){

                $request->validate([
                    'teacherNumber' => 'required|digits:6',
                    'name' => 'required|string',
                    'password' => 'required',
                    'college' => 'required|string',
                    'division' => 'required|string',
                    'job' => 'required|string',
                    'phone' => 'required',
                    'cv' => 'required',

                ]
                    ,[

                        'teacherNumber.required' => 'Teacher Number is required',
                        'teacherNumber.digits' => 'Teacher Number must be 6 Numbers',
                        'name.required' => 'Name is required',
                        'name.string' => 'Name must be String',
                        'password.required' => 'Password is required',
                        'college.required' => 'College is required',
                        'college.string' => 'College must be String',
                        'division.required' => 'Division is required',
                        'division.string' => 'Division must be String',
                        'job.required' => 'Job is required',
                        'job.string' => 'Job must be String',
                        'phone.required' => 'Phone is required',
                        'cv.required' => 'Cv is required',

                    ]
            );

                $user = User::findOrFail($id);
                $teacher_id = $user->id;
                $teacher = Teacher::all()->where('user_id',$teacher_id)->first();

                $user->name = $request->input('name');
                $user->password = Hash::make($request->input('password'));
                $user->update();

                $teacher->teacherNumber = $request->input('teacherNumber');
                $teacher->job = $request->input('job');
                $teacher->college = $request->input('college');
                $teacher->phone = $request->input('phone');

                $teacher['uuid'] = (string)Uuid::generate();
                if ($request->hasFile('cv')) {
                    $teacher['cv'] = $request->cv->getClientOriginalName();
                    $request->cv->storeAs('cvv', $teacher['cv']);
                }

                $teacher->division = $request->input('division');
                $teacher->gender = $request->input('gender');
                $teacher->update();


                return redirect()->back()->with('success','Your Data is Updating Now');

            }
            else{
                return redirect()->back();
            }
        }

            ///////////////// All Teacher /////////////////

        public function allTeachers(){
            if(Auth::user()->role == 'teacher'){
                $teachers = Teacher::paginate(5);
                $discussions = Discussion::all();
                $projects = Project::all();
            return view('teacher.allTeachers',compact(['teachers','discussions','projects']));
            }
            else{
                return redirect()->back();
            }
        }

        ///////////////// Show Suggested New Project from Teacher /////////////////

        public function showSuggestedNewProject(){
            if(Auth::user()->role == 'teacher'){
                return view('teacher.suggestedNewProject');
            }
            else{
                return redirect()->back();
            }
        }

        /////////////////  Suggested New Project from Teacher /////////////////


        public function suggestedNewProject(Request $request){
            if(Auth::user()->role == 'teacher'){

                $request->validate([
                    'title' => 'required|string',
                    'type' => 'required|string',
                    'description' => 'required|string',
                    'explanatory' => 'required|file',

                ]
                    ,[

                        'title.required' => 'Title is required',
                        'title.string' => 'Title must be String',
                        'type.required' => 'Type is required',
                        'type.string' => 'Type must be String',
                        'description.required' => 'Description is required',
                        'description.string' => 'Description must be String',
                        'explanatory.required' => 'Explanatory is required',
                        'explanatory.file' => 'Explanatory must be File',

                    ]
            );
                        $project = new Project();
                        $project->title = $request->input('title');
                        $project->type = $request->input('type');
                        $project->description = $request->input('description');

                        $project['uuid'] = (string)Uuid::generate();
                        if ($request->hasFile('explanatory')) {
                            $project['explanatory'] = $request->explanatory->getClientOriginalName();
                            $request->explanatory->storeAs('explanatories', $project['explanatory']);
                        }

                        $project->user_id = Auth::user()->id;
                        $project->isAccepted = 'yes';
                        $project->isAddToDisc = 0;
                        $project->save();

                        return redirect()->back()->with('success','Project is Suggested Now, This Project will Adding when Admin accept it');


            }
            else{
                return redirect()->back();
            }
        }

                    /////////////////  download explanatory /////////////////


        public function downloadexplanatory($uuid)
        {
            $project = Project::where('uuid', $uuid)->firstOrFail();
            $pathToFile = storage_path('app/explanatories/' . $project->explanatory);
            return response()->download($pathToFile);
        }

            /////////////////  Show All Projects /////////////////

            public function allProject(){
                if(Auth::user()->role == 'teacher'){

                    $projects = Project::paginate(5);
                    return view('teacher.allProject',compact(['projects']));
                }

                else{
                    return redirect()->back();
                }
            }


            /////////////////  Show All Discussion /////////////////


            public function allDiscussions(){
                if(Auth::user()->role == 'teacher'){
                    $students = Student::all();
                    $discussions = Discussion::paginate(5);
                    return view('teacher.discussions',compact(['discussions','students']));
                }

                else{
                    return redirect()->back();
                }
            }



}
