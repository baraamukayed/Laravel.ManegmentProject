<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Group;
use App\Project;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;


class StudentController extends Controller
{
            /////////////////  Index /////////////////

    public function index(){
        if(Auth::user()->role == 'student'){

        return view('student.index');
        }
        else{
            return redirect()->back();
        }
    }

        /////////////////  Data Of Student /////////////////

        public function dataOfStudent(){

            if(Auth::user()->role == 'student'){

                $idStudent = Auth::user()->id;
                $student = Student::all()->where('user_id',$idStudent)->first();
                return view('student.dataOfStudent',compact('student'));
                }
                else{
                    return redirect()->back();
                }
        }


        /////////////////  Show page Edit Data /////////////////

        public function editYourData($id){
            if(Auth::user()->role == 'student'){

                $user = User::findOrFail($id);
                $student_id = $user->id;
                $student = Student::all()->where('user_id',$student_id)->first();

                return view('student.editYourData',compact(['user','student']));
            }
            else{
                return redirect()->back();
            }
        }

        /////////////////  Update Your Data /////////////////

        public function updateYourData (Request $request , $id){
            if(Auth::user()->role == 'student'){
                $request->validate([
                    'studentNumber' => 'required|digits:6',
                    'name' => 'required|string',
                    'password' => 'required',
                    'college' => 'required|string',
                    'division' => 'required|string',
                    'level' => 'required',

                ]
                    ,[

                        'studentNumber.required' => 'Student Number is required',
                        'studentNumber.digits' => 'Student Number must be 6 Numbers',
                        'name.required' => 'Name is required',
                        'name.string' => 'Name must be String',
                        'password.required' => 'Password is required',
                        'college.required' => 'College is required',
                        'college.string' => 'College must be String',
                        'division.required' => 'Division is required',
                        'division.string' => 'Division must be String',
                        'level.required' => 'Level is required',
                    ]
            );

            $user = User::findOrFail($id);
            $student_id = $user->id;
            $student = Student::all()->where('user_id',$student_id)->first();

            $user->name = $request->input('name');
            $user->password = Hash::make($request->input('password'));
            $user->update();

            $student->studentNumber = $request->input('studentNumber');
            $student->level = $request->input('level');
            $student->college = $request->input('college');
            $student->division = $request->input('division');
            $student->gender = $request->input('gender');
            $student->update();


            return redirect()->back()->with('success','Your Data is Updating Now');

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


        /////////////////  Suggested Projects /////////////////

        public function suggestedProjects(){
            if(Auth::user()->role == 'student'){
                $projects = Project::paginate(5);

                // $std = Student::all()->where('user_id','=',Auth::user()->id)->first();
                // if($std->project != null){
                //     echo "has Project";
                //     return view('student.isSelectProject');
                // }
                // else{
                //     return view('student.suggestedProjects',compact(['projects']));
                // }
                $std = Student::all()->where('user_id','=',Auth::user()->id)->first();

                    return view('student.suggestedProjects',compact(['projects','std']));

            }
            else{
                return redirect()->back();
            }
        }

                /////////////////  Select Project /////////////////

            public function selectProject(Request $request , $id){
                if(Auth::user()->role == 'student'){

                    $project = Project::findOrFail($id);
                    $project->isSelected = 'yes';

                    $stdId = Auth::user()->id;
                    $student = Student::all()->where('user_id',$stdId)->first();
                    $project->student_id = $student->id;

                    $discussion = Discussion::all()->where('project_id','=',$project->id)->first();
                    if($discussion == null){
                        $project->save();
                        return redirect()->back()->with('success','You are Select Project');
                    }
                    else{
                        $discussion->student_id = $project->student_id;
                        $discussion->save();
                        $project->save();
                        return redirect()->back()->with('success','You are Select Project');

                    }



                }
                else{
                    return redirect()->back();
                }
            }

            /////////////////  Delete Project /////////////////

            public function deleteProject($id){
                if(Auth::user()->role == 'student'){

                $project = Project::findOrFail($id);
                $project->isSelected = null;

                $discussion = Discussion::all()->where('project_id','=',$project->id)->first();
                $discussion->student_id = null;
                $discussion->save();

                $stdId = Auth::user()->id;
                $student = Student::all()->where('user_id',$stdId)->first();
                $project->student_id = null;
                $project->save();

                return redirect()->back()->with('success','You are Delete Your Project');

                }
                else{
                    return redirect()->back();
                }
            }

        /////////////////  Discussions /////////////////

        public function discussions(){
            if(Auth::user()->role == 'student'){
                $students = Student::all();
                $discussions = Discussion::paginate(5);
                return view('student.discussions',compact(['discussions','students']));
            }
            else{
                return redirect()->back();
            }
        }
    }
            ///////////////// Show Add Group /////////////////

        // public function showAddGroup(){
        //     if(Auth::user()->role == 'student'){
        //         $std = Student::all()->where('user_id','=',Auth::user()->id)->first();
        //         $students = Student::all()->except([$std->id]);
        //         return view('student.addGroup',compact(['students']));
        //     }
        //     else{
        //         return redirect()->back();
        //     }
        // }



        // /////////////////  Add Group /////////////////

        //     public function addGroup(Request $request){
        //         if(Auth::user()->role == 'student'){

        //            $group = new Group();
        //           $x = Auth::user()->id;
        //           $std =  Student::all()->where('user_id','=',$x)->first();
        //            $project = Project::all()->where('student_id','=',$std->id)->first();
        //            $group->project_id = $project->id;
        //            $group->save();
        //            $idStudent = Student::all()->where('id','=',$request->input('student_id'))->first();
        //            $idStudent->group_id =$group->id;
        //            $idStudent->save();

        //             $id = Auth::user()->id;
        //             $student = Student::all()->where('user_id','=',$id)->first();
        //             $student->group_id = $group->id;
        //             $student->save();

        //          return redirect()->back()->with('success','You are Add Student to Your Group');


        //         }
        //         else{
        //             return redirect()->back();
        //         }
        //     }


        // public function showGroup(){
        //         if(Auth::user()->role == 'student'){
        //             $x = Auth::user()->id;
        //             $std =  Student::all()->where('user_id','=',$x)->first();
        //              $project = Project::all()->where('student_id','=',$std->id)->first();
        //              $group_id = $project->group->id;

        //              $students = Student::all()->where('group_id','=',$group_id);

        //             return view('student.showGroup',compact('students'));

        //         }
        //         else{
        //         return redirect()->back();
        //          }
        //         }

