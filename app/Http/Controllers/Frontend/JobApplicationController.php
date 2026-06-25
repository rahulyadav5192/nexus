<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\Careers;

class JobApplicationController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'career_id' => 'required|exists:careers,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);
        }

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $name = time() . '_' . $resume->getClientOriginalName();
            $destinationPath = public_path('/uploads/job_applications');
            
            // Create directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $resume->move($destinationPath, $name);
            $resumePath = 'uploads/job_applications/' . $name;
        }

        JobApplication::create([
            'career_id' => $request->career_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume_path' => $resumePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your application has been submitted successfully!'
        ]);
    }
}
