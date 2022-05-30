@extends('dashboard.layout')

@section('pageName')
    <h1 class="mb-0 text-white">{{ @$pageName }}</h1>
    <div class="small"></div>
@endsection

@section('contents')
    <div class="card mb-4">
        <div class="col-md-3">
            <div id="submitForm">
                <div class="form-group mt-4">
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <div class="form-group mt-4">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-block" id="submitButton" onclick="submitFile()">
                            <i class="fa fa-upload"></i>&nbsp;Upload
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group mt-4 text-center" id="abortAndContinueElem">
                <div class="text-wwarning mb-2" id="checking-text"></div>
                {{-- <div class="d-grid gap-2 mt-4"> --}}
                    <button class="btn btn-danger text-white" id="abortButton" onclick="abortProcess()">
                        <i class="fa fa-pause"></i>&nbsp;Pause
                    </button>
                    <button class="btn btn-success btn-block text-white" id="continueButton" onclick="continueProcess()">
                        <i class="fa fa-play"></i>&nbsp;Continue
                    </button>
                    <a href="" class="btn btn-dark btn-block text-white">
                        <i class="fa fa-stop"></i>&nbsp;Stop
                    </a>
                {{-- </div> --}}
            </div>
        </div>
        <div class="col-md-12 mt-4 mb-4">
            <div class="row">
                <div class="col-md-4">
                    <center><b>Active Number</b></center>
                    <textarea class="form-control mt-2" id="active_number" rows="10" readonly=""></textarea>
                </div>
                <div class="col-md-4">
                    <center><b>Inactive Number</b></center>
                    <textarea class="form-control mt-2" id="inactive_number" rows="10" readonly=""></textarea>
                </div>
                <div class="col-md-4">
                    <center><b>Unknown Number</b></center>
                    <textarea class="form-control mt-2" id="unknown_number" rows="10" readonly=""></textarea>
                </div>
                <div class="col-md-12 mt-4">
                    <center><b>Logs And Response</b></center>
                    <textarea class="form-control mt-2" id="checkingNumberElement" rows="8" readonly=""></textarea>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        var ajaxCall;

        function putFileStorage(data) {
            window.localStorage.setItem('hash_file', data);
        }

        function getFileStorage() {
            return window.localStorage.getItem('hash_file');
        }

        function checkingNumber(numbers,position,counter,cache_file) {

            var checkingText = jQuery('#checking-text');
            var submitButton = jQuery('#submitButton');
            var checkingNumberElement = jQuery('#checkingNumberElement');
            var activeNumber = jQuery('#active_number');
            var inActiveNumber = jQuery('#inactive_number');
            var unknownNumber = jQuery('#unknown_number');
            var submitForm = jQuery('#submitForm');
            var abortAndContinueElem = jQuery('#abortAndContinueElem');

            ajaxCall = jQuery.ajax({
                url : '{{ route('checking-phone-number') }}',
                method : 'post',
                dataType: 'json',
                data : 'phone_number=' + numbers[position] + '&cache_file=' + cache_file,
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    submitForm.attr('style','display:none;');
                    abortAndContinueElem.removeAttr('style')
                },
                success: function(response) {

                    checkingText.html(`${numbers[position]}... ${position}/${counter}\n`);

                    checkingNumberElement.append(`${numbers[position]} => ${response.response}\n`);
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

                    if((position + 1) == counter) {
                        checkingText.html(``);
                        submitButton.removeAttr('disabled');
                        return;
                    }

                    position++;
                    checkingNumber(numbers,position,counter,cache_file);
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
                    var data = response.data;
                    var numbers = data.phone_numbers;
                    putFileStorage(data.cache_file);
                    checkingNumber(numbers, 0, response.count, data.cache_file);
                },
                error : function(err) {
                    submitButton.removeAttr('disabled');
                }
            });
        }

        function abortProcess() {
            var continueButton = jQuery('#continueButton');
            var abortButton = jQuery('#abortButton');
            abortButton.attr('style','display:none;');
            continueButton.removeAttr('style');
            ajaxCall.abort();
        }

        function continueProcess() {
            var continueButton = jQuery('#continueButton');
            var abortButton = jQuery('#abortButton');
            jQuery.ajax({
                url : '{{ route('continue') }}',
                method: 'get',
                dataType : 'json',
                data : 'file_cache=' + getFileStorage(),
                beforeSend: function() {
                    abortButton.removeAttr('style');
                    continueButton.attr('style','display:none');
                },
                success: function(response) {
                    var data = response.data;
                    var numbers = data.phone_numbers;
                    putFileStorage(data.cache_file);
                    checkingNumber(numbers, 0, data.phone_numbers.length, data.cache_file);
                }
            })
        }

        jQuery('#abortAndContinueElem').attr('style','display:none;');
        jQuery('#continueButton').attr('style','display:none;');

    </script>
@endsection
