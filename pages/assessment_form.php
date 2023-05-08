<?php
  include('../config/authentication.php');
  include('../includes/header.php');
?>

<div class="container">
  <h1>Create Assessment Form</h1>
  <form id="assessment-form" method="POST">
    <div id="questions-container">
      <div class="question">
        <div class="form-group">
          <label for="question-1">Question 1</label>
          <input type="text" class="form-control" id="question-1" name="questions[1][text]" placeholder="Enter your question here">
        </div>
        <div class="form-group">
          <label for="answer-type-1">Answer Type</label>
          <select class="form-control" id="answer-type-1" name="questions[1][type]">
            <option value="text">Text Input</option>
            <option value="multiple_choice">Multiple Choice</option>
            <option value="checkbox">Checkbox</option>
          </select>
        </div>
        <div class="form-group answer-options">
          <label for="answer-options-1">Answer Options</label>
          <input type="text" class="form-control" id="answer-options-1" name="questions[1][options]" placeholder="Enter answer options separated by commas">
        </div>
      </div>
    </div>
    <button type="button" class="btn btn-primary" id="add-question-button">Add Question</button>
    <button type="submit" class="btn btn-success" id="submit-button">Submit</button>
  </form>
</div>

<script>
  $(document).ready(function() {
  var questionCounter = 1;

  // Add question to the questions container
  $('.add-question').click(function() {
    questionCounter++;
    var questionHTML = '<div class="question">';
    questionHTML += '<label for="question-' + questionCounter + '">Question ' + questionCounter + '</label>';
    questionHTML += '<input type="text" name="question-' + questionCounter + '" class="form-control" placeholder="Enter question here">';
    questionHTML += '<select name="question-type-' + questionCounter + '" class="form-control">';
    questionHTML += '<option value="text">Text</option>';
    questionHTML += '<option value="radio">Multiple Choice</option>';
    questionHTML += '<option value="checkbox">Checkbox</option>';
    questionHTML += '</select>';
    questionHTML += '<div class="options" style="display: none;">';
    questionHTML += '<input type="text" name="options-' + questionCounter + '[]" class="form-control" placeholder="Enter option here">';
    questionHTML += '<button type="button" class="add-option btn btn-sm btn-primary mt-1">Add Option</button>';
    questionHTML += '</div>';
    questionHTML += '</div>';

    $('#questions-container').append(questionHTML);
  });

  // Show or hide options for multiple choice or checkbox questions
  $('#questions-container').on('change', 'select', function() {
    var optionsContainer = $(this).siblings('.options');

    if ($(this).val() == 'radio' || $(this).val() == 'checkbox') {
      optionsContainer.show();
    } else {
      optionsContainer.hide();
    }
  });

  // Add new option to the options container
  $('#questions-container').on('click', '.add-option', function() {
    var optionsContainer = $(this).parent();
    var optionHTML = '<input type="text" name="' + optionsContainer.siblings('select').attr('name').replace('type', 'options') + '[]" class="form-control mt-1" placeholder="Enter option here">';
    optionsContainer.prepend(optionHTML);
  });
});
</script>

<?php
    include('../includes/footer.php');
?>
