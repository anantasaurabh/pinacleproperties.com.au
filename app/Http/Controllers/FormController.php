<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use App\Mail\FormSubmissionMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function submit(Request $request)
    {
        // 1. Honey-pot check
        if ($request->has('company-name-required') && !empty($request->input('company-name-required'))) {
            return response()->json([
                'success' => false,
                'message' => 'Spam detected.'
            ], 422);
        }

        // 2. Validation
        $validator = Validator::make($request->all(), [
            'form-name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed.'
            ], 422);
        }

        // 3. Prepare data (exclude meta fields)
        $data = $request->except([
            '_token', 
            'company-name-required', 
            'form-name'
        ]);

        // 4. Save to DB
        $submission = FormSubmission::create([
            'form_name' => $request->input('form-name'),
            'data' => $data,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // 5. Send Email if configured
        $adminEmail = env('ADMIN_EMAIL', env('MAIL_FROM_ADDRESS'));
        if ($adminEmail) {
            try {
                Mail::to($adminEmail)->send(new FormSubmissionMailable($submission));
            } catch (\Exception $e) {
                // Log error but don't fail the submission
                \Log::error('Mail failed: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your message has been received.'
        ]);
    }
}
