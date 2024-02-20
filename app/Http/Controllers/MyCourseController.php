<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Response\ControllerResponses;
use App\Http\Requests\CreateMyCourseRequest;
use App\Http\Resources\MyCourseResource;
use App\Models\MyCourse;
use Illuminate\Http\Request;

class MyCourseController extends Controller
{
    public function create(CreateMyCourseRequest $request)
    {
        $req = $request->validated();

        $courseId = $req["course_id"];
        CourseController::findCourse($courseId);

        $userId = $req["user_id"];
        $user = getUserById($userId);

        if ($user["status"] !== "OK"){
            return response()->json([
                "code" => $user["code"],
                "status" => $user["status"],
                "errors" => [
                    "message" => $user["errors"]["message"]
                ]
            ], $user["code"]);
        }

        $isExistMyCourse = MyCourse::where("course_id", $courseId)
            ->where("user_id", $userId)
            ->exists();
        var_dump($isExistMyCourse);

        if ($isExistMyCourse) {
            return response()->json(
                ControllerResponses::conflictResponse("User already take this course")
            ,409);
        }

        $myCourse = MyCourse::create($req);

        return new MyCourseResource($myCourse);
    }
}