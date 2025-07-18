<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Repositories\Contracts\QuestionRepositoryInterface;
use Validator;

class QuestionController extends Controller
{
    protected $QuestionRepository;

    public function __construct(QuestionRepositoryInterface $QuestionRepository)
    {
        $this->QuestionRepository = $QuestionRepository;
    }

    public function store(QuestionRequest $request)
    {
        $data = $request->validated();

        // echo "<pre>";
        // print_r($request->all());
        // exit;

        // $rules = [
        //     "*.question"  => "required",
        //     "*.answer_type"  => "required",
        // ];

        // $customMessages = [
        //     'required' => 'The :attribute field is required.'
        // ];


        // $validator = Validator::make($request->all(), [
        //     "*.question"  => "required",
        //     "*.answer_type"  => "required",
        // ]);


        // $this->validate($request, $rules, $customMessages);

        // if ($validator->fails()) {

        //     return response()->json([

        //         'error' => $validator->errors()->all()

        //     ]);
        // }
        // echo "<pre>";
        // print_r("ss");
        // exit;
        $Question = $this->QuestionRepository->create($request->all());

        return 1;
        // echo "<pre>";
        // print_r($Question);
        // exit;
        // Redirect or return a response
        // return redirect()->route('/')->with('success', 'Question created successfully!');
    }
}
