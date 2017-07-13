<script>
    $( document ).ready(function() {
        $("#shareBtns button").click( function() {
            var shareType = $(this).val();
            createShareForm(shareType);
        });

        $(".likeComment").click( function() {
            var $thumbsup = $(this).children(".glyphicon-thumbs-up");
            var $counter = $(this).children(".likeCount");
            var count = parseInt($counter.text());
            var likeColor = "blue";

            if ($thumbsup.hasClass("liked")) {
                count -= 1;
                $counter.text(count);
                $thumbsup.removeClass("liked");
            } else {
                count += 1;
                $counter.text(count);
                $thumbsup.addClass("liked");
            }

        });
    });


    //
    //       Timothy, 03/23/17
    //     </div> <!-- .panel-footer -->
    //   </div> <!-- .panel -->
    // </div> <!-- .col -->
    function otherNeighbor() {
//        var selectVal = $(this).val();
        var selectVal = document.getElementById("neighborhood").value;
        var $otherInput = $('#neighOtherFG');
        if (selectVal == "(other)") {
            $($otherInput).show();
        } else {
            $($otherInput).hide();
        }
    }

    function createShareForm(shareType) {
        var data;

        switch(shareType) {
            case "pro":
                data = ["I <strong>like</strong>...", ,"this element of the project",
                    "because", "of this reason."];
                break;
            case "con":
                data = ["I am <strong>concerned</strong> about...", , "this element of the project",
                    "because", "of this reason.",
                    "One way to address this would be", "to follow this suggestion."];
                break;
            case "suggestion":
                data = ["I have a <strong>suggestion</strong>...", "What if", "the project included this."];
                break;
            case "question":
                data = ["I have a <strong>question</strong> about...", , "this element of the project",
                    "I would like more information about", "this aspect of that element."];
                break;
            case "story":
                data = ["I have a <strong>story</strong> about...", , "this element of the project",
                    "Once upon a time,", "this thing happened to me or someone I know."];
                break;
            case "reference":
                data = ["This makes me <strong>think of</strong>...", , "this thing I know or this link.",
                    "We could learn", "this from that."];
                break;
            case "custom":
                data = ["(custom)", , "What's on your mind? Please try to use one of the other options if possible."];
                break;
            default:
                data = [];
        }

        console.log(data.length);

        var title = data[0];
        var input1label = data[1];
        var input1placeholder = data[2];
        var input2label = data[3];
        var input2placeholder = data[4];
        var input3label = data[5];
        var input3placeholder = data[6];

        var html =	'<div class="col-sm-6" id="shareForms">' +
                '<div class="panel panel-primary">' +
                '<div class="panel-heading">' +
                '<div class="panel-title">' + title + '</div>' +
                '</div> <!-- .panel-heading -->' +
                '<div class="panel-body">' +
                '{!! Form::open(['action' => ['TaskController@storeFeedback', $test]]) !!}' +
                '<div class="form-group">';

        if (input1label != undefined) {
            html += '<label for="input1">' + input1label +'</label>';
        }

        html += '<textarea class="form-control" name="type" id="type" style="display:none;">' + shareType + '</textarea>';

        html += '<textarea class="form-control" name="input1" id="input1" placeholder="' + input1placeholder +' "></textarea>' +
                '</div>';

//        html += '<textarea class="form-control" id="input1" placeholder="' + input1placeholder +' "></textarea>' +
//                '</div>';

        {{--html += '{!! Form::textarea('comment', '', ['class' => 'form-control', 'required' => 'true']) !!}' +--}}
                {{--'</div>';--}}


        if (data.length > 3) {
            console.log("second input added");
            html += '<div class="form-group">' +
                    '<label for="input2">' + input2label +'</label>' +
                    '<textarea class="form-control" name="input2" id="input2" placeholder="' + input2placeholder + '"></textarea>' +
                    '</div>';
        }

        if (data.length == 6) {
            console.log("third label added");
            html +=	'<div class="form-group">' +
                    '<label for="input3">' + input3label + '</label>' +
                    '</div>';
        }

        if (data.length > 5) {
            console.log("third input added");
            html += '<div class="form-group">' +
                    '<label for="input3">' + input3label + '</label>' +
                    '<textarea class="form-control" name="input3" id="input3" placeholder="' + input3placeholder + '"></textarea>' +
                    '</div>';
        }

        html += 	'{!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}' +
                '{!! Form::close() !!}' +
                '</div> <!-- .panel-body --></div> <!-- .panel --></div> <!-- .col -->';

        $("#shareForms").replaceWith(html);
    }

    // $("input:share").click(function() {
    // 	var panel = $(e).parentsUntil("#shareForms");

    // 	var input1val, input2val, input3val = "hi";

    // 	var html = 	'<div class="col-md-6"><div class="panel panel-default">' +
    // 	        		'<div class="panel-body">' +
    // 	        			'<p>' + input1val + ' ' + input2val + ' ' + input3val + '</p>' +
    // 	        		'</div> <!-- .panel-body -->' +
    // 	        		'<div class="panel-footer">' +
    // 	        			'FirstName' + ', ' + '00/00/00' +
    // 	        		'</div> <!-- .panel-footer --></div> <!-- .panel --></div> <!-- .col -->';

    // 	panel.replaceWith(contents);
    // });
</script>

