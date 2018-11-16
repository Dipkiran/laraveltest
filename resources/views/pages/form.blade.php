@extends('layouts.base')

@section('content')
<form id="submitdata" method="POST" action="{{route('postform')}}" enctype="multipart/form-data">
          <br style="clear:both">
        {{ csrf_field() }}
        <div class="form-group">
              <label> Name</label>
              <input type="text"class="form-control" id='name' name="name" placeholder="Name">
				</div>
        <div class="form-group">
              <label> Age</label>
              <input type="text"class="form-control" id='age' name="age" placeholder="Age">
				</div>
        <div class="form-group">
              <label> Gender</label>
              <input type="text"class="form-control" id='gender' name="gender" placeholder="Gender">
				</div>
        <button onclick="submitdata()" type="button" class="btn btn-primary pull-right">Submit</button>

</form>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  function submitdata(){
    var $this = $(document.getElementById("submitdata"));
      //var formdata=new FormData($this);

      var form = $('#submitdata')[0];
      var formdata = new FormData(form);
      for (var pair of formdata.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
      }
      console.log($this.prop('method'));
      console.log($this.prop('action'));
      $.ajax({ //2
        url: $this.prop('action'),
        method: $this.prop('method'),
        // headers: {
        //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        dataType: 'json', //3
        data: formdata, //4
        processData: false,
        contentType: false,
        success: function(data) {
          if ((data.errors)) {
            console.log("test")
            $.each(data.errors, function(key, value) {
              //errorsHtml += '<li>' + value[0] + '</li>';
              console.log(value[0]);

            });

          } else {
            console.log(data);
            }
        },
        error: function(error) {
          console.log(error);
        }
      });

    }
    $('#submitdata').on('submit', function(e) {
      e.preventDefault(); //1
      submitdata();
    })
</script>
