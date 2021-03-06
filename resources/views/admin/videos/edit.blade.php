@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3 class="page-title">@lang('quickadmin.videos.title')</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>@lang('quickadmin.qa_edit')</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::model($video, ['method' => 'PUT', 'route' => ['admin.videos.update', $video->id], 'files' => true,]) !!}
                        <div class="row">
                            <div class="col-xs-12 form-group">
                               {!! Form::label('name', trans('quickadmin.videos.fields.name').'*', ['class' => 'control-label']) !!}
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('name'))
                                    <p class="help-block">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                {!! Form::label('video', trans('quickadmin.videos.fields.video').'*', ['class' => 'control-label']) !!}
                                {!! Form::file('video[]', [
                                    'class' => 'form-control file-upload',
                                    'data-url' => route('admin.media.upload'),
                                    'accept' => 'video/mp4',
                                    'data-bucket' => 'video',
                                    'data-filekey' => 'video',
                                    ]) !!}
                                <p class="help-block"></p>
                                <div class="photo-block">
                                    <div class="progress-bar form-group">&nbsp;</div>
                                    <div class="files-list">
                                        @foreach($video->getMedia('video') as $media)
                                            <p class="form-group">
                                                <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                                <a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>
                                                <input type="hidden" name="video_id[]" value="{{ $media->id }}">
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                                @if($errors->has('video'))
                                    <p class="help-block">
                                        {{ $errors->first('video') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
    <script>
        $(function () {
            $('.file-upload').each(function () {
                var $this = $(this);
                var $parent = $(this).parent();

                $(this).fileupload({
                    dataType: 'json',
                    formData: {
                        model_name: 'Video',
                        bucket: $this.data('bucket'),
                        file_key: $this.data('filekey'),
                        _token: '{{ csrf_token() }}'
                    },
                    add: function (e, data) {
                        data.submit();
                    },
                    done: function (e, data) {
                        $.each(data.result.files, function (index, file) {
                            var $line = $($('<p/>', {class: "form-group"}).html(file.name + ' (' + file.size + ' KB)').appendTo($parent.find('.files-list')));
                            $line.append('<a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>');
                            $line.append('<input type="hidden" name="' + $this.data('bucket') + '_id[]" value="' + file.id + '"/>');
                            if ($parent.find('.' + $this.data('bucket') + '-ids').val() != '') {
                                $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + ',');
                            }
                            $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + file.id);
                        });
                        $parent.find('.progress-bar').hide().css(
                            'width',
                            '0%'
                        );
                    }
                }).on('fileuploadprogressall', function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $parent.find('.progress-bar').show().css(
                        'width',
                        progress + '%'
                    );
                });
            });
            $(document).on('click', '.remove-file', function () {
                var $parent = $(this).parent();
                $parent.remove();
                return false;
            });
        });
    </script>
@stop