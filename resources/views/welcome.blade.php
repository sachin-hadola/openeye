<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="p-5">
        <form id="questionform">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Question</label>
                <input type="type" class="form-control" id="" name="formdata[0][question]" aria-describedby="emailHelp" require>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Answer Type</label>
                <select class="form-control answer_type_drodpwn" id="exampleFormControlSelect1" name="formdata[0][answer_type]" require>
                    <option value="" selected disabled>Select Option</option>
                    <option value="short">Short</option>
                    <option value="description">Description</option>
                    <option value="mcq">MCQ</option>
                </select>
            </div>

            <div class="form-group dynamocfields short" style="display: none;">
                <label for="">Answer</label>
                <input type="text" class="form-control" id="" name="formdata[0][answer_short]" aria-describedby="emailHelp">
            </div>
            <div class="form-group dynamocfields description" style="display: none;">
                <label for="">Answer</label>
                <textarea class="form-control" id="" name="formdata[0][answer_description]" rows="3"></textarea>
            </div>
            <div class="dynamocfields mcq" style="display: none;">
                <div id="container">
                    <div class="form-group row template-div" id="optionmaindiv_1">
                        <label for="textbox1" class="col-sm-2 col-form-label">Option 1:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control item-name" id="textbox1" name="formdata[0][answer_mcq][]" aria-describedby="emailHelp">
                        </div>
                        <button type="buttom" class="col-sm-2 btn btn-primary removeoption" id="removeoption_1" style="display: none;">Remove</button>
                    </div>
                </div>
                <div class="form-group text-right">
                    <button type="buttom" class="btn btn-primary" id="addTextboxBtn">Add Option</button>
                </div>
            </div>

            <div class="form-group">
                <button type="buttom" class="btn btn-primary addmorequestion">Add more question</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


    <script>
        $(document).ready(function() {

            $("form").submit(function(event) {

                // if (!$("form").valid()) {
                //     event.preventDefault();
                //     return; // <-- here
                // }
                event.preventDefault(); // Prevents the default form submission (page reload)

                let form = $('#questionform')[0];
                let data = new FormData(form);

                $.ajax({
                    url: "{{ route('savequestion') }}",
                    type: "POST",
                    data: data,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // console.log('Server response:', response.error[0]);

                        if (response.error) {
                            var res = response.error[0].split('_token.');
                            console.log('Server response:', res[1]);
                            alert(res[1]);
                        } else {
                            alert('Record saved.');
                            location.reload();
                        }

                    },
                    error: function(err) {
                        alert(err.responseJSON.message);
                        console.error('AJAX Error:', err.responseJSON.message);
                    }
                });
            });

            $('.answer_type_drodpwn').on('change', function() {
                var selectedValue = $(this).val(); // Get the selected value

                if (selectedValue) {
                    $('.dynamocfields').hide();
                    $('.' + selectedValue).show();
                }
            });
        });

        $(document).ready(function() {
            let counter = 1; // Initialize a counter for unique IDs and labels

            $('#addTextboxBtn').on('click', function(e) {
                e.preventDefault();
                counter++; // Increment the counter for the new element

                // Clone the template div
                let $newDiv = $('.template-div:first').clone(true); // 'true' copies event handlers

                // Update the ID of the cloned div's input and label
                $newDiv.find('input[type="text"]').attr({
                    'id': 'option' + counter,
                    // 'name': 'textbox' + counter,
                    'value': '' // Clear the value of the new textbox
                });
                $newDiv.find('label').attr('for', 'option' + counter).text('Option ' + counter + ':');

                $newDiv.find('button').attr({
                    'id': 'removeoption_' + counter,
                }).show();
                $newDiv.attr({
                    'id': 'optionmaindiv_' + counter,
                });


                // Append the new div to the container
                $('#container').append($newDiv);
            });

            $('body').on('click', '.removeoption', function(e) {
                // alert("ss");
                e.preventDefault();
                var id = $(this).attr('id').split('_');

                $('#optionmaindiv_' + id[1]).remove();
            });
        });
    </script>
</body>

</html>