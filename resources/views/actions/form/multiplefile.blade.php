<div class="form-group">
    <label>{{ $label }}</label>
    <input type="file" class="{{$class}}" name="{{$name}}[]" {!! $attributes !!} multiple/>
    @include('admin::actions.form.help-block')
</div>

<script require="fileinput" selector="{{ $selector }}">
    $(this).fileinput(@json($options));

    @if($settings['showRemove'])
    $(this).on('filebeforedelete', function() {
        return new Promise(function(resolve, reject) {
            var remove = resolve;
            $.admin.swal.fire({
                title: "{{ admin_trans('admin.delete_confirm') }}",
                icon: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{ admin_trans('admin.confirm') }}",
                cancelButtonText: "{{ admin_trans('admin.cancel') }}",
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        resolve(remove());
                    });
                }
            });
        });
    });
    @endif

    @if($settings['showDrag'])
    $(this).on('filesorted', function(event, params) {
        var order = [];
        params.stack.forEach(function (item) {
            order.push(item.key);
        });
        $("input{{ $selector }}_sort").val(order);
    });
    @endif
</script>
