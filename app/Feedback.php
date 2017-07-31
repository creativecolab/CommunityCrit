<?php

namespace App;

use Carbon\Carbon;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
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
    const LABEL_SUGGEST = ["What if "];
    const LABEL_CON = ["I am concerned about ", " because ", "<br>One way to address this would be "];
    const LABEL_CUSTOM = [""];
    const LABELS = [Feedback::STR_PRO => Feedback::LABEL_PRO,
                    Feedback::STR_QUESTION => Feedback::LABEL_QUESTION,
                    Feedback::STR_STORY => Feedback::LABEL_STORY,
                    Feedback::STR_REF => Feedback::LABEL_REF,
                    Feedback::STR_SUGGEST => Feedback::LABEL_SUGGEST,
                    Feedback::STR_CON => Feedback::LABEL_CON,
                    Feedback::STR_CUSTOM => Feedback::LABEL_CUSTOM];

	use CrudTrait;

	protected $fillable = [ 'comment', 'task_id', 'user_id', 'type', 'idea_id', 'link_id'];

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
     * Idea for this comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function idea()
    {
        return $this->belongsTo('App\Idea');
    }

    /**
     * Link for this comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function link()
    {
        return $this->belongsTo('App\Link');
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

    // public function commentable()
    // {
    //     return $this->morphTo();
    // }

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
                $comment = Feedback::LABELS[$type][0] . $input1 . Feedback::LABELS[$type][1] . $input2 . Feedback::LABELS[$type][2] . $input3;
                break;
            //1 input
            case Feedback::STR_CUSTOM:
            case Feedback::STR_SUGGEST:
                $comment = Feedback::LABELS[$type][0] . $input1;
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

    public function getCreatedAtAttribute($date)
    {
        return $this->attributes['created_at'] = Carbon::parse($date)->diffForHumans();
    }

    public function getUpdatedAtAttribute($date)
    {
        return $this->attributes['updated_at'] = Carbon::parse($date)->diffForHumans();
    }

    // public function getCreatedAtAttribute($date)
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('F jS, Y, g:i a');
    //     // return $this->attributes['created_at'] = Carbon::parse($date)->diffForHumans();
    //     // return Carbon::parse($date)->diffForHumans();
    // }

    // public function getUpdatedAtAttribute($date)
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('F jS, Y, g:i a');
    //     // return $this->attributes['updated_at'] = Carbon::parse($date)->diffForHumans();
    // }

    // public function created_ago() {
    //     return "hi";
    //     return $this->attributes['created_at'] = Carbon::parse($date)->diffForHumans();
    //     // $end = Carbon::parse($request->input('created_at'));
    //     // $now = Carbon::now();
    //     // $length = $end->diffInDays($now);
    //     // return $length->diffForHumans();
    // }
}
