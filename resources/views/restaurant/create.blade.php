@extends('layouts.admin')
@section('content')

<!-- Button trigger modal -->
<div class="content">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
        <i class="fa fa-plus">

        </i>
        {{ trans('global.restaurant.title') }}
    </button>

    <a href="{{ route('restaurant.index') }}" type="button" class="btn btn-success">
        <i class="fa fa-list">

        </i>
        {{ trans('List Restaurant') }}
    </a>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Restaurant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="" id="restaurantform" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputname">Restaurant Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="nameHelp"
                            placeholder="Enter Name" name="name">
                        @error('name')
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="code">Restaurant Code</label>
                        <input type="text" class="form-control" id="code" placeholder="Enter Code" name="code">
                        @error('code')
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Email">Email Address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                            placeholder="Enter Email" name="email">
                        @error('email')
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Restaurant Phone</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
                        @error('phone')
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desc">Restaurant Description</label>
                        <textarea class="form-control" id="desc" rows="2" name="desc"></textarea>
                    </div>
                    <!-- <div class="form-group">
                        <label for="image">Restaurant Image</label>
                        <input type="file" class="form-control-file" id="image">
                    </div> -->

                    <button class="btn btn-primary" id="butsave" type="submit">Submit</button>
                </form>
            </div>

            <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="butsave" type="submit">Submit</button>
                </div> -->
            <!-- </form> -->
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent

<script type="text/javascript">
$("#restaurantform").submit(function(e) {
    e.preventDefault();
    // $(this).parents("form").ajaxForm(options);

    let name = $("#name").val()
    let code = $("#code").val()
    let phone = $("#phone").val()
    let email = $("#email").val()
    let desc = $("#desc").val()
    // let image = $("#image").val()

    let token = $("input[name=_token]").val()

    $.ajax({
        url: "{{route('restaurant.store')}}",
        type: "POST",
        data: {
            name: name,
            code: code,
            email: email,
            phone: phone,
            desc: desc,
            // image: image,
            _token: _token
        },
        success: function(response) {
            if (response.success) {
                alert(response.message) //Message come from controller
                $('#restaurantform')[0].reset();
                $('#exampleModalCenter').modal('hide')
            } else {
                alert(message)
            }
        },
        error: function(error) {
            alert(error, "jhgjhg")
        }
    })

});
</script>
@endsection