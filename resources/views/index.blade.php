@extends('layouts')

@section('contents')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group mt-4">
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <div class="form-group mt-4">
                    <div class="d-grid gap-2">
                        <button class="btn btn-success btn-block" id="submitButton" onclick="submitFile()">Upload</button>
                        <div class="text-wwarning" id="checking-text"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <center><b>Active Number</b></center>
                        <textarea class="form-control mt-2" id="active_number" rows="10" style="resize: none;border:none;background:#eee;color:green;border:1px green solid;" readonly=""></textarea>
                    </div>
                    <div class="col-md-4">
                        <center><b>Inactive Number</b></center>
                        <textarea class="form-control mt-2" id="inactive_number" rows="10" style="resize: none;border:none;background:#eee;color:green;border:1px green solid;" readonly=""></textarea>
                    </div>
                    <div class="col-md-4">
                        <center><b>Unknown Number</b></center>
                        <textarea class="form-control mt-2" id="unknown_number" rows="10" style="resize: none;border:none;background:#eee;color:green;border:1px green solid;" readonly=""></textarea>
                    </div>
                    <div class="col-md-12 mt-4">
                        <center><b>Logs And Response</b></center>
                        <textarea class="form-control mt-2" id="checkingNumberElement" rows="10" style="resize: none;border:none;background:#eee;color:green;border:1px green solid;" readonly=""></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        function checkingNumber(numbers,position,counter) {
            var checkingText = jQuery('#checking-text');
            var submitButton = jQuery('#submitButton');
            var checkingNumberElement = jQuery('#checkingNumberElement');
            var activeNumber = jQuery('#active_number');
            var inActiveNumber = jQuery('#inactive_number');
            var unknownNumber = jQuery('#unknown_number');
            jQuery.ajax({
                url : '{{ route('checking-phone-number') }}',
                method : 'post',
                dataType: 'json',
                data : 'phone_number=' + numbers[position],
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    checkingText.html(`${numbers[position]}... ${position}/${counter}\n`);
                },
                success: function(response) {

                    checkingNumberElement.append(`${numbers[position]} | ${response.statusCode} | ${response.response} | ${position}/${counter}\n`);
                    checkingNumberElement.scrollTop(checkingNumberElement[0].scrollHeight);

                    if(response.response == 'nomor anda saat ini sudah dalam keadaan aktif') {
                        activeNumber.append(`${numbers[position]}\n`);
                        activeNumber.scrollTop(activeNumber[0].scrollHeight);
                    } else if(response.response == 'nomor anda valid') {
                        inActiveNumber.append(`${numbers[position]}\n`);
                        inActiveNumber.scrollTop(inActiveNumber[0].scrollHeight);
                    } else if(response.response == 'nomor tidak dapat di temukan') {
                        unknownNumber.append(`${numbers[position]}\n`);
                        unknownNumber.scrollTop(unknownNumber[0].scrollHeight);
                    } else if(response.response == 'nomor Anda tidak dapat dikenali, harap cek kembali') {
                        unknownNumber.append(`${numbers[position]}\n`);
                        unknownNumber.scrollTop(unknownNumber[0].scrollHeight);
                    } else if(response.response.indexOf('kesempatan habis') == 0) {
                        inActiveNumber.append(`${numbers[position]}\n`);
                        unknownNumber.scrollTop(unknownNumber[0].scrollHeight);
                    }

                    if(position == counter) {
                        checkingText.html(``);
                        submitButton.removeAttr('disabled');
                        return;
                    }

                    position++;
                    checkingNumber(numbers,position,counter);
                },
                error : function(err) {
                    checkingText.html(``);
                    submitButton.removeAttr('disabled');
                }
            });
        }

        function submitFile() {
            var submitButton = jQuery('#submitButton');
            var fileData = $('#file').prop('files')[0];
            var fd = new FormData();
            fd.append('file', fileData);
            jQuery.ajax({
                url: '{{ route('upload-file') }}',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: fd,
                type: 'post',
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    submitButton.attr('disabled', true);
                },
                success: function(response) {
                    var numbers = response.data;
                    checkingNumber(numbers, 0, response.count - 1);
                },
                error : function(err) {
                    submitButton.removeAttr('disabled');
                }
            });
        }
    </script>
@endsection
