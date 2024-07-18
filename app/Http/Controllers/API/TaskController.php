<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Priority; 
use Illuminate\Http\Request;
use Validator;

class TaskController extends Controller
{
    public function create_task(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'priority_level' => 'required',
            'due_date' => 'required|date',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        try {
            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'priority_level' => $request->priority_level,
                'due_date' => $request->due_date,
                'status' => $request->status,
            ]);

            return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong, kindly try again'], 500);
        }
    }

    public function update_task(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'priority_level' => 'required',
            'due_date' => 'required|date',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        try {
            $task = Task::findOrFail($id);
            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'priority_level' => $request->priority_level,
                'due_date' => $request->due_date,
                'status' => $request->status,
            ]);

            return response()->json(['message' => 'Task updated successfully', 'task' => $task],200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong, task not updated'], 500);
        }
    }

    public function delete_task($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();

            return response()->json(['message' => 'Task deleted successfully'],200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong, try again'], 500);
        }
    }

    public function all_tasks()
    {
        try {
           $tasks = Task::all();
            if ($tasks->count() > 0){
                return response()->json([
                    'task' =>$tasks
                ],200);
            }else{
                return response()->json([
                    'message' => 'No Tasks Found'
                ],404);
            }   

        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong, kindly try again'], 500);
        }
    }

    public function priority_levels()
    {
        try {
           $priority = Priority::all();
            if ($priority->count() > 0){
                return response()->json([
                    'priority_levels' => $priority
                ],200);
            }else{
                return response()->json([
                    'message' => 'No priority levels Found'
                ],404);
            }   

        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong, kindly try again'], 500);
        }
    }
}