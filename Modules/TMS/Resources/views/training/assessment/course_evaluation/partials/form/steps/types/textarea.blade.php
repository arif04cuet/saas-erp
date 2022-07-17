<ul class="list-group">
    <div class="form-group green-border-focus">
        <textarea data-rule-maxlength="2000" data-msg-maxlength="At most 2000 characters" class="form-control"
                  id="exampleFormControlTextarea5" rows="10"
                  name="questionnaires[{{$questionnaire->id. '|'.$subSection->id}}][]"></textarea>
    </div>

    <div class="error-container" style="width: 100%; text-align: center;">
        <div data-question-id="" class="radio-error" style="text-align: center;"></div>
    </div>
</ul>
