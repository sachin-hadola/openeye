<?php

namespace App\Repositories\Eloquent;

use App\Models\Question;
use App\Models\Mcqanswer;
use App\Repositories\Contracts\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function create(array $data)
    {

        $formdata = $data['formdata'] ?? [];
        // echo "SS<pre>";
        // print_r($answer_mcq);
        // exit;
        foreach ($formdata as $key => $value) {

            if ($value['answer_type'] == 'mcq') {
                $value['answer_short'] = null;
                $value['answer_description'] = null;
            } else if ($value['answer_type'] == 'short') {
                $value['answer_mcq'] = [];
                $value['answer_description'] = null;
            }
            if ($value['answer_type'] == 'description') {
                $value['answer_short'] = null;
                $value['answer_mcq'] = [];
            }

            $response = Question::create($value);
            $record_id = $response['id'] ?? 0;


            $answer_mcq = $value['answer_mcq'] ?? [];
            // echo "SS<pre>";
            // print_r($answer_mcq);
            // exit;
            if (!empty($answer_mcq)) {
                $data_m = [];
                foreach ($answer_mcq as $k => $v) {
                    $data_m[] = [
                        'question_id'  => $record_id,
                        'answer'    => $v
                    ];
                }
                
                Mcqanswer::insert($data_m);
            }
        }

        return 1;
    }
}
