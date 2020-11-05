<script>


    function upload(img) {
        if (img.value != '') {
            var img = img;
        } else {
            return false
        }
        var size = img.files[0].size/1024/1024;
        var form_data = new FormData();
        form_data.append('file', img.files[0])
        form_data.append('_token', '{{ csrf_token() }}')
        $('#loading').css('display', 'flex');
        $.ajax({
            url: "{{url('/admin/posts/ajax-image-upload')}}",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {

                if (data.fail) {
                    $('#loading').css('display', 'none');
                    alert(data.errors.file);
                }
                else {
                    $('#singleimg').css('display', 'none');
                    $('#file_name').val(data);
                    $('#singleimg').css('display','block');
                    $('#sizemb').text('');
                    $('#sizemb').text(size.toFixed(2) + ' MB');
                    $('#nameinsrt').text('');
                    $('#nameinsrt').append('<i class="fas fa-camera"> ' + img.files[0].name);
                    $('#preview_image').attr('src', "{{ Storage::url('') }}" + data);

                }
                $('#loading').css('display', 'none');
            },
            error: function (xhr, status, error) {

                alert(xhr.responseText,);
                $('#preview_image').attr('src', '{{ asset('images/no_image.jpg') }}');
                $('#loading').css('display', 'none');
            }
        });
    }


</script>
