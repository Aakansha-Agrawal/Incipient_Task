@extends('layouts.admin')
@section('content')
<div class="content">
    <!-- <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="">
                {{ trans('global.restaurant.title') }}
            </a>
        </div>
    </div> -->
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.restaurant.title') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('S.No')}}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.code') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.desc') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.image') }}
                                    </th>
                                    <th>
                                        {{ trans('Actions')}}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($restaurants as $key => $restaurant)
                                <tr data-entry-id="{{ $restaurant->id }}">
                                    <td>
                                        {{ $restaurant->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $restaurant->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $restaurant->code ?? '' }}
                                    </td>
                                    <td>
                                        {{ $restaurant->email ?? '' }}
                                    </td>
                                    <td>
                                        {{ $restaurant->phone ?? '' }}
                                    </td>
                                    <td>
                                        {{ $restaurant->desc ?? '' }}
                                    </td>
                                    <td>
                                        {{ $restaurant->image ?? '' }}
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('restaurant.edit', $restaurant->id)}}" data-toggle="modal"
                                            data-target="#exampleModalCenter">
                                            {{ trans('global.edit') }}
                                        </a>
                                        <form action="" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <!-- modal form for edit data -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Restaurant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="modal-body">
                    <form>
                    <!-- <form action="" method=""
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf -->
                        <div class="form-group">
                            <label for="exampleInputname">Restaurant Name</label>
                            <input type="text" class="form-control" id="name" aria-describedby="nameHelp"
                                placeholder="Enter Name" name="name" value="{{ $restaurant->name }}">
                            <!-- @error('name')
                            
                            @enderror -->
                        </div>
                        <div class="form-group">
                            <label for="code">Restaurant Code</label>
                            <input type="text" class="form-control" id="code" placeholder="Enter Code" name="code"
                                value="{{ $restaurant->code }}">
                            <!-- @error('code')
                            
                            @enderror -->
                        </div>
                        <div class="form-group">
                            <label for="Email">Email Address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                placeholder="Enter Email" name="email" value="{{ $restaurant->email }}">
                            <!-- @error('email')
                            
                            @enderror -->
                        </div>
                        <div class="form-group">
                            <label for="phone">Restaurant Phone</label>
                            <input type="tel" class="form-control" id="phone" placeholder="Enter Phone" name="phone"
                                value="{{ $restaurant->phone }}">
                            <!-- @error('phone')
                            
                            @enderror -->
                        </div>
                        <div class="form-group">
                            <label for="desc">Restaurant Description</label>
                            <textarea class="form-control" id="desc" rows="2"
                                name="desc">{{ $restaurant->desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Restaurant Image</label>
                            <input type="file" class="form-control-file" id="image">
                        </div>

                        <button class="btn btn-primary" id="update_data" type="submit">Update</button>
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
</div>

@endsection
@section('scripts')
@parent

<script type="text/javascript">
// edit data code
$(document).ready(function() {

$(document).on("click", "#update_data", function() {
    // var url = "{{ url('restaurant/'.$restaurant->id)}}";
    var id =
        $.ajax({
            url: url,
            type: "PATCH",
            cache: false,
            data: {
                _token: '{{ csrf_token() }}',
                type: 3,
                name: $('#name').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                code: $('#code').val(),
                desc: $('#desc').val()
            },
            success: function(dataResult) {
                dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode) {
                    window.location = "/restaurant";
                } else {
                    alert("Internal Server Error");
                }

            }
        });
});
});


// delete data code
$(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('restaurant.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  dtButtons.push(deleteButton)

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection