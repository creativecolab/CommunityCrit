<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{

    const TYPE_PRO = 1;
    const TYPE_CON = 2;
    const TYPE_SUGGEST = 3;
    const TYPE_QUESTION = 4;
    const TYPE_STORY = 5;
    const TYPE_REF = 6;
    const TYPE_CUSTOM = 7;

    const STR_PRO = "pro";
    const STR_CON = "con";
    const STR_SUGGEST = "suggestion";
    const STR_QUESTION = "question";
    const STR_STORY = "story";
    const STR_REF = "reference";
    const STR_CUSTOM = "custom";

    const TYPE_ERR = 0;
    const STR_ERR = "error";

    const LABEL_PRO = ["I like ", " because "];
    const LABEL_QUESTION = ["I have a question about ", "<br>I would like more information about "];
    const LABEL_STORY = ["I have a story about ", "<br>Once upon a time, "];
    const LABEL_REF = ["This makes me think of ", "<br>We could learn "];
    const LABELS = [Feedback::STR_PRO => Feedback::LABEL_PRO,
                    Feedback::STR_QUESTION => Feedback::LABEL_QUESTION,
                    Feedback::STR_STORY => Feedback::LABEL_STORY,
                    Feedback::STR_REF => Feedback::LABEL_REF];

	use CrudTrait;

	protected $fillable = [ 'comment', 'task_id', 'user_id', 'type', 'input1' ];

	/**
	 * Task for this comment
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function task()
	{
		return $this->belongsTo('App\Task');
	}

	/**
	 * User who made this comment
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

    /**
     * Determine type of feedback
     * @param $type
     * @return int
     */
    public function feedbackType($type)
    {
        switch($type) {
            case Feedback::STR_PRO:
                $data = Feedback::TYPE_PRO;
                break;
            case Feedback::STR_CON:
                $data = Feedback::TYPE_CON;
                break;
            case Feedback::STR_SUGGEST:
                $data = Feedback::TYPE_SUGGEST;
                break;
            case Feedback::STR_QUESTION:
                $data = Feedback::TYPE_QUESTION;
                break;
            case Feedback::STR_STORY:
                $data = Feedback::TYPE_STORY;
                break;
            case Feedback::STR_REF:
                $data = Feedback::TYPE_REF;
                break;
            case Feedback::STR_CUSTOM:
                $data = Feedback::TYPE_CUSTOM;
                break;
            default:
                $data = Feedback::TYPE_ERR;
        }

        return $data;
    }

    //bypass type
    public function constructComment($type, $input1, $input2, $input3)
    {
        $comment = "";
        switch($type) {
            //2 inputs
            case Feedback::STR_PRO:
            case Feedback::STR_QUESTION:
            case Feedback::STR_STORY:
            case Feedback::STR_REF:
                $comment = Feedback::LABELS[$type][0] . $input1 . Feedback::LABELS[$type][1] . $input2;
                break;
            //3 inputs
            case Feedback::STR_CON:
                break;
            //1 input
            case Feedback::STR_CUSTOM:
            case Feedback::STR_SUGGEST:
                break;
            //error?
            default:
                //TODO : error status return
                $comment = "nope";
                break;

        }
//        $comment = "qhat";
        return $comment;
    }
}
