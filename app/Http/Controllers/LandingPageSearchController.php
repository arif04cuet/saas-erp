<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageSearchController extends Controller
{
    public function searchCourse(Request $request)
    {
        $courseData = searchCourse($request->course_text);
        return view('public.search.course', compact('courseData'));
    }
}
